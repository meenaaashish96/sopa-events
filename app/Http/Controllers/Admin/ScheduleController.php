<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Schedule;
use App\Models\Speakers;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class ScheduleController extends Controller
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
                $query = Schedule::query()->with('user')->where('title','LIKE','%'.$title.'%');
            }else{
                $query = Schedule::query()->with('user');
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
        return view('Admin.pages.schedule')->with(compact('data', 'title'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        $events = Event::where('status', '1')->get();
        $speakers = Speakers::where('status', '1')->get();
        // $mindate = Carbon::parse($events[0]->start_date)->subDays(1);
        // $maxdate = Carbon::parse($events[0]->end_date)->addDays(1);
        return view('Admin.pages.addschedule')->with(compact('events', 'speakers')); 
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
            'title' => 'required',
            'event_id' => 'required',
            // 'type'=> 'required',
            // 'location' => 'required',
            // 'speackers' => 'required',
            'from_time' => 'required',
            'to_time' => 'required',
            'schedule_date' => 'required',
            // 'description' => 'required',
            // 'points' => 'required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $input['imagename']  = '';
        // if($request->hasfile('image')){
        //     $image = $request->file('image');
        //     $input['imagename'] = time().'.'.$request->image->extension();
        //     $destinationPath = public_path('images/schedule');
        //     $image->move($destinationPath, $input['imagename']);
        // }
        // else{
            
        // // }
        $dataArray = array(
            "title" => $request->title,
            "event_id" => $request->event_id,
            // "type" => $request->type,
            // "location" => $request->location,
            // "speackers" => $request->speackers,
            "from_time" => $request->from_time,
            "to_time" => $request->to_time,
            "schedule_date" => $request->schedule_date,
            "description" => $request->description,
            "points" => $request->points,
            "user_id" => session('Adminuser.id'),
            "image" => $input['imagename'],
            "status" => '1',
        );
        $status = Schedule::create($dataArray);
        if($status){
            return  redirect('sopa/admin/schedule')->with('status', 'Schedule has been created.');
        }else{
            return  redirect('sopa/admin/schedule/add')->with('status', 'Schedule not created.');
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
        $speakers = Speakers::where('status', '1')->get();
        $schedule = Schedule::find($id);
        return view('Admin.pages.updateschedule')->with(compact('schedule', 'events', 'speakers'));
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
        $event = Schedule::find($id);
        $input['imagename'] =  $event->image;
        if($request->hasfile('image') && $request->image){
            if(file_exists(public_path('images/schedule').'/'.$event->image)){
                unlink(public_path('images/schedule').'/'.$event->image);
            }
            // $image = $request->file('image');
            // $input['imagename'] = time().'.'.$request->image->extension();  
            // $destinationPath = public_path('images/schedule');
            // $img = Image::make($image->path())->encode($request->image->extension(), 90);
            // $img->resize(1024, 512, function ($constraint) {
            //     $constraint->upsize();
            // })->save($destinationPath.'/'.$input['imagename']);

            $image = $request->file('image');
            $input['imagename'] = time().'.'.$request->image->extension();
            $destinationPath = public_path('images/schedule');
            $image->move($destinationPath, $input['imagename']);
        }

        $event->title = $request->title;
        $event->event_id = $request->event_id;
        // $event->type = $request->type;
        // $event->location = $request->location;
        // $event->speackers = $request->speackers;
        $event->from_time = $request->from_time;
        $event->to_time = $request->to_time;
        $event->schedule_date = $request->schedule_date;
        $event->description = $request->description;
        $event->points = $request->points;
        $event->user_id = session('Adminuser.id');
        $event->image = $input['imagename'];
        $event->save();
        return redirect('sopa/admin/schedule')->with('status', 'Schedule has been created.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Schedule::find($id);
        // if(file_exists(public_path('images/schedule').'/'.$event->image)){
        //     unlink(public_path('images/schedule').'/'.$event->image);
        // }
        $event->delete();
        return back()->with('events_deleted', 'Schedule deleted Successfully');
    }

    public function status($id)
    {
        $event = Schedule::find($id);
        if($event->status == '1'){
            $event->status = '0';
        }else{
            $event->status = '1';
        }
        $event->save();
        return back()->with('events_deleted', 'Schedule deleted Successfully');
    }
}