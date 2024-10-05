<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Delegates;
use App\Models\DeletegateRegistation;
use App\Models\Event;
use App\Models\HotelRoom;
use App\Models\AdvertisementRelease;
use App\Models\Advertisement;
use App\Models\ExhibitionStallBooking;
use App\Models\HotelRoomReservation;
use App\Models\Transactions;

use Carbon\Carbon;


use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Intervention\Image\ImageManagerStatic as Image;

class ApiController extends Controller
{
    public function delete(Request $request, $id, $rid)
    {
        $sections = Delegates::find($id);
        
        $reservation = DeletegateRegistation::find($rid);
        if(!empty( $reservation )){
            // if (($key = array_search($id, $reservation->delegate_ids)) !== false) {
            //     unset($reservation->delegate_ids[$key]);
            // }
            $reservation->delegate_ids = array_diff( $reservation->delegate_ids, [$id] );
            $reservation->save(); 
        }

        if($sections){
            // $sections->delete();
            return response()->json([
                'data' => [
                    'type' => 'sections',
                    'message' => 'Delete Succesfully',
                    'data' => $request->all()
                ]
            ], 200);
        }else{
            return response()->json([
                'data' => [
                    'type' => 'sections',
                    'message' => 'Section Not Found!',
                ]
            ], 200);
        }
    }

