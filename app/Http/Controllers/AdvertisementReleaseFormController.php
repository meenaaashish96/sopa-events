<?php

namespace App\Http\Controllers;

use App\Models\Delegates;
use App\Models\Event;
use App\Models\HotelRoom;
use App\Models\HotelRoomReservation;
use App\Models\Advertisement;
use App\Models\Venues;
use App\Models\Transactions;
use App\Models\DeletegateRegistation;
use App\Models\AdvertisementRelease;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Intervention\Image\ImageManagerStatic as Image;
use Maatwebsite\Excel\Facades\Excel;


class AdvertisementReleaseFormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $event = Event::where('status', '1')->first();
        $venue = Venues::where("status", "1")->where('event_id', $event->id)->first();
        $hotelrooms = HotelRoom::where('status', '1')->get();
        $delegatePrice = getDelegatePrice($event);
        $delegatePriceList = getNatureOfBusiness();
        $advertisements = Advertisement::where('status', '1')->get();
        $mindate = Carbon::parse($event->start_date)->subDays(2)->format('Y-m-d');
        $maxdate = Carbon::parse($event->end_date)->addDays(2)->format('Y-m-d');
        $advertisementRelease = AdvertisementRelease::where('status', '1')->get(); 
        $advertisementIds = array();
        foreach ($advertisementRelease as $key => $value) {
            array_push($advertisementIds, $value->advertisement_id);
        }
        $countedValues = array_count_values($advertisementIds);
        return view('advertisement-release-form')->with(compact('event', 'hotelrooms', 'venue', 'delegatePriceList', 'delegatePrice', 'advertisements', 'mindate', 'maxdate', 'countedValues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // attechment
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
                
                $advertisementUpdate = AdvertisementRelease::where('id', $transition->ref_id)->first();
                Delegates::where("delegate_reg_id", $advertisementUpdate->delegate_reg_id)->update(["status" => 1]);
                DeletegateRegistation::where("id", $advertisementUpdate->delegate_reg_id)->update(["status" => 1]);
                // ExhibitionStallBooking::where("id", $transition->ref_id)->update(["status" => 1]);

                $advertisement = AdvertisementRelease::find($transition->ref_id); 
                if(!empty($advertisement)){
                    $imagename = '';
                    if($request->hasfile('attechment')){
                        $image = $request->file('attechment');
                        $imagename = time().'.'.$request->attechment->extension();
                        $destinationPath = public_path('images/attechment');
                        $image->move($destinationPath, $imagename);
                    }
                    $advertisement->file = $imagename;
                    $advertisement->status = 1;
                    $advertisement->save();
                }  

                $transition->payment_status =  'completed';
                $transition->payment_recevied =  $payment->amount/100;
                $transition->UTR_number =  $input['razorpay_payment_id'];
                $transition->Cheque_receipt_number =  $input['razorpay_order_id'];
                $transition->payment_date =  now();
                $transition->save();
                $maildata = getmailcontent('advertisement', $transition->ref_id, $request->transition_id);
                $mailStatus =  mail($maildata['mailto'],$maildata['mailsubject'], $maildata['mailbody'], $maildata['mailheader']);
                if($mailStatus){
                    mail($maildata['usermailto'],$maildata['mailsubject'], $maildata['mailbody'], $maildata['usermailheader']);
                }
                // mail($maildata['mailto'],$maildata['mailsubject'], $maildata['mailbody'], $maildata['mailheader']);
                // mail($maildata['usermailto'],$maildata['mailsubject'], $maildata['mailbody'], $maildata['usermailheader']);
                return view('thankyou')->with(compact('event', 'venue'));
            }else{
                return back()->withInput()->with('message', __('Something went wrong, Please try again later!'));
            }
        } 
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

}
