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
use App\Models\Transactions;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdvertisementReleaseController extends Controller
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
                $query = AdvertisementRelease::query()->with('user', 'advertisement',  'deletegateRegistation')->where('title','LIKE','%'.$title.'%')->where('status', 1);
            }else{
                $query = AdvertisementRelease::query()->with('user', 'advertisement', 'deletegateRegistation')->where('status', 1);
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
        return view('Admin.pages.advertisementrelease')->with(compact('data', 'title'));
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
        $advertisements = Advertisement::where('status', '1')->get();
        $mindate = Carbon::parse($events->start_date)->subDays(2);
        $maxdate = Carbon::parse($events->end_date)->addDays(2);
        $advertisementRelease = AdvertisementRelease::where('status', '1')->get(); 
        $advertisementIds = array();
        foreach ($advertisementRelease as $key => $value) {
            array_push($advertisementIds, $value->advertisement_id);
        }
        $countedValues = array_count_values($advertisementIds); 
 
        // foreach ($countedValues as $key => $value) { 
        //     if ($value > 1) { 
        //         echo "$key appears $value times\n"; 
        //     } 
        // } 

        return view('Admin.pages.addadvertisementrelease')->with(compact('events', 'hotelrooms', 'delegatePrice', 'advertisements', 'mindate', 'maxdate', 'countedValues')); 
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

        $advertisement = Advertisement::find($request->advertisement_id);

        $advertise_amount = $advertisement->amount;
        $advertise_amount_tax = $advertisement->amount_tax;
        $advertise_total = $advertisement->amount+$advertisement->amount_tax;
        $grandTotalWithAdvertiseTotal = 0;
        $grandTotalWithAdvertiseTotal = $grandTotal+$advertise_total;


        // dd(array('totlaDelegate' => $totlaDelegate,
        // 'roomtotal' => $roomtotal,
        // 'grandTotal' => $grandTotal,
        // 'delegatePrice'=> $delegatePrice,
        // 'advertise_amount'=>$advertise_amount,
        // 'advertise_amount_tax'=>$advertise_amount_tax,
        // 'advertise_total'=>$advertise_total,
        // 'grandTotalWithAdvertiseTotal'=> $grandTotalWithAdvertiseTotal));

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
                'status'=>'1',
                'advertisement_id'=>$request->advertisement_id,
                'amount'=>$advertise_amount,
                'tax'=>$advertise_amount_tax,
                'advertisement_total'=>$advertise_total,
                'file'=>$imagename,
                'grand_total'=>$grandTotalWithAdvertiseTotal
            );
            $advertisementStatus = AdvertisementRelease::create($advertisementData);
            // dd($advertisementStatus);
            if($advertisementStatus){
                if($request->delegate_type == 'Sponsors'){
                    $transitionData['ref_id'] = $delegateRegId->id;            
                }else{
                    $transitionData['ref_id'] = $advertisementStatus->id;                
                }
                $transitionStatus = Transactions::create($transitionData);
                if($transitionStatus){
                    return  redirect('sopa/admin/advertisement/release')->with('status', 'Advertisement Reservation has been created.');
                }else{
                    return  redirect('sopa/admin/advertisement/release/add')->with('status', 'Advertisement Reservation not created.');
                }                
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
        $advertisementrelease = AdvertisementRelease::find($id);
        // dd($hotelroomreservation);
        $delegets = Delegates::whereIn("id", $advertisementrelease->delegate_ids)->get();
        $hotelroomreservation = HotelRoomReservation::where('status', '1')->get();
        // dd($hotelroomreservation)
        $advertisements = Advertisement::where('status', '1')->get();
        return view('Admin.pages.updateadvertisementrelease')->with(compact('hotelroomreservation', 'events', 'advertisementrelease', 'delegets', 'advertisements'));
    }

    public function view($id)
    {
        // dd($id);
        // $events = Event::where('status', '1')->get();
        $advertisement = AdvertisementRelease::find($id);
        $advertisementPack = Advertisement::find($advertisement->advertisement_id);
        $deletegateregistation = DeletegateRegistation::find($advertisement->delegate_reg_id);
        // dd($hotelroomreservation);
        $delegets = Delegates::where("delegate_reg_id", $advertisement->delegate_reg_id)->get();
        $transations = Transactions::where("ref_id", $id)->where("ref_type", 'Advertiser')->get();
        // dd($delegets );
        return view('Admin.pages.viewadvertisementrelease')->with(compact('advertisement', 'advertisementPack', 'deletegateregistation', 'delegets', 'transations'));
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
        $event = AdvertisementRelease::find($id);

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
    
        $advertisement = Advertisement::find($request->advertisement_id);
        // dd( $hotelroom);
        $grandTotal =  $advertisement->advertisement_price+$advertisement->advertisement_tax + (count($scectionlist)*8850);

 
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
        $event->advertisement_id = $request->advertisement_id;
        $event->advertisement_price = $advertisement->advertisement_price;
        $event->advertisement_tax = $advertisement->advertisement_tax;
        $event->grand_total = $grandTotal;
        $event->UTR_number = $request->UTR_number;
        $event->Cheque_receipt_number = $request->Cheque_receipt_number;
        $event->payment_date = $request->payment_date;
        $event->payment_mode = $request->payment_mode;

        $event->user_id = session('Adminuser.id');
        $event->save();
        return redirect('sopa/admin/advertisement/release')->with('status', 'AdvertisementRelease has been created.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = AdvertisementRelease::find($id);
        // if(file_exists(public_path('images/hotelroom').'/'.$event->image)){
        //     unlink(public_path('images/hotelroom').'/'.$event->image);
        // }
        $event->delete();
        return back()->with('events_deleted', 'AdvertisementRelease deleted Successfully');
    }

    public function status($id)
    {
        $event = AdvertisementRelease::find($id);
        if($event->status == '1'){
            $event->status = '0';
        }else{
            $event->status = '1';
        }
        $event->save();
        return back()->with('events_deleted', 'AdvertisementRelease deleted Successfully');
    }


    public function BulkUpload(Request $request)
    {
        Excel::import(new ExportDeletegateRegistation,request()->file('file'));
             
        return back();

    }
}