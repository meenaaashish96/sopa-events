<?php

namespace App\Http\Controllers;

use App\Models\Delegates;
use App\Models\Event;
use App\Models\HotelRoom;
use App\Models\DeletegateRegistation;
use App\Models\SpotRegistrations;
use App\Models\HotelRoomReservation;
use App\Models\Venues;
use App\Models\Transactions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class DelegateRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd("dndicndicnd");
        $event = Event::where('status', '1')->first();
        $venue = Venues::where("status", "1")->where('event_id', $event->id)->first();
        $hotelrooms = HotelRoom::where('status', '1')->get();
        $delegatePrice = getDelegatePrice($event);
        $delegatePriceList = getNatureOfBusiness();
        // $mindate = Carbon::parse($event->start_date)->subDays(2);
        // $maxdate = Carbon::parse($event->end_date)->addDays(2);
        $mindate = Carbon::parse($event->start_date)->subDays(2)->format('Y-m-d');
        // Carbon::parse($event->start_date)->subDays(2);
        $maxdate = Carbon::parse($event->end_date)->addDays(2)->format('Y-m-d');

        return view('delegate-reservation')->with(compact('event', 'hotelrooms', 'venue', 'delegatePriceList', 'delegatePrice', 'mindate', 'maxdate'));
    }

    public function spot()
    {
        // dd("dndicndicnd");
        $event = Event::where('status', '1')->first();
        $venue = Venues::where("status", "1")->where('event_id', $event->id)->first();
        $hotelrooms = HotelRoom::where('status', '1')->get();
        $delegatePrice = getDelegatePrice($event);
        $delegatePriceList = getNatureOfBusiness();
        // $mindate = Carbon::parse($event->start_date)->subDays(2);
        // $maxdate = Carbon::parse($event->end_date)->addDays(2);
        $mindate = Carbon::parse($event->start_date)->subDays(2)->format('Y-m-d');
        // Carbon::parse($event->start_date)->subDays(2);
        $maxdate = Carbon::parse($event->end_date)->addDays(2)->format('Y-m-d');

        return view('spot-delegate-reservation')->with(compact('event', 'hotelrooms', 'venue', 'delegatePriceList', 'delegatePrice', 'mindate', 'maxdate'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // $headers2  = 'MIME-Version: 1.0' . "\r\n";
        // $headers2 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // // Create email headers
        // $headers2 .= 'From: sopa@sopa.org'."\r\n" .
        //     'Reply-To: sopa@sopa.org'. "\r\n";
        // $html  = '<div style="padding:0;margin:0 auto;width:100%!important;font-family:Helvetica Neue,Helvetica,Arial,sans-serif">
        //     <h1>Welcome Sopa</h1>
        // </div>';

        // $status = mail('sopa@sopa.org',"Password recovery", $html, $headers2);

        $maildata = getmailcontent('delegate', 52, 51);

        $mailStatus =  mail($maildata['mailto'],$maildata['mailsubject'], $maildata['mailbody'], $maildata['mailheader']);
        error_reporting(-1);
        ini_set('display_errors', 'On');
        set_error_handler("var_dump");
        // dd($mailStatus);
        // if($mailStatus){
            $mailStatus1 = mail($maildata['usermailto'],$maildata['mailsubject'], $maildata['mailbody'], $maildata['usermailheader']);
        // }
        dd($mailStatus, $mailStatus1);
        // dd($status);
        // $mailStatus = Mail::send('mail.delegateregistrationtemplate', ['data' => array(
        //     'name'=> 'Sopa',
        //     'contact_person'=>'contact_person',
        //     'email'=> 'Email',
        //     'phone'=>  'phone',
        //     'message'=> 'message'
        // )],function($message) use ($request) {
        //     // dd($request);
        //     $maildata = getmailcontent('delegate', 52, 51);
        //     $message->to($maildata['mailto'])
        //     // ->cc('')
        //     // ->bcc('')
        //     ->subject($maildata['mailsubject']);
        //     // $message->from('sopa@sopa.org','Sopa');
        // });
        // dd($mailStatus);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $event = Event::where("status", "1")->first();
        $venue = Venues::where("status", "1")->where('event_id', $event->id)->first();
        $input = $request->all();
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        // dd($input);
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        // dd($payment);
        // dd($payment);
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            $transition = Transactions::find($request->transition_id);
            if($transition){

                // $delegates = Event::find($id);
                Delegates::where("delegate_reg_id", $transition->ref_id)->update(["status" => 1]);
                DeletegateRegistation::where("id", $transition->ref_id)->update(["status" => 1]);

                $transition->payment_status =  'completed';
                $transition->payment_recevied =  $payment->amount/100;
                $transition->UTR_number =  $input['razorpay_payment_id'];
                $transition->Cheque_receipt_number =  $input['razorpay_order_id'];
                $transition->payment_date =  now();
                $transition->save();
                $maildata = getmailcontent('delegate', $transition->ref_id, $request->transition_id);
                // $header = getmailheader();
                // dd($maildata);
                $mailStatus =  mail($maildata['mailto'],$maildata['mailsubject'], $maildata['mailbody'], $maildata['mailheader']);
                if($mailStatus){
                    mail($maildata['usermailto'],$maildata['mailsubject'], $maildata['mailbody'], $maildata['usermailheader']);
                }
                return view('thankyou')->with(compact('event', 'venue'));
            }else{
                return back()->withInput()->with('message', __('Something went wrong, Please try again later!'));
            }
        }
    }

    public function spotStore(Request $request)
    {
        // dd($request->all());
        $event = Event::where("status", "1")->first();
        $venue = Venues::where("status", "1")->where('event_id', $event->id)->first();
        $delegatePrice = getDelegatePrice($event);
        $input = $request->all();

        if(count($input) && !empty($input['dName'])) {
            // dd($input);
            $data = array(
                'name'=>$input['dName'],
                'dial_code'=> $input['ddial_code'],
                'mobile'=>$input['dmobile'],
                'email'=>$input['demail'],
                'designation'=>$input['ddesignation'],
                'organization_name'=>$input['organization_name'],
                'GSTIN'=> strtoupper($input['GSTIN']),
                'address'=> '',
                'city'=>'',
                'pin_code'=>'',
                'state'=>'',
                'deletegate_category'=>$input['deletegate_category'],
                'amount'=> 9000,
                'tax'=> 1620,
                'total_amount'=>10620,
                'status'=>1,
                'event_id' => $input['event_id'],
                'UTR_number'=>"",
                'Cheque_receipt_number'=>"",
                'payment_status'=>"Pending",
                'payment_recevied'=>0,
                'payment_mode' => ''
            );
            $status = SpotRegistrations::create($data);
            if($status){
                return view('spot-delegate-reservation-success')->with(compact('event', 'venue'));
                // return  redirect('spot-delegate-reservation-success')->with('status', 'Delegates Reservation Done.');
            }else{
               return  redirect('spot-delegate-reservation')->with('status', 'Something went wrong, Please try again.');
            }
        }
    }

     public function spotTest(Request $request)
    {
        $event = Event::where("status", "1")->first();
        $venue = Venues::where("status", "1")->where('event_id', $event->id)->first();
          return view('spot-delegate-reservation-success')->with(compact('event', 'venue'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // Show the Lunch Stall View
    public function showLunch()
    {
        return view('stall.lunch');
    }

    // Show the Dinner Stall View
    public function showDinner()
    {
        return view('stall.dinner');
    }

    // Show the Breakfast Stall View
    public function showBreakfast()
    {
        return view('stall.breakfast');
    }

    // Scan and process the Lunch QR Code
    public function scanLunch(Request $request)
    {
        return $this->processScan($request, 'lunch');
    }

    // Scan and process the Dinner QR Code
    public function scanDinner(Request $request)
    {
        return $this->processScan($request, 'dinner');
    }

    // Scan and process the Breakfast QR Code
    public function scanBreakfast(Request $request)
    {
        return $this->processScan($request, 'breakfast');
    }

    // General function to process the scan
    private function processScan(Request $request, $mealType)
    {
        $delegateId = $request->input('delegate_id');
        $delegate = Delegates::find($delegateId);

        if (!$delegate) {
            return back()->with('error', $delegateId);
        }

        // Check if the delegate has already scanned for this meal type
        if ($delegate->scans()->where('meal_type', $mealType)->exists()) {
            return back()->with('error', 'This QR code has already been scanned for ' . $mealType . '.');
        }

        // Record the scan
        $delegate->scans()->create([
            'meal_type' => $mealType,
            'scanned_at' => now(),
        ]);

        return back()->with('success', 'QR code scanned successfully for ' . $mealType . '.');
    }

    public function generateQrCode($delegateId)
    {
        try {
            $delegate = Delegates::find($delegateId);

            if (!$delegate) {
                return response()->json(['error' => 'Delegate not found'], 404);
            }

            // Generate the QR Code URL or data
            $qrCodeData = $delegate->id;

            // Create the QR code
            $qrCode = QrCode::format('png')->size(300)->backgroundColor(255, 0, 0)->generate($qrCodeData);
            // return $qrCode;
            // die();
            $fileName = 'qrcode-' . Str::random(10) . '.png';
            $path = storage_path($fileName); // Store it in the storage path

            file_put_contents($path, $qrCode);
            // Send email with the QR code attached
            $email_status = Mail::send('mail.delegate_qr', ['delegate' => $delegate], function ($message) use ($delegate, $qrCode, $path) {
                $message->to('meenaaashish96@gmail.com')
                        ->subject('Your QR Code')
                        ->attach($path, [
                            'as' => 'qrcode.png',
                            'mime' => 'image/png+xml',
                        ]);
            });

            return response()->json(['message' => 'QR code sent to delegate', 'status' => $delegate->email]);
        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function scanDelegate($id)
    {
        $delegate = Delegates::find($id);

        if (!$delegate) {
            return response()->json(['error' => 'Delegate not found'], 404);
        }

        // Logic after scanning the delegate's QR code
        return view('delegate.scan', compact('delegate'));
    }

    public function getDelegateInfo($id)
    {
        $delegate = Delegates::find($id);

        if ($delegate) {
            return response()->json([
                'name' => $delegate->name,
                'email' => $delegate->email
            ]);
        }

        return response()->json(['error' => 'Delegate not found'], 404);
    }


}
