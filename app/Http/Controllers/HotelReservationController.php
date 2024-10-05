<?php

namespace App\Http\Controllers;

use App\Models\Delegates;
use App\Models\Event;
use App\Models\HotelRoom;
use App\Models\HotelRoomReservation;
use Illuminate\Http\Request;
use Razorpay\Api\Api;

class HotelReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd("dndicndicnd");
        $events = Event::where('status', '1')->get();
        $hotelrooms = HotelRoom::where('status', '1')->get();
        // dd($hotelrooms);
        return view('hotel-room-reservation')->with(compact('events', 'hotelrooms')); 
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

        $input = $request->all();
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        // dd($input);
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        // dd($payment);
        // dd($payment);
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            $hotelroomreservation = HotelRoomReservation::find($request->hotel_room_reservation_id);
            if($hotelroomreservation){
                $hotelroomreservation->payment_status =  'completed';
                $hotelroomreservation->payment_recevied =  'recevied';
                $hotelroomreservation->UTR_number =  $input['razorpay_payment_id'];
                $hotelroomreservation->Cheque_receipt_number =  $input['razorpay_order_id'];
                $hotelroomreservation->payment_date =  now();
              
                $hotelroomreservation->save();
                return view('thankyou');
            }else{
                return back()->withInput()->with('message', __('Something went wrong, Please try again later!'));
            }
        } 


        //  // dd($request->all());
        //  $validated = $request->validate([
        //     'organization_name' => 'required',
        //     'event_id' => 'required',
        //     'email'=> 'required',
        //     'GSTIN'=> 'required',
        //     'address'=> 'required',
        //     'state'=> 'required',
        //     'city'=> 'required',
        //     'pin_code'=> 'required',
        //     'tel_phone'=> 'required',
        //     'mobile_phone'=> 'required',
        //     'payment_mode'=> 'required',
        //     'hotel_room_id'=> 'required',
        //     'UTR_number'=> 'required',
        //     'Cheque_receipt_number'=> 'required',
        //     'payment_date'=> 'required',
        //     // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        // $scectionlist = array();
        // if($request->dName && count($request->dName)>0){
        //     foreach ($request->dName as $key => $value) {
        //         // $find = Delegates::where("email", $request->demail[$key])->first();

        //         $status1 = Delegates::create(array(
        //             "name" => $value,
        //             "event_id" => $request->event_id,
        //             "email" => $request->demail[$key],
        //             "mobile" =>$request->dmobile[$key],
        //             "designation" =>$request->ddesignation[$key],
        //             "delegate_types" => 'Guest',
        //             "user_id" => session('Adminuser.id'),
        //             "status" => '1',
        //         ));
        //         // dd($status1);
        //         if(!empty($status1)){
        //             $scectionlist[] =  $status1->id;
        //         }
        //     };
        // }

    
        // $hotelroom = HotelRoom::find($request->hotel_room_id);
        // // dd( $hotelroom);
        // $roomtotal = $hotelroom->amount+$hotelroom->amount_tax;
        // $grandTotal = $hotelroom->amount+$hotelroom->amount_tax + (count($scectionlist)*8850);

        // // dd( $roomtotal, $grandTotal);
        // $dataArray = array(
        //     "hotel_room_id" => $request->hotel_room_id,
        //     "event_id" => $request->event_id,
        //     "organization_name" => $request->organization_name,
        //     "GSTIN" => $request->GSTIN,
        //     "address" => $request->address,
        //     "city" => $request->city,
        //     "state" => $request->state,
        //     "pin_code" => $request->pin_code,
        //     "tel_phone" => $request->tel_phone,
        //     "mobile_phone" => $request->mobile_phone,
        //     "email" => $request->email,
        //     "delegate_ids" => $scectionlist,
        //     "per_delegate" => "7500",
        //     "per_delegate_tax" => "1350",
        //     "total_delegate" => (count($scectionlist)*8850),
        //     "room_price" => $roomtotal,
        //     "room_price_unit" => $hotelroom->amount_unit,
        //     "grand_total" => $grandTotal,
        //     "UTR_number" => $request->UTR_number,
        //     "Cheque_receipt_number" => $request->Cheque_receipt_number,
        //     "payment_date" => $request->payment_date,
        //     "payment_mode" => $request->payment_mode,
        //     "user_id" => session('Adminuser.id'),
        //     "status" => '1',
        //     "payment_status" => "completed",
        //     "payment_recevied" => "recevied"
        // );
        // $status = HotelRoomReservation::create($dataArray);
        // if($status){
        //     return  redirect('sopa/admin/hotelroom/reservation')->with('status', 'HotelRoomReservation has been created.');
        // }else{
        //     return  redirect('sopa/admin/hotelroom/reservation/add')->with('status', 'HotelRoomReservation not created.');
        // }


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
