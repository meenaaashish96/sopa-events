<?php

namespace App\Http\Controllers;

use App\Exports\ExportDeletegateRegistation;
use App\Models\Delegates;
use App\Models\Event;
use App\Models\ExhibitionStallBooking;
use App\Models\HotelRoom;
use App\Models\HotelRoomReservation;
use App\Models\Stall;
use App\Models\Transactions;
use App\Models\DeletegateRegistation;
use App\Models\Venues;
use App\Models\StallLayouts;
use App\Models\StallLayoutCells;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Maatwebsite\Excel\Facades\Excel;


class ExibihitionHallBookingController extends Controller
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
        $stalls = Stall::where('status', '1')->get();
        $booking = ExhibitionStallBooking::where('status', '1')->get();
        $bookedStall = array();
        
        // dd($booking);
        foreach ($booking as $key => $value) {
            foreach ($value->stalls as $key => $stall) {
                array_push($bookedStall,$stall['stall']);
            }
        }
        $stalllayout = StallLayouts::where('status', '1')->where('event_id', $event->id)->first();
        $stallGrids = array();
        if(!empty($stalllayout)){
            $stallGrids = StallLayoutCells::where('layout_id', $stalllayout->id)->with(['stall'])->get();
        }

        // dd($bookedStall);
       

        

        $mindate = Carbon::parse($event->start_date)->subDays(2)->format('Y-m-d');
        
        // Carbon::parse($event->start_date)->subDays(2);
        $maxdate = Carbon::parse($event->end_date)->addDays(2)->format('Y-m-d');
        

        return view('exibihition-hall-booking')->with(compact('event', 'hotelrooms', 'venue', 'delegatePriceList', 'delegatePrice', 'stalls', 'bookedStall', 'mindate', 'maxdate', 'stalllayout', 'stallGrids'));
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
        $event = Event::where("status", "1")->first();
        $venue = Venues::where("status", "1")->where('event_id', $event->id)->first();
        $input = $request->all();
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            $transition = Transactions::find($request->transition_id);
            if($transition){
                $exhibition = ExhibitionStallBooking::where('id', $transition->ref_id)->first();
                Delegates::where("delegate_reg_id", $exhibition->delegate_reg_id)->update(["status" => 1]);
                DeletegateRegistation::where("id", $exhibition->delegate_reg_id)->update(["status" => 1]);
                ExhibitionStallBooking::where("id", $transition->ref_id)->update(["status" => 1]);

                $transition->payment_status =  'completed';
                $transition->payment_recevied =  $payment->amount/100;
                $transition->UTR_number =  $input['razorpay_payment_id'];
                $transition->Cheque_receipt_number =  $input['razorpay_order_id'];
                $transition->payment_date =  now();
                $transition->save();
                $maildata = getmailcontent('exibihition', $transition->ref_id, $request->transition_id);
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