    public function createPyamentObject(Request $request)
    {   
        $input = $request->all();
        $event = Event::where("status", "1")->first();
        //  Delegate Insert
        $delegatesIds = array();
        $totlaDelegate = 0;
        $delegatePrice = getDelegatePrice($event);
        $delegates = array();
        if($request->dtype && count($request->dtype)>0){
            foreach ($request->dtype as $key => $value) {
                $per_delegate = 0;
                $per_delegate_tax = 0;
                if($request->dtype[$key] == 'paid'){
                    $per_delegate = $delegatePrice['amount'];
                    $per_delegate_tax = $delegatePrice['tax'];
                }
                // 'id', 'user_id', 'event_id', 'delegate_reg_id' ,'name', 'image', 'designation', 'status', 'mobile', 'email', 'per_delegate','per_delegate_tax', 'total_delegate', 'type'
                $delegates[] = array(
                    "name" => $request->dName[$key],
                    "event_id" => $request->event_id,
                    "email" => $request->demail[$key],
                    "dial_code" => $request->ddial_code[$key],
                    "mobile" =>$request->dmobile[$key],
                    "designation" =>$request->ddesignation[$key],
                    "delegate_types" => 'Guest',
                    "per_delegate"=> $per_delegate,
                    "per_delegate_tax"=>$per_delegate_tax,
                    "total_delegate"=> $per_delegate+$per_delegate_tax,
                    "type"=> $request->dtype[$key],
                    "status" => 0,
                );
                $totlaDelegate = $totlaDelegate+($per_delegate+$per_delegate_tax);
            };
        }

        // $diff = date_diff(date('Y-m-d hh:mm:ss', strtotime($request->checkin)),date('Y-m-d hh:mm:ss', strtotime($request->checkout)));
        $diff = date_diff(Carbon::parse($request->checkin),Carbon::parse($request->checkout));
        $roomtotal =0;
        if($diff->days!=0){
            $roomtotal = (($request->room_price+$request->room_price_tax)*$request->room_qty)*$diff->days;
        }else{
            $roomtotal = (($request->room_price+$request->room_price_tax)*$request->room_qty);
        }
       
        $grandTotal = $roomtotal + $totlaDelegate;
        $transitionData = array(
            "event_id" => $request->event_id,
            "ref_type"=> "Delegate",
            "ref_id"=>rand(),
            "UTR_number"=>"",
            "Cheque_receipt_number"=>"",
            "payment_status"=>"Pending",
            "payment_recevied"=>0,
            // "payment_date"=>"",
            "payment_mode" => 'Online'
        );
        $transitionStatus = Transactions::create($transitionData);
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
                $order = $api->order->create(array('receipt' => 'Membership form = '.substr($request->organization_name, 0, 10), 'amount' => $grandTotal * 100, 'currency' => 'INR'));
                return response()->json([
                    'data' => [
                        'type' => 'Member',
                        'message' => 'Member successfully created!',
                        'data' => $request,
                        'amount' => $grandTotal,
                        'transition_id' => $transitionStatus->id,
                        'order_id' => $order['id']
                    ]
                ], 200);
    }
    public function DelegateRegistration(Request $request)
    {
        $input = $request->all();

        // dd($input);
        // return response()->json([
        //     'data' => $input
        // ], 500);

        $event = Event::where("status", "1")->first();
        //  Delegate Insert
        $delegatesIds = array();
        $totlaDelegate = 0;
        $delegatePrice = getDelegatePrice($event);
        $delegates = array();
        if($request->dtype && count($request->dtype)>0){
            foreach ($request->dtype as $key => $value) {
                $per_delegate = 0;
                $per_delegate_tax = 0;
                if($request->dtype[$key] == 'paid'){
                    $per_delegate = $delegatePrice['amount'];
                    $per_delegate_tax = $delegatePrice['tax'];
                }
                // 'id', 'user_id', 'event_id', 'delegate_reg_id' ,'name', 'image', 'designation', 'status', 'mobile', 'email', 'per_delegate','per_delegate_tax', 'total_delegate', 'type'
                $delegates[] = array(
                    "name" => $request->dName[$key],
                    "event_id" => $request->event_id,
                    "email" => $request->demail[$key],
                    "dial_code" => $request->ddial_code[$key],
                    "mobile" =>$request->dmobile[$key],
                    "designation" =>$request->ddesignation[$key],
                    "delegate_types" => 'Guest',
                    "per_delegate"=> $per_delegate,
                    "per_delegate_tax"=>$per_delegate_tax,
                    "total_delegate"=> $per_delegate+$per_delegate_tax,
                    "type"=> $request->dtype[$key],
                    "status" => 0,
                );
                $totlaDelegate = $totlaDelegate+($per_delegate+$per_delegate_tax);
            };
        }

        // $diff = date_diff(date('Y-m-d hh:mm:ss', strtotime($request->checkin)),date('Y-m-d hh:mm:ss', strtotime($request->checkout)));
        $diff = date_diff(Carbon::parse($request->checkin),Carbon::parse($request->checkout));
        $roomtotal =0;
        if($diff->days!=0){
            $roomtotal = (($request->room_price+$request->room_price_tax)*$request->room_qty)*$diff->days;
        }else{
            $roomtotal = (($request->room_price+$request->room_price_tax)*$request->room_qty);
        }
       
        $grandTotal = $roomtotal + $totlaDelegate;

        // return response()->json([
        //     'totlaDelegate' => $totlaDelegate,
        //     'roomtotal' => $roomtotal,
        //     'grandTotal' => $grandTotal,
        //     'delegatePrice'=> $delegatePrice,
        //     'ddd' =>$diff->days
        // ], 500);
        
        $dataArray = array(
            "event_id" => $request->event_id,
            "deletegate_category" => $request->delegate_type,
            "organization_name" => $request->organization_name?$request->organization_name: $delegates[0]['name'],
            "GSTIN" => strtoupper($request->GSTIN),
            "address" => $request->address,
            "city" => $request->city,
            "state" => $request->state,
            "pin_code" => $request->pin_code,
            "tel_phone" => $request->tel_phone,
            "country" => $request->dial_code,
            "mobile_phone" => $request->mobile_phone,
            "email" => $request->email?$request->email: $delegates[0]['email'],
            "delegate_ids" => $delegatesIds,
            "total_delegate" =>$totlaDelegate,
            // "hotel_room_id" => $request->hotel_room_id,
            "hotal_name" => $request->hotal_name,
            "hotal_room_type" => $request->hotal_room_type,
            "checkin" => $request->checkin,
            "checkout" => $request->checkout,
            "room_qty" => $request->room_qty,
            "room_days" => strval($diff->days),
            "room_price" => $request->room_price,
            "room_price_tax" => $request->room_price_tax,
            "room_price_unit" => $request->room_price_unit,
            "room_total" => $roomtotal,
            "grand_total" => $grandTotal,
            "status" => 0
        );


        $delegateRegId = DeletegateRegistation::create($dataArray);
        if(!empty($delegateRegId)){
            foreach ($delegates as $key => $value) {
                $value['delegate_reg_id'] = $delegateRegId->id;
                $status1 = Delegates::create($value);
            }
            $transitionData = array(
                "event_id" => $request->event_id,
                "ref_type"=> "Delegate",
                "ref_id"=>$delegateRegId->id,
                "UTR_number"=>"",
                "Cheque_receipt_number"=>"",
                "payment_status"=>"Pending",
                "payment_recevied"=>0,
                // "payment_date"=>"",
                "payment_mode" => 'Online'
            );
            $transitionStatus = Transactions::create($transitionData);

            if(!empty($transitionStatus)){
                $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
                $order = $api->order->create(array('receipt' => 'Membership form = '.substr($request->organization_name, 0, 10), 'amount' => $grandTotal * 100, 'currency' => 'INR'));
                return response()->json([
                    'data' => [
                        'type' => 'Member',
                        'message' => 'Member successfully created!',
                        'data' => $delegateRegId,
                        'amount' => $grandTotal,
                        'transition_id' => $transitionStatus->id,
                        'order_id' => $order['id']
                    ]
                ], 200);
            }else{
                return response()->json([
                    'data' => [
                        'type' => 'Member',
                        'message' => 'Something went Wrong',
                    ]
                ], 200);
            }
        }       
    }
    
