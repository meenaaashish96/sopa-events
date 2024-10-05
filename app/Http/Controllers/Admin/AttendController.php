<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\WhoShouldAttend;
use Illuminate\Http\Request;

class AttendController extends Controller
{
    public function index(Request $request){
        try { 
            $title = $request->title;
            $event = Event::where('status', '1')->first();
            $perPage = $request->input('per_page', 100000);
            $operations = $request->input('operations', []);
            $select = $request->input('select', []);
            $status = $request->input('status', null);
            $orderBy = $request->input('order_by', 'order');
            $orderType = $request->input('order_type', 'asc');
            $groupBy = $request->input('group_by', null);
            $returnType = $request->input('return_type', 'data');
            $with = $request->input('with', '');
            if(!empty($title)){
                $query = WhoShouldAttend::query()->with('user')->where('title','LIKE','%'.$title.'%');
            }else{
                $query = WhoShouldAttend::query()->with('user');
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
        return view('Admin.pages.attendees')->with(compact('data', 'title', 'event'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        $events = Event::where('status', '1')->get();
        return view('Admin.pages.addattendees')->with(compact('events')); 
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
        // 
        $validated = $request->validate([
            'title' => 'required',
            "event_id" => 'required',
            // 'description' => 'required'
        ]);
        // dd($request->all());
        $attends = WhoShouldAttend::where('event_id', $request->event_id)->get();
        $dataArray = array(
            "title" => $request->title,
            "event_id" => $request->event_id,
            "order" => count($attends)+1,
            "description" => '',
            "user_id" => session('Adminuser.id'),
            "status" => '1',
        );

        // dd($dataArray);

        $status = WhoShouldAttend::create($dataArray);
        if($status){
            return  redirect('sopa/admin/attend')->with('status', 'WhoShouldAttend has been created.');
        }else{
            return  redirect('sopa/admin/attend/add')->with('status', 'WhoShouldAttend not created.');
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
        $attend = WhoShouldAttend::find($id);
        return view('Admin.pages.updateattendees')->with(compact('attend', 'events'));
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

        $validated = $request->validate([
            'title' => 'required',
            "event_id" => 'required',
            // 'description' => 'required'
        ]);
        
        $event = WhoShouldAttend::find($id);
        $event->title = $request->title;
        $event->event_id = $request->event_id;
        // $event->order = $request->order;
        $event->description = $request->description;
        $event->user_id = session('Adminuser.id');
        $event->save();
        return redirect('sopa/admin/attend')->with('status', 'WhoShouldAttend has been created.');
    }

    public function updateorder(Request $request)
    {

        // dd($request->order);
        if($request->id && count($request->id)>0){
            foreach ($request->id as $key => $value) {
                $event = WhoShouldAttend::find($value);
                $event->order = $request->order[$key];
                $event->user_id = session('Adminuser.id');
                $event->save();
            }
            return redirect('sopa/admin/attend')->with('status', 'WhoShouldAttend has been created.');
        }else{
            return redirect('sopa/admin/attend')->with('status', 'WhoShouldAttend has been created.');
        }
       
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = WhoShouldAttend::find($id);
        // if(file_exists(public_path('images/venue').'/'.$event->image)){
        //     unlink(public_path('images/venue').'/'.$event->image);
        // }
        $event->delete();
        return back()->with('events_deleted', 'WhoShouldAttend deleted Successfully');
    }

    public function status($id)
    {
        $event = WhoShouldAttend::find($id);
        if($event->status == '1'){
            $event->status = '0';
        }else{
            $event->status = '1';
        }
        $event->save();
        return back()->with('events_deleted', 'WhoShouldAttend deleted Successfully');
    }
}