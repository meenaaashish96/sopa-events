<?php

namespace App\Http\Controllers;
use App\Models\Event as ModelsEvent;
use App\Models\DeletegateRegistation;
use App\Models\Venues;
use App\Models\User;
use App\Models\Delegates;
use App\Models\SpotRegistrations;
use App\Models\Transactions;
use App\Models\EventSections;
use Illuminate\Http\Request;


class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $event = ModelsEvent::where("status", "1")->first();
        $venue = Venues::where("status", "1")->where('event_id', $event->id)->first();
        return view('spot-delegate-reservation-operator')->with(compact('venue', 'event'));
    }
    
    public function registrationRequest()
    {
        $event = ModelsEvent::where("status", "1")->first();
        $venue = Venues::where("status", "1")->where('event_id', $event->id)->first();
        $requests = SpotRegistrations::where("status", "1")->where("payment_status", "Pending")->orderBy('id', 'desc')->get();
        return view('spot-delegate-requests')->with(compact('venue', 'event', 'requests'));
    }
    
    public function registrationAssigned()
    {
        $event = ModelsEvent::where("status", "1")->first();
        $venue = Venues::where("status", "1")->where('event_id', $event->id)->first();
        $entries = Delegates::where("status", "1")->where("batch_assign", "2")->with('user', 'deletegateRegistation')->orderBy('id', 'desc')->get();
        return view('spot-delegate-assigned')->with(compact('venue', 'event', 'entries'));
    }
    
    public function registrationRequestAction(string $id)
    {
        $event = ModelsEvent::where("status", "1")->first();
        $venue = Venues::where("status", "1")->where('event_id', $event->id)->first();
        $request = SpotRegistrations::where("id", $id)->first();
        return view('spot-delegate-requests-action')->with(compact('venue', 'event', 'request'));
    }
    
    public function registrationRequestActionUpdate(Request $request, $id)
    {
        // dd($request);
        $spotReg = SpotRegistrations::find($id);
        $spotReg->name = $request->dName;
        $spotReg->mobile = $request->dmobile;
        $spotReg->designation = $request->ddesignation;
        $spotReg->deletegate_category = $request->deletegate_category;
        $spotReg->dial_code = $request->ddial_code;
        $spotReg->email = $request->demail;
        $spotReg->organization_name = $request->organization_name;
        $spotReg->GSTIN = strtoupper($request->GSTIN);
        $spotReg->payment_mode = $request->payment_mode;
        $spotReg->payment_received = $request->payment_mode == 'free'?0:$request->total_amount;
        if($request->payment_mode == 'free'){
            $spotReg->amount = 0;
            $spotReg->tax = 0;   
            $spotReg->total_amount = 0;
        }
        $spotReg->payment_date = date('Y-m-d');
        $spotReg->payment_status = 'completed';
        // dd($spotReg);
        $spotReg->save();
        
        
        $event = ModelsEvent::where("status", "1")->first();
        //  Delegate Insert
        $delegatesIds = array();
        $totlaDelegate = 0;
        // $delegatePrice = getDelegatePrice($event);
        $delegates = array();
        $per_delegate = 0;
        $per_delegate_tax = 0;
        if($spotReg->payment_mode != 'free'){
            $per_delegate = $spotReg['amount'];
            $per_delegate_tax = $spotReg['tax'];
        }
      
        // 'id', 'user_id', 'event_id', 'delegate_reg_id' ,'name', 'image', 'designation', 'status', 'mobile', 'email', 'per_delegate','per_delegate_tax', 'total_delegate', 'type'
        $delegates[] = array(
            "name" => $spotReg->name,
            "event_id" => $event->id,
            "email" => $spotReg->email,
            "mobile" => $spotReg->mobile,
            "dial_code" => $spotReg->dial_code,
            "image" => $id,
            "designation" =>$spotReg->designation,
            "delegate_types" => $spotReg->deletegate_category,
            "per_delegate"=> $per_delegate,
            "per_delegate_tax"=>$per_delegate_tax,
            "total_delegate"=> $per_delegate+$per_delegate_tax,
            "batch_assign"=> '0',
            "type"=> $request->payment_mode == 'free'?'free':'paid',
            "status" => '1',
        );
        $totlaDelegate = $totlaDelegate+($per_delegate+$per_delegate_tax);

        // $diff = date_diff(Carbon::parse($request->checkin),Carbon::parse($request->checkout));
        $roomtotal = 0;
        // (($request->room_price+$request->room_price_tax)*$request->room_qty)*$diff->days;
        $grandTotal = $roomtotal + $totlaDelegate;

        $dataArray = array(
            "event_id" => $event->id,
            "organization_name" => $spotReg->organization_name?$spotReg->organization_name: $spotReg->name,
            "deletegate_category" => $spotReg->deletegate_category,
            "GSTIN" => strtoupper($spotReg->GSTIN),
            "email" => $spotReg->email,
            "delegate_ids" => $delegatesIds,
            "total_delegate" =>$totlaDelegate,
            // "hotel_room_id" => $request->hotel_room_id,
            "hotal_name" => '',
            "hotal_room_type" => '',
            "checkin" => date('Y-m-d'),
            "checkout" => date('Y-m-d'),
            "room_qty" => 0,
            "room_days" => 0,
            "room_price" => 0,
            "room_price_tax" => 0,
            "room_price_unit" => '',
            "room_total" => $roomtotal,
            "grand_total" => $grandTotal,
            "status" => '1'
        );

        $transitionData = array(
            "event_id" => $event->id,
            "ref_type"=> "Delegate",
            "ref_id"=>'',
            "UTR_number"=>  '',
            "Cheque_receipt_number"=> '',
            "payment_status"=>"completed",
            "payment_recevied"=>$grandTotal,
            "payment_date"=>$spotReg->payment_date,
            "payment_mode" => $spotReg->payment_mode
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
                $maildata = getmailcontent('delegate', $transitionData['ref_id'], $transitionStatus->id);
                // $header = getmailheader();
                // dd($maildata);
                // $mailStatus =  mail($maildata['mailto'],$maildata['mailsubject'], $maildata['mailbody'], $maildata['mailheader']);
                // if($mailStatus){
                    
                // }
                if(!empty($maildata['usermailto'])){
                     mail($maildata['usermailto'],$maildata['mailsubject'], $maildata['mailbody'], $maildata['usermailheader']);
                }
               
               return redirect('/operator-panel/registration-request/print/'.$id.'/spot');
            }else{
                return redirect('/operator-panel/registration-request/print/'.$id.'/spot');
            }
        }
        // return view('spot-delegate-requests-action')->with(compact('venue', 'event', 'request'));
    }
    
     public function registrationRequestActionPrint(string $id, string $type)
    {
        if($type == 'spot'){
            $request = SpotRegistrations::where("id", $id)->first();
            return view('spot-delegate-requests-print')->with(compact('request'));
        }else{
             $request = Delegates::where("id", $id)->with('user', 'deletegateRegistation')->first();
             
            //  $transition = Delegates::where("id", $id)->with('user', 'deletegateRegistation')->first();
              return view('spot-delegate-requests-delegate')->with(compact('request'));
            //  spot-delegate-requests-delegate.blade.php
        }
       
        // dd($request);
       
    }
    
    // badge
    public function badgeAssignRequest()
    {
        // image
        $event = ModelsEvent::where("status", "1")->first();
        $venue = Venues::where("status", "1")->where('event_id', $event->id)->first();
        $entries = Delegates::where("status", "1")->whereNot("batch_assign", "2")->where('image', '!=' , '0')->with('user', 'deletegateRegistation')->orderBy('id', 'desc')->get();
        return view('spot-delegate-entries')->with(compact('venue', 'event', 'entries'));
    }
    
    
    public function registredEntries()
    {
        $event = ModelsEvent::where("status", "1")->first();
        $venue = Venues::where("status", "1")->where('event_id', $event->id)->first();
        $entries = Delegates::where('image', '0')->where("status", "1")->whereNot("batch_assign", "2")->with('user', 'deletegateRegistation')->orderBy('id', 'desc')->get();
        return view('spot-delegate-entries')->with(compact('venue', 'event', 'entries'));
    }
    
    // public function badgePrintAction(string $id)
    // {
    //     $spotReg = Delegates::find($id);
    //     $spotReg->batch_assign = '1';
    //     $spotReg->save();
        
    //     return redirect('/operator-panel/badge-print-assigned');
        
    // }
    
    public function registredEntriesAction(string $id)
    {
        $spotReg = Delegates::find($id);
        $spotReg->batch_assign = '2'; 
        $spotReg->save();
        return redirect('/operator-panel/registration-assigned');
        
    }
    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    
    public function login(Request $request){
        $message = '';
        
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        
        $credentials = $request->except(['_token']);
        
        $event = ModelsEvent::where("status", "1")->first();
        $venue = Venues::where("status", "1")->where('event_id', $event->id)->first();
        if(!empty($request)){
            $user = User::where(["email"=> $request->email])->first();
            if($user){
                
                if(sha1($request->password) == $user->password){
                    // dd($user->role_name);
                    if($user->role_name == "Operator"){
                        $request->session()->put('Operatoruser', $user);
                        if($user->name == 'operator'){
                            return redirect('operator-panel/registration-request');
                        }else{
                            return redirect('operator-panel/registred-entries');
                        }
                       
                    }else{
                      return back()->with('error', 'User not found!');
                    }
                }else{
                    $message = 'Invalid password.';
                   return back()->with('error', 'Invalid password!');
                }
            }else{
               return back()->with('error', 'User not found!'); 
            }
        }else{
            return back()->with('error', 'Invalid Page!'); 
        }

    }


    public function Logout(Request $request)
    {
        if(session()->has('Operatoruser')){
            session()->pull('Operatoruser');
        }
        return redirect('operator-panel/');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
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