    public function SpotToDelegateRegistration(Request $request)
    {
        $input = $request->all();

        // dd($input);
        // return response()->json([
        //     'data' => $input
        // ], 500);

        $event = Event::where("status", "1")->first();
        //  Delegate Insert
        $delegatesIds = array();
        $totlaDelegate = 0;
        $delegatePrice = getDelegatePrice($event);
        $delegates = array();
        if($request->dtype && count($request->dtype)>0){
            foreach ($request->dtype as $key => $value) {
                $per_delegate = 0;
                $per_delegate_tax = 0;
                if($request->dtype[$key] == 'paid'){
                    $per_delegate = $delegatePrice['amount'];
                    $per_delegate_tax = $delegatePrice['tax'];
                }
                // 'id', 'user_id', 'event_id', 'delegate_reg_id' ,'name', 'image', 'designation', 'status', 'mobile', 'email', 'per_delegate','per_delegate_tax', 'total_delegate', 'type'
                $delegates[] = array(
                    "name" => $request->dName[$key],
                    "event_id" => $request->event_id,
                    "email" => $request->demail[$key],
                    "dial_code" => $request->ddial_code[$key],
                    "mobile" =>$request->dmobile[$key],
                    "designation" =>$request->ddesignation[$key],
                    "delegate_types" => 'Guest',
                    "per_delegate"=> $per_delegate,
                    "per_delegate_tax"=>$per_delegate_tax,
                    "total_delegate"=> $per_delegate+$per_delegate_tax,
                    "type"=> $request->dtype[$key],
                    "status" => 0,
                );
                $totlaDelegate = $totlaDelegate+($per_delegate+$per_delegate_tax);
            };
        }

        // $diff = date_diff(date('Y-m-d hh:mm:ss', strtotime($request->checkin)),date('Y-m-d hh:mm:ss', strtotime($request->checkout)));
        $diff = date_diff(Carbon::parse($request->checkin),Carbon::parse($request->checkout));
        $roomtotal =0;
        if($diff->days!=0){
            $roomtotal = (($request->room_price+$request->room_price_tax)*$request->room_qty)*$diff->days;
        }else{
            $roomtotal = (($request->room_price+$request->room_price_tax)*$request->room_qty);
        }
       
        $grandTotal = $roomtotal + $totlaDelegate;

        // return response()->json([
        //     'totlaDelegate' => $totlaDelegate,
        //     'roomtotal' => $roomtotal,
        //     'grandTotal' => $grandTotal,
        //     'delegatePrice'=> $delegatePrice,
        //     'ddd' =>$diff->days
        // ], 500);
        $dataArray = array(
            "event_id" => $request->event_id,
            "deletegate_category" => $request->delegate_type,
            "organization_name" => $request->organization_name?$request->organization_name: $delegates[0]['name'],
            "GSTIN" => strtoupper($request->GSTIN),
            "address" => $request->address,
            "city" => $request->city,
            "state" => $request->state,
            "pin_code" => $request->pin_code,
            "tel_phone" => $request->tel_phone,
            "country" => $request->dial_code,
            "mobile_phone" => $request->mobile_phone,
            "email" => $request->email?$request->email: $delegates[0]['email'],
            "delegate_ids" => $delegatesIds,
            "total_delegate" =>$totlaDelegate,
            // "hotel_room_id" => $request->hotel_room_id,
            "hotal_name" => $request->hotal_name,
            "hotal_room_type" => $request->hotal_room_type,
            "checkin" => $request->checkin,
            "checkout" => $request->checkout,
            "room_qty" => $request->room_qty,
            "room_days" => strval($diff->days),
            "room_price" => $request->room_price,
            "room_price_tax" => $request->room_price_tax,
            "room_price_unit" => $request->room_price_unit,
            "room_total" => $roomtotal,
            "grand_total" => $grandTotal,
            "status" => 0
        );


        $delegateRegId = DeletegateRegistation::create($dataArray);
        if(!empty($delegateRegId)){
            foreach ($delegates as $key => $value) {
                $value['delegate_reg_id'] = $delegateRegId->id;
                $status1 = Delegates::create($value);
            }
            $transitionData = array(
                "event_id" => $request->event_id,
                "ref_type"=> "Delegate",
                "ref_id"=>$delegateRegId->id,
                "UTR_number"=>"",
                "Cheque_receipt_number"=>"",
                "payment_status"=>"Pending",
                "payment_recevied"=>0,
                // "payment_date"=>"",
                "payment_mode" => 'Online'
            );
            $transitionStatus = Transactions::create($transitionData);

            if(!empty($transitionStatus)){
                $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
                $order = $api->order->create(array('receipt' => 'Membership form = '.substr($request->organization_name, 0, 10), 'amount' => $grandTotal * 100, 'currency' => 'INR'));
                return response()->json([
                    'data' => [
                        'type' => 'Member',
                        'message' => 'Member successfully created!',
                        'data' => $delegateRegId,
                        'amount' => $grandTotal,
                        'transition_id' => $transitionStatus->id,
                        'order_id' => $order['id']
                    ]
                ], 200);
            }else{
                return response()->json([
                    'data' => [
                        'type' => 'Member',
                        'message' => 'Something went Wrong',
                    ]
                ], 200);
            }
        }       
    }



    public function Hotelreservation(Request $request)
    {
        $input = $request->all();

        $totalamount = 0;
        $event = Event::where("status", "1")->first();
        $hotelroom = HotelRoom::where("id", $input['hotel_room_id'])->first();

        $scectionlist = array();
        if($request->dName && count($request->dName)>0){
            foreach ($request->dName as $key => $value) {
                // $find = Delegates::where("email", $request->demail[$key])->first();

                $status1 = Delegates::create(array(
                    "name" => $value,
                    "event_id" => $request->event_id,
                    "email" => $request->demail[$key],
                    "mobile" =>$request->dmobile[$key],
                    "designation" =>$request->ddesignation[$key],
                    "delegate_types" => 'Guest',
                    "user_id" => session('Adminuser.id'),
                    "status" => 0,
                ));
                // dd($status1);
                if(!empty($status1)){
                    $scectionlist[] =  $status1->id;
                }
            };
        }



        $input['event_id'] = $event->id;
        $roomtotal = $hotelroom->amount+$hotelroom->amount_tax;
        $totalamount = $hotelroom->amount+$hotelroom->amount_tax + (count($scectionlist)*8850);
        $input['grand_total'] =$totalamount;
        $input['room_price'] =$roomtotal;
        // return response()->json([
        //     'data' => [
        //         'data' => $input,
        //         'type' => 'Member',
        //         'allready' => true,
        //         'message' => 'Email id allready exist, please connect with admin',
        //     ]
        // ], 200);
        
        
        // $user = User::where(["email"=> strtolower($request->register_address['email'])])->first();
        // if($user){
        //     return response()->json([
        //         'data' => [
        //             'type' => 'Member',
        //             'allready' => true,
        //             'message' => 'Email id allready exist, please connect with admin',
        //         ]
        //     ], 200);
        // }else{
            // $dataArray = array(
            //     "name" => $request->compnay,
            //     "email" => strtolower($request->register_address['email']),
            //     "password" => sha1($request->register_address['password']),
            //     "phone" => '',
            //     "phone_code" => '',
            //     "status" => 0,
            //     "role_name" => "User",
            // );
            
            // $status = User::create($dataArray);
            // if($status){
               $dataArray = array(
                "hotel_room_id" => $request->hotel_room_id,
                "event_id" => $event->id,
                "organization_name" => $request->organization_name,
                "GSTIN" => strtoupper($request->GSTIN),
                "address" => $request->address,
                "city" => $request->city,
                "state" => $request->state,
                "pin_code" => $request->pin_code,
                "tel_phone" => $request->tel_phone,
                "mobile_phone" => $request->mobile_phone,
                "email" => $request->email,
                "delegate_ids" => $scectionlist,
                "per_delegate" => "7500",
                "per_delegate_tax" => "1350",
                "total_delegate" => (count($scectionlist)*8850),
                "room_price" => $roomtotal,
                "room_price_unit" => $hotelroom->amount_unit,
                "grand_total" => $totalamount,
                "UTR_number" => $request->UTR_number?$request->UTR_number:'',
                "Cheque_receipt_number" => $request->Cheque_receipt_number?$request->Cheque_receipt_number:'',
                "payment_date" => now(),
                "payment_mode" =>'Online',
                "status" => 0,
                "payment_status" => "pendding",
                "payment_recevied" => "not recevied"
            );
            $status = DeletegateRegistation::create($dataArray);
            if($status){
                 $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
                $order = $api->order->create(array('receipt' => 'Membership form = '.substr($request->organization_name, 0, 10), 'amount' => $totalamount * 100, 'currency' => 'INR'));
                return response()->json([
                    'data' => [
                        'type' => 'Member',
                        'message' => 'Member successfully created!',
                        'data' => $status,
                        'order_id' => $order['id']
                    ]
                ], 200);

                // $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
                // $order = $api->order->create(array('receipt' => 'Membership form = '.$request->compnay, 'amount' => $totalamount * 100, 'currency' => $request->member_type == "foreign" ?'USD' :'INR'));
                // return response()->json([
                //     'data' => [
                //         'type' => 'Member',
                //         'message' => 'Member successfully created!',
                //         'data' => $create,
                //         'order_id' => $order['id']
                //     ]
                // ], 200);
            }else{
                return response()->json([
                    'data' => [
                        'type' => 'Member',
                        'message' => 'Email id allready exist',
                    ]
                ], 200);
            }
        
    }


