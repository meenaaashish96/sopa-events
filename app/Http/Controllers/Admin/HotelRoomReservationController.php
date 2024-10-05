<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ExportDeletegateRegistation;
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
use Maatwebsite\Excel\Facades\Excel;

class HotelRoomReservationController extends Controller
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
                $query = DeletegateRegistation::query()->with('user')->where('title','LIKE','%'.$title.'%')->where('room_qty', '>', 0);
            }else{
                $query = DeletegateRegistation::query()->with('user')->where('room_qty', '>', 0);
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
        return view('Admin.pages.hotelroomreservation')->with(compact('data', 'title'));
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
        $mindate = Carbon::parse($events->start_date)->subDays(2);
        $maxdate = Carbon::parse($events->end_date)->addDays(2);
        // dd($events, $mindate, $maxdate);
        return view('Admin.pages.adddeletegateregistation')->with(compact('events', 'hotelrooms', 'delegatePrice', 'mindate', 'maxdate')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        
        $validated = $request->validate([
            // 'organization_name' => 'required',
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

        $dataArray = array(
            "event_id" => $request->event_id,
            "organization_name" => $request->organization_name?$request->organization_name: $delegates[0]['name'],
            "deletegate_category" => $request->delegate_type,
            "GSTIN" => strtoupper($request->GSTIN),
            "address" => $request->address,
            "city" => $request->city,
            "state" => $request->state,
            "pin_code" => $request->pin_code,
            "tel_phone" => $request->tel_phone,
            "mobile_phone" => $request->mobile_phone,
            "country" => $request->dial_code,
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
            "status" => '1'
        );

        $transitionData = array(
            "event_id" => $request->event_id,
            "ref_type"=> "Delegate",
            "ref_id"=>'',
            "UTR_number"=>$request->UTR_number,
            "Cheque_receipt_number"=>$request->Cheque_receipt_number,
            "payment_status"=>"completed",
            "payment_recevied"=>$request->received_payment,
            "payment_date"=>$request->payment_date,
            "payment_mode" => $request->payment_mode? $request->payment_mode:'offline'
        );

        $delegateRegId = DeletegateRegistation::create($dataArray);
        if(!empty($delegateRegId)){
            foreach ($delegates as $key => $value) {
                $value['delegate_reg_id'] = $delegateRegId->id;
                $status1 = Delegates::create($value);
            }
            $transitionData['ref_id'] = $delegateRegId->id;
            $transitionStatus = Transactions::create($transitionData);
            // dd($transitionStatus);
            if($transitionStatus){
                return  redirect('sopa/admin/delegates/registations')->with('status', 'Delegates Reservation has been created.');
            }else{
                return  redirect('sopa/admin/delegates/registations/add')->with('status', 'Delegates Reservation not created.');
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
        $events = Event::where('status', '1')->first();
        $hotelrooms = HotelRoom::where('status', '1')->get();
        $delegatePrice = getDelegatePrice($events);
        $mindate = Carbon::parse($events->start_date)->subDays(2);
        $maxdate = Carbon::parse($events->end_date)->addDays(2);
        $delegetsRegistation = DeletegateRegistation::find($id);
        $delegets = Delegates::where("delegate_reg_id", $id)->get();
        $transations = Transactions::where("ref_id", $id)->get();
        $freedelegets = 0;
        $paiddelegets = 0;
        $delegetsTax = 0;
        $delegetsTotal = 0;
        foreach ($delegets as $key => $value) {
            if($value->type == 'free'){
                $freedelegets = $freedelegets+1;
            }else{
                $paiddelegets = $paiddelegets+1;
                $delegetsTax = $delegetsTax + $value->per_delegate_tax;
                $delegetsTotal = $delegetsTax + $value->per_delegate;
            }
        }
        $delegetsClc = array(
            'freedelegets'=> $freedelegets,
            'paiddelegets'=> $paiddelegets,
            'delegetsTax'=> $delegetsTax,
            'delegetsTotal'=> $delegetsTotal,
            'grand_total'=> $delegetsRegistation->total_delegate
        );
        // dd($delegets);
        return view('Admin.pages.updatedelegatesregistations')->with(compact('delegetsRegistation', 'events', 'hotelrooms', 'transations', 'delegets', 'delegatePrice', 'mindate', 'maxdate', 'delegetsClc'));
    }


    public function view($id)
    {
        // dd($id);
        // $events = Event::where('status', '1')->get();
        $deletegateregistation = DeletegateRegistation::find($id);
        // dd($hotelroomreservation);
        $delegets = Delegates::where("delegate_reg_id", $id)->get();
        $freedelegets = 0;
        $paiddelegets = 0;
        $delegetsTax = 0;
        $delegetsTotal = 0;
        foreach ($delegets as $key => $value) {
            if($value->type == 'free'){
                $freedelegets = $freedelegets+1;
            }else{
                $paiddelegets = $paiddelegets+1;
                $delegetsTax = $delegetsTax + $value->per_delegate_tax;
                $delegetsTotal = $delegetsTax + $value->per_delegate;
            }
        }
        $delegetsClc = array(
            'freedelegets'=> $freedelegets,
            'paiddelegets'=> $paiddelegets,
            'delegetsTax'=> $delegetsTax,
            'delegetsTotal'=> $delegetsTotal,
            'grand_total'=> $deletegateregistation->total_delegate
        );
        $transations = Transactions::where("ref_id", $id)->where("ref_type", 'Delegate')->get();
        // dd($delegets );
        return view('Admin.pages.viewdeletegateregistation')->with(compact('deletegateregistation', 'delegets', 'transations', 'delegetsClc'));
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
        $deletegateRegistation = DeletegateRegistation::find($id);
        
        // dd($request);
        if($request->dtype && count($request->dtype)>0){
            foreach ($request->dtype as $key => $value) {
                
                $delegate = Delegates::find($request->did[$key]);
                // dd($delegate);
                $delegate->name = $request->dName[$key];
                $delegate->email = $request->demail[$key];
                $delegate->dial_code = $request->ddial_code[$key];
                $delegate->mobile = $request->dmobile[$key];
                $delegate->designation = $request->ddesignation[$key];
                // $delegate->type = $request->dtype[$key];
                $delegate->save();
            };
        }
 
    $deletegateRegistation->organization_name = $request->organization_name;
        $deletegateRegistation->GSTIN = strtoupper($request->GSTIN);
        $deletegateRegistation->address = $request->address;
        $deletegateRegistation->city = $request->city;
        $deletegateRegistation->state = $request->state;
        $deletegateRegistation->pin_code = $request->pin_code;
        $deletegateRegistation->mobile_phone = $request->mobile_phone;
        $deletegateRegistation->tel_phone = $request->tel_phone;
        $deletegateRegistation->email = $request->email;
        $deletegateRegistation->deletegate_category = $request->delegate_type;
        $deletegateRegistation->user_id = session('Adminuser.id');
        $deletegateRegistation->save();
        return redirect('sopa/admin/delegates/registations')->with('status', 'DeletegateRegistation has been created.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = DeletegateRegistation::find($id);
        // if(file_exists(public_path('images/hotelroom').'/'.$event->image)){
        //     unlink(public_path('images/hotelroom').'/'.$event->image);
        // }
        $event->delete();
        return back()->with('events_deleted', 'DeletegateRegistation deleted Successfully');
    }

    public function status($id)
    {
        $event = DeletegateRegistation::find($id);
        if($event->status == '1'){
            $event->status = '0';
        }else{
            $event->status = '1';
        }
        $event->save();
        return back()->with('events_deleted', 'DeletegateRegistation deleted Successfully');
    }

    public function BulkUpload(Request $request)
    {
        return  Excel::download(new ExportDeletegateRegistation, 'deletegateRegistations.xlsx');
             
        // return back();

    }
}