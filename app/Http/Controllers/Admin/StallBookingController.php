<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Delegates;
use App\Models\DeletegateRegistation;
use App\Models\Event;
use App\Models\HotelRoom;
use App\Models\Stall;
use App\Models\AdvertisementRelease;
use App\Models\Advertisement;
use App\Models\ExhibitionStallBooking;
use App\Models\StallLayouts;
use App\Models\StallLayoutCells;
use App\Models\Transactions;

use Carbon\Carbon;
use Illuminate\Http\Request;



class StallBookingController extends Controller
{
    public function index(Request $request){
        try { 
            $title = $request->title;
            $perPage = $request->input('per_page', 100000);
            $operations = $request->input('operations', []);
            $select = $request->input('select', []);
            $status = $request->input('status', null);
            $orderBy = $request->input('order_by', 'created_at');
            $orderType = $request->input('order_type', 'desc');
            $groupBy = $request->input('group_by', null);
            $returnType = $request->input('return_type', 'data');
            $with = $request->input('with', '');
            if(!empty($title)){
                $query = ExhibitionStallBooking::query()->with('user', 'deletegateRegistation')->where('title','LIKE','%'.$title.'%')->where('status', 1);
            }else{
                $query = ExhibitionStallBooking::query()->with('user', 'deletegateRegistation')->where('status', 1);
            }
            
            $query->when($select, function ($q) use ($select) {
                return $q->select($select);
            });
            // $query = addOperationsInQuery($query, $operations);
            $query->when($groupBy, function ($q) use ($groupBy) {
                return $q->groupBy($groupBy);
            });
            $query->when($status, function ($q) use ($status) {
                return $q->where("status", $status);
            });
            $query->when($orderBy, function ($q) use ($orderBy, $orderType) {
                return $q->orderBy($orderBy, $orderType);
            });
            if($returnType == 'count') {
                $data = $query->count();
            } else {
                $data = $query->paginate($perPage);
                
                if ($with) {
                    // $with = explode(',', $with);
                    $data->load($with);
                }
            }   
        }  catch(\Illuminate\Database\QueryException $ex) {
            return response()->json([
                'status' => 'fail',
                'data' => [],
                'errors' => [$ex->getMessage()],
                'hasError' => true
            ], 500);
            
        }
        // dd($data);
        return view('Admin.pages.stallbooking')->with(compact('data', 'title'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        $events = Event::where('status', '1')->first();
        $hotelrooms = HotelRoom::where('status', '1')->get();
        $delegatePrice = getDelegatePrice($events);
        $stalls = Stall::where('status', '1')->get();
        $stalllayout = StallLayouts::where('status', '1')->where('event_id', $events->id)->first();
        $stallGrids = array();
        if(!empty($stalllayout)){
            $stallGrids = StallLayoutCells::where('layout_id', $stalllayout->id)->with(['stall'])->get();
        }
        $booking = ExhibitionStallBooking::where('status', '1')->get();
        $bookedStall = array();
        // dd($booking);
        foreach ($booking as $key => $value) {
            foreach ($value->stalls as $key => $stall) {
                array_push($bookedStall,$stall['stall']);
            }
        }
        $mindate = Carbon::parse($events->start_date)->subDays(2);
        $maxdate = Carbon::parse($events->end_date)->addDays(2);

        return view('Admin.pages.addstallbooking')->with(compact('events', 'hotelrooms', 'stalls', 'delegatePrice', 'mindate', 'maxdate', 'stalllayout', 'stallGrids', 'bookedStall')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'organization_name' => 'required',
            'event_id' => 'required',
            // 'mobile_phone'=> 'required',
            // 'email' => 'required'
        ]);
        
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
                    "mobile" =>$request->dmobile[$key],
                    "dial_code" => $request->ddial_code[$key],
                    "designation" =>$request->ddesignation[$key],
                    "delegate_types" => 'Guest',
                    "per_delegate"=> $per_delegate,
                    "per_delegate_tax"=>$per_delegate_tax,
                    "total_delegate"=> $per_delegate+$per_delegate_tax,
                    "type"=> $request->dtype[$key],
                    "status" => '1',
                );
                $totlaDelegate = $totlaDelegate+($per_delegate+$per_delegate_tax);
            };
        }

        $diff = date_diff(Carbon::parse($request->checkin),Carbon::parse($request->checkout));
        $roomtotal = (($request->room_price+$request->room_price_tax)*$request->room_qty)*$diff->days;
        $grandTotal = $roomtotal + $totlaDelegate;


        $selectedStalls = json_decode($request->stalls);

        $stall_amount = 0;
        $stall_amount_tax = 0;
        $stall_total = 0;
        $grandTotalWithStallTital = 0;
        foreach ($selectedStalls as $key => $value) {
            $stall_amount = $stall_amount+$value->amount;
            $stall_amount_tax = $stall_amount_tax+$value->tax;
            $stall_total = $stall_total + $value->amount+$value->tax;
        }
        $grandTotalWithStallTital = $grandTotal+$stall_total;

    
        // dd(array(
        //     'stall'=> $request->stall,
        //     'stalls'=> json_decode($request->stalls),
        //     'totlaDelegate' => $totlaDelegate,
        //     'roomtotal' => $roomtotal,
        //     'grandTotal' => $grandTotal,
        //     'delegatePrice'=> $delegatePrice,
        //     'stall_amount'=>$stall_amount,
        //     'stall_amount_tax'=>$stall_amount_tax,
        //     'stall_total'=>$stall_total,
        //     'grandTotalWithStallTital'=> $grandTotalWithStallTital));

        $dataArray = array(
            "event_id" => $request->event_id,
            "organization_name" => $request->organization_name,
            "deletegate_category" => $request->delegate_type,
            "GSTIN" => strtoupper($request->GSTIN),
            "address" => $request->address,
            "city" => $request->city,
            "state" => $request->state,
            "pin_code" => $request->pin_code,
            "tel_phone" => $request->tel_phone,
            "mobile_phone" => $request->mobile_phone,
            "country" => $request->dial_code,
            "email" => $request->email,
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
            "status" => '1'
        );

        $transitionData = array(
            "event_id" => $request->event_id,
            "ref_type"=> $request->delegate_type,
            "ref_id"=>'',
            "UTR_number"=>$request->UTR_number,
            "Cheque_receipt_number"=>$request->Cheque_receipt_number,
            "payment_status"=>"completed",
            "payment_recevied"=>$request->received_payment,
            "payment_date"=>$request->payment_date,
            "payment_mode" => $request->payment_mode
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
                'status'=>'1',
                'stalls'=>$selectedStalls,
                'amount'=>$stall_amount,
                'tax'=>$stall_amount_tax,
                'stall_total'=>$stall_total,
                'grand_total'=>$grandTotalWithStallTital
            );
            
            $stallStatus = ExhibitionStallBooking::create($stallsData);
            if($request->delegate_type == 'Sponsors'){
                $transitionData['ref_id'] = $delegateRegId->id;            
            }else{
                $transitionData['ref_id'] = $stallStatus->id;                
            }

            $transitionStatus = Transactions::create($transitionData);
            if($transitionStatus){
                return  redirect('sopa/admin/stall/booking')->with('status', 'Delegates Reservation has been created.');
            }else{
                return  redirect('sopa/admin/stall/booking/add')->with('status', 'Delegates Reservation not created.');
            }
        }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($status)
    {
        // return view('Admin.pages.addcategory')->with(compact('status'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        $events = Event::where('status', '1')->get();
        $exhibition = ExhibitionStallBooking::find($id);
        $deletegateregistation = DeletegateRegistation::find($exhibition->delegate_reg_id);
        // dd($hotelroomreservation);
        $delegets = Delegates::where("delegate_reg_id", $exhibition->delegate_reg_id)->get();
        $transations = Transactions::where("ref_id", $id)->where("ref_type", 'Exhibitor')->get();
        return view('Admin.pages.updatestallbooking')->with(compact('exhibition', 'deletegateregistation', 'delegets', 'transations'));
    }

    public function view($id)
    {
        // dd($id);
        // $events = Event::where('status', '1')->get();
        $exhibition = ExhibitionStallBooking::find($id);
        $deletegateregistation = DeletegateRegistation::find($exhibition->delegate_reg_id);
        // dd($hotelroomreservation);
        $delegets = Delegates::where("delegate_reg_id", $exhibition->delegate_reg_id)->get();
        $transations = Transactions::where("ref_id", $id)->where("ref_type", 'Exhibitor')->get();
        // dd($delegets );
        return view('Admin.pages.viewstallbooking')->with(compact('exhibition', 'deletegateregistation', 'delegets', 'transations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $event = ExhibitionStallBooking::find($id);

        $scectionlist = array();
        if($request->dName && count($request->dName)>0){
            foreach ($request->dName as $key => $value) {

                if(!empty($request->did[$key])){
                    $find = Delegates::find($request->did[$key]);
                    $find->name =  $value;
                    $find->email =  $request->demail[$key];
                    $find->mobile = $request->dmobile[$key];
                    $find->designation =  $request->ddesignation[$key];
                    $find->save();
                    $scectionlist[] =  $find->id;
                }else{
                    $status1 = Delegates::create(array(
                        "name" => $value,
                        "event_id" => $request->event_id,
                        "email" => $request->demail[$key],
                        "mobile" =>$request->dmobile[$key],
                        "designation" =>$request->ddesignation[$key],
                        "delegate_types" => 'Guest',
                        "user_id" => session('Adminuser.id'),
                        "status" => '1',
                    ));
                    // dd($status1);
                    if(!empty($status1)){
                        $scectionlist[] =  $status1->id;
                    }
                }
                
            };
        }
    
        $stall = Stall::find($request->stall_id);
        // dd( $hotelroom);
        $grandTotal = $stall->stall_price+$stall->stall_tax + (count($scectionlist)*8850);

        // , 'stall_id', 'stall_number', 'stall_price'
        // ,'stall_tax'

 
        $event->hotel_room_reservation_id = $request->hotel_room_reservation_id;
        $event->event_id = $request->event_id;
        $event->organization_name = $request->organization_name;
        $event->GSTIN = strtoupper($request->GSTIN);
        $event->address = $request->address;
        $event->city = $request->city;
        $event->state = $request->state;
        $event->pin_code = $request->pin_code;
        $event->mobile_phone = $request->mobile_phone;
        $event->tel_phone = $request->tel_phone;
        $event->email = $request->email;
        $event->delegate_ids = $scectionlist;
        $event->total_delegate = (count($scectionlist)*8850);
        $event->stall_id = $stall->stall_id;
        $event->stall_number = $stall->stall_number;
        $event->stall_price = $stall->stall_price;
        $event->stall_tax = $stall->stall_tax;
        $event->grand_total = $grandTotal;
        $event->UTR_number = $request->UTR_number;
        $event->Cheque_receipt_number = $request->Cheque_receipt_number;
        $event->payment_date = $request->payment_date;
        $event->payment_mode = $request->payment_mode;

        $event->user_id = session('Adminuser.id');
        $event->save();
        return redirect('sopa/admin/stall/booking')->with('status', 'ExhibitionStallBooking has been created.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = ExhibitionStallBooking::find($id);
        // if(file_exists(public_path('images/hotelroom').'/'.$event->image)){
        //     unlink(public_path('images/hotelroom').'/'.$event->image);
        // }
        $event->delete();
        return back()->with('events_deleted', 'ExhibitionStallBooking deleted Successfully');
    }

    public function status($id)
    {
        $event = ExhibitionStallBooking::find($id);
        if($event->status == '1'){
            $event->status = '0';
        }else{
            $event->status = '1';
        }
        $event->save();
        return back()->with('events_deleted', 'ExhibitionStallBooking deleted Successfully');
    }

    public function BulkUpload(Request $request)
    {
        Excel::import(new UsersImport,request()->file('file'));
             
        return back();

    }
}