    public function AdvertisementForm(Request $request)
    {
        $input = $request->all();

        // return response()->json([
        //     'data' => $input
        // ], 500);

        $event = Event::where("status", "1")->first();
        //  Delegate Insert
        $delegatesIds = array();
        $totlaDelegate = 0;
        $delegatePrice = getDelegatePrice($event);
        $delegates = array();
        if($request->dtype && count($request->dtype)>0){
            foreach ($request->dtype as $key => $value) {
                $per_delegate = 0;
                $per_delegate_tax = 0;
                if($request->dtype[$key] == 'paid'){
                    $per_delegate = $delegatePrice['amount'];
                    $per_delegate_tax = $delegatePrice['tax'];
                }
                // 'id', 'user_id', 'event_id', 'delegate_reg_id' ,'name', 'image', 'designation', 'status', 'mobile', 'email', 'per_delegate','per_delegate_tax', 'total_delegate', 'type'
                $delegates[] = array(
                    "name" => $request->dName[$key],
                    "event_id" => $request->event_id,
                    "email" => $request->demail[$key],
                    "dial_code" => $request->ddial_code[$key],
                    "mobile" =>$request->dmobile[$key],
                    "designation" =>$request->ddesignation[$key],
                    "delegate_types" => 'Guest',
                    "per_delegate"=> $per_delegate,
                    "per_delegate_tax"=>$per_delegate_tax,
                    "total_delegate"=> $per_delegate+$per_delegate_tax,
                    "type"=> $request->dtype[$key],
                    "status" => 0,
                );
                $totlaDelegate = $totlaDelegate+($per_delegate+$per_delegate_tax);
            };
        }

        // $diff = date_diff(date('Y-m-d hh:mm:ss', strtotime($request->checkin)),date('Y-m-d hh:mm:ss', strtotime($request->checkout)));
        $diff = date_diff(Carbon::parse($request->checkin),Carbon::parse($request->checkout));
        $roomtotal =0;
        if($diff->days!=0){
            $roomtotal = (($request->room_price+$request->room_price_tax)*$request->room_qty)*$diff->days;
        }else{
            $roomtotal = (($request->room_price+$request->room_price_tax)*$request->room_qty);
        }
       
        $grandTotal = $roomtotal + $totlaDelegate;

       
        $advertisement = Advertisement::find($request->advertisement_id);

        $advertise_amount = $advertisement->amount;
        $advertise_amount_tax = $advertisement->amount_tax;
        $advertise_total = $advertisement->amount+$advertisement->amount_tax;
        $grandTotalWithAdvertiseTotal = 0;
        // foreach ($stalls as $key => $value) {
        //     $stall_amount = $stall_amount+$value->amount;
        //     $stall_amount_tax = $stall_amount_tax+$value->tax;
        //     $stall_total = $stall_total + $value->amount+$value->tax;
        // }
        $grandTotalWithAdvertiseTotal = $grandTotal+$advertise_total;

        // return response()->json([
        //     'roomtotal' => $roomtotal,
        //     'totlaDelegate' => $totlaDelegate,
        //     'grandTotal' => $grandTotal,
        //     'advertise_total' => $advertise_total,
        //     'advertisement'=>$advertisement,
        //     'grandTotalWithAdvertiseTotal'=>$grandTotalWithAdvertiseTotal
        // ], 500);



        // return response()->json([
        //     'totlaDelegate' => $totlaDelegate,
        //     'roomtotal' => $roomtotal,
        //     'grandTotal' => $grandTotal,
        //     'delegatePrice'=> $delegatePrice,
        //     'advertise_amount'=>$advertise_amount,
        //     'advertise_amount_tax'=>$advertise_amount_tax,
        //     'advertise_total'=>$advertise_total,
        //     'grandTotalWithAdvertiseTotal'=> $grandTotalWithAdvertiseTotal
        // ], 500);


        $dataArray = array(
            "event_id" => $request->event_id,
            "deletegate_category" => $request->delegate_type,
            "organization_name" => $request->organization_name?$request->organization_name: $delegates[0]['name'],
            "GSTIN" => strtoupper($request->GSTIN),
            "address" => $request->address,
            "city" => $request->city,
            "state" => $request->state,
            "pin_code" => $request->pin_code,
            "tel_phone" => $request->tel_phone,
            "country" => $request->dial_code?$request->dial_code:$delegates[0]['dial_code'],
            "mobile_phone" => $request->mobile_phone?$request->mobile_phone:$delegates[0]['mobile'],
            "email" => $request->email?$request->email: $delegates[0]['email'],
            "delegate_ids" => $delegatesIds,
            "total_delegate" =>$totlaDelegate,
            // "hotel_room_id" => $request->hotel_room_id,
            "hotal_name" => $request->hotal_name,
            "hotal_room_type" => $request->hotal_room_type,
            "checkin" => $request->checkin,
            "checkout" => $request->checkout,
            "room_qty" => $request->room_qty,
            "room_days" => strval($diff->days),
            "room_price" => $request->room_price,
            "room_price_tax" => $request->room_price_tax,
            "room_price_unit" => $request->room_price_unit,
            "room_total" => $roomtotal,
            "grand_total" => $grandTotal,
            "status" => 0
        );
        // dd($dataArray);

        $delegateRegId = DeletegateRegistation::create($dataArray);


        // $dataArray = array(
        //     "event_id" => $request->event_id,
        //     "organization_name" => $request->organization_name?$request->organization_name: $delegates[0]['name'],
        //     "deletegate_category" => $request->delegate_type,
        //     "GSTIN" => strtoupper($request->GSTIN),
        //     "address" => $request->address,
        //     "city" => $request->city,
        //     "state" => $request->state,
        //     "pin_code" => $request->pin_code,
        //     "tel_phone" => $request->tel_phone,
        //     "country" => $request->dial_code,
        //     "mobile_phone" => $request->mobile_phone?$request->mobile_phone:$delegates[0]['mobile'],
        //     "email" => $request->email?$request->email:$delegates[0]['email'],
        //     "delegate_ids" => $delegatesIds,
        //     "total_delegate" =>$totlaDelegate,
        //     // "hotel_room_id" => $request->hotel_room_id,
        //     "hotal_name" => $request->hotal_name,
        //     "hotal_room_type" => $request->hotal_room_type,
        //     "checkin" => $request->checkin,
        //     "checkout" => $request->checkout,
        //     "room_qty" => $request->room_qty,
        //     "room_days" => strval($diff->days),
        //     "room_price" => $request->room_price,
        //     "room_price_tax" => $request->room_price_tax,
        //     "room_price_unit" => $request->room_price_unit,
        //     "room_total" => $roomtotal,
        //     "grand_total" => $grandTotal,
        //     "status" => '1'
        // );
        // $delegateRegId = DeletegateRegistation::create($dataArray);


        if(!empty($delegateRegId)){
            foreach ($delegates as $key => $value) {
                $value['delegate_reg_id'] = $delegateRegId->id;
                $status1 = Delegates::create($value);
            }

            $imagename = '';
            if($request->hasfile('attechment')){
                $image = $request->file('attechment');
                $imagename = time().'.'.$request->attechment->extension();
                $destinationPath = public_path('images/attechment');
                $image->move($destinationPath, $imagename);
            }

            $advertisementData = array(
                'event_id'=>$request->event_id,
                'delegate_reg_id'=>$delegateRegId->id,
                'status'=>0,
                'advertisement_id'=>$request->advertisement_id,
                'amount'=>$advertise_amount,
                'tax'=>$advertise_amount_tax,
                'advertisement_total'=>$advertise_total,
                'file'=>$imagename,
                'grand_total'=>$grandTotalWithAdvertiseTotal
            );
            
            $advertisementStatus = AdvertisementRelease::create($advertisementData);
            $transitionData = array(
                "event_id" => $request->event_id,
                "ref_type"=> "Advertiser",
                "ref_id"=>$advertisementStatus->id,
                "UTR_number"=>"",
                "Cheque_receipt_number"=>"",
                "payment_status"=>"Pending",
                "payment_recevied"=>0,
                // "payment_date"=>"",
                "payment_mode" => 'Online'
            );
            $transitionStatus = Transactions::create($transitionData);

            if(!empty($advertisementStatus) && !empty($transitionStatus)){
                $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
                $order = $api->order->create(array('receipt' => 'Membership form = '.substr($request->organization_name, 0, 10), 'amount' => $grandTotalWithAdvertiseTotal * 100, 'currency' => 'INR'));
                return response()->json([
                    'data' => [
                        'type' => 'Member',
                        'message' => 'Member successfully created!',
                        'data' => $advertisementStatus->id,
                        'amount' => $grandTotalWithAdvertiseTotal,
                        'transition_id' => $transitionStatus->id,
                        'order_id' => $order['id']
                    ]
                ], 200);
            }else{
                return response()->json([
                    'data' => [
                        'type' => 'Member',
                        'message' => 'Something went Wrong',
                    ]
                ], 200);
            }
        }
    }


    public function ExibihitionBooking(Request $request)
    {

        $input = $request->all();

        // return response()->json([
        //     'data' => $input
        // ], 500);
        //return $input;
        $event = Event::where("status", "1")->first();
        //  Delegate Insert
        $delegatesIds = array();
        $totlaDelegate = 0;
        $delegatePrice = getDelegatePrice($event);
        $delegates = array();
        if($request->dtype && count($request->dtype)>0){
            foreach ($request->dtype as $key => $value) {
                $per_delegate = 0;
                $per_delegate_tax = 0;
                if($request->dtype[$key] == 'paid'){
                    $per_delegate = $delegatePrice['amount'];
                    $per_delegate_tax = $delegatePrice['tax'];
                }
                // 'id', 'user_id', 'event_id', 'delegate_reg_id' ,'name', 'image', 'designation', 'status', 'mobile', 'email', 'per_delegate','per_delegate_tax', 'total_delegate', 'type'
                $delegates[] = array(
                    "name" => $request->dName[$key],
                    "event_id" => $request->event_id,
                    "email" => $request->demail[$key],
                    "dial_code" => $request->ddial_code[$key],
                    "mobile" =>$request->dmobile[$key],
                    "designation" =>$request->ddesignation[$key],
                    "delegate_types" => 'Guest',
                    "per_delegate"=> $per_delegate,
                    "per_delegate_tax"=>$per_delegate_tax,
                    "total_delegate"=> $per_delegate+$per_delegate_tax,
                    "type"=> $request->dtype[$key],
                    "status" => 0,
                );
                $totlaDelegate = $totlaDelegate+($per_delegate+$per_delegate_tax);
            };
        }

        // $diff = date_diff(date('Y-m-d hh:mm:ss', strtotime($request->checkin)),date('Y-m-d hh:mm:ss', strtotime($request->checkout)));
        $diff = date_diff(Carbon::parse($request->checkin),Carbon::parse($request->checkout));
        $roomtotal =0;
        if($diff->days!=0){
            $roomtotal = (($request->room_price+$request->room_price_tax)*$request->room_qty)*$diff->days;
        }else{
            $roomtotal = (($request->room_price+$request->room_price_tax)*$request->room_qty);
        }
       
        $grandTotal = $roomtotal + $totlaDelegate;

        $stall_amount = 0;
        $stall_amount_tax = 0;
        $stall_total = 0;
        $grandTotalWithStallTital = 0;
        $stalls = json_decode($request->stalls);
        foreach ($stalls as $key => $value) {
            $stall_amount = $stall_amount+$value->amount;
            $stall_amount_tax = $stall_amount_tax+$value->tax;
            $stall_total = $stall_total + $value->amount+$value->tax;
        }
        $grandTotalWithStallTital = $grandTotal+$stall_total;

        // return response()->json([
        //     'totlaDelegate' => $totlaDelegate,
        //     'roomtotal' => $roomtotal,
        //     'grandTotal' => $grandTotal,
        //     'delegatePrice'=> $delegatePrice,
        //     'stall_amount'=>$stall_amount,
        //     'stall_amount_tax'=>$stall_amount_tax,
        //     'stall_total'=>$stall_total,
        //     'grandTotalWithStallTital'=> $grandTotalWithStallTital

        // $request->mobile_phone        // ], 500);

        $dataArray = array(
            "event_id" => $request->event_id,
            "organization_name" => $request->organization_name?$request->organization_name:$delegates[0]['name'],
            "deletegate_category" => $request->delegate_type,
            "GSTIN" => strtoupper($request->GSTIN),
            "address" => $request->address,
            "city" => $request->city,
            "state" => $request->state,
            "pin_code" => $request->pin_code,
            "tel_phone" => $request->tel_phone,
            "country" => $request->dial_code?$request->dial_code:$delegates[0]['dial_code'],
            "mobile_phone" => $request->mobile_phone? $request->mobile_phone:$delegates[0]['mobile'],
            "email" => $request->email?$request->email:$delegates[0]['email'],
            "delegate_ids" => $delegatesIds,
            "total_delegate" =>$totlaDelegate,
            // "hotel_room_id" => $request->hotel_room_id,
            "hotal_name" => $request->hotal_name,
            "hotal_room_type" => $request->hotal_room_type,
            "checkin" => $request->checkin,
            "checkout" => $request->checkout,
            "room_qty" => $request->room_qty,
            "room_days" => strval($diff->days),
            "room_price" => $request->room_price,
            "room_price_tax" => $request->room_price_tax,
            "room_price_unit" => $request->room_price_unit,
            "room_total" => $roomtotal,
            "grand_total" => $grandTotal,
            "status" => 0
        );

        $delegateRegId = DeletegateRegistation::create($dataArray);
        if(!empty($delegateRegId)){
            foreach ($delegates as $key => $value) {
                $value['delegate_reg_id'] = $delegateRegId->id;
                $status1 = Delegates::create($value);
            }
            $stallsData = array(
                'event_id'=>$request->event_id,
                'delegate_reg_id'=>$delegateRegId->id,
                'status'=>0,
                'stalls'=>$stalls,
                'amount'=>$stall_amount,
                'tax'=>$stall_amount_tax,
                'stall_total'=>$stall_total,
                'grand_total'=>$grandTotalWithStallTital
            );
            
            $stallStatus = ExhibitionStallBooking::create($stallsData);
            $transitionData = array(
                "event_id" => $request->event_id,
                "ref_type"=> "Exhibitor",
                "ref_id"=>$stallStatus->id,
                "UTR_number"=>"",
                "Cheque_receipt_number"=>"",
                "payment_status"=>"Pending",
                "payment_recevied"=>0,
                // "payment_date"=>"",
                "payment_mode" => 'Online'
            );

            $transitionStatus = Transactions::create($transitionData);

            if(!empty($stallStatus) && !empty($transitionStatus)){
                $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
                $order = $api->order->create(array('receipt' => 'Membership form = '.substr($request->organization_name, 0, 10), 'amount' => $grandTotalWithStallTital * 100, 'currency' => 'INR'));
                return response()->json([
                    'data' => [
                        'type' => 'Member',
                        'message' => 'Member successfully created!',
                        'data' => $stallStatus->id,
                        'amount' => $grandTotalWithStallTital,
                        'transition_id' => $transitionStatus->id,
                        'order_id' => $order['id']
                    ]
                ], 200);
            }else{
                return response()->json([
                    'data' => [
                        'type' => 'Member',
                        'message' => 'Something went Wrong',
                    ]
                ], 200);
            }
        }
    }

    public function ExportDelegates(Request $request)
    {
        $query = Delegates::where('status', '1')->with('deletegateRegistation')->orderBy('created_at', 'desc')->get();
        return response()->json($query, 200);
    }
    
    public function ExportRooms(Request $request)
    {
        $query = DeletegateRegistation::where('status', '1')->where('room_qty', '>', 0)->orderBy('created_at', 'desc')->get();
        return response()->json($query, 200);
    }
    
    public function ExportDeletegateRegistation(Request $request)
    {
        $query = DeletegateRegistation::where('status', '1')->orderBy('created_at', 'desc')->get();
        return response()->json($query, 200);
    }
    
    public function getTransition(Request $request)
    {
        $query = Transactions::where('status', '1')->where('ref_id', $request->id)->orderBy('created_at', 'desc')->get();
        return response()->json($query, 200);
    }

    public function ExportStalls(Request $request)
    {
        $query = ExhibitionStallBooking::where('status', '1')->with('deletegateRegistation')->orderBy('created_at', 'desc')->get();
        return response()->json($query, 200);
    }

    public function ExportAdvertisement(Request $request)
    {
        $query = AdvertisementRelease::where('status', '1')->with('advertisement')->with('deletegateRegistation')->orderBy('created_at', 'desc')->get();
        return response()->json($query, 200);
    }
    
    
    public function BadgePrintAction(string $id)
    {
        $spotReg = Delegates::find($id);
        $spotReg->batch_assign = '2';
        $spotReg->save();
        return response()->json([
            'data' => $spotReg,
            'status' => true
        ], 200);
        
    }

}
