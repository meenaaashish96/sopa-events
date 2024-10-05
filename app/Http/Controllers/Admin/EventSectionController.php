<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event as ModelsEvent;
use App\Models\EventSections;
use Intervention\Image\ImageManagerStatic as Image;

use Illuminate\Http\Request;

class EventSectionController extends Controller
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
                $query = EventSections::query()->with('user')->where('title','LIKE','%'.$title.'%');
            }else{
                $query = EventSections::query()->with('user');
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
        // return view('Admin.pages.eventsection')->with(compact('data', 'title'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        $events = ModelsEvent::where('status', '1')->get();
        return view('Admin.pages.addeventsection')->with(compact('events')); 
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
            'type'=> 'required',
        ]);
        $input['imagename'] = '';
        if($request->hasfile('image')){
            $image = $request->file('image');
            $input['imagename'] = time().'.'.$request->image->extension();
            $destinationPath = public_path('images/eventsection');
            $image->move($destinationPath, $input['imagename']);

            // $image = $request->file('image');
            // $input['imagename'] = time().'.'.$request->image->extension();
            // $destinationPath = public_path('images/eventsection');
            // $img = Image::make($image->path())->encode($request->image->extension(), 90);
            // $img->resize(1024, 512, function ($constraint) {
            //     $constraint->upsize();
            // })->save($destinationPath.'/'.$input['imagename']);
        }

        $dataArray = array(
            "title" => $request->title,
            "event_id" => $request->event_id,
            "type" => $request->type,
            "sub_title" => $request->sub_title,
            "short_description" => $request->short_description,
            "description" => $request->description,
            "user_id" => session('Adminuser.id'),
            "image" => $input['imagename'],
            "status" => '1',
        );
        $status = EventSections::create($dataArray);
        if($status){
            return  redirect('sopa/admin/eventsection/')->with('status', 'EventSections has been created.');
        }else{
            return  redirect('sopa/admin/eventsection/add')->with('status', 'EventSections not created.');
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
        $events = ModelsEvent::where('status', '1')->get();
        $eventsection = EventSections::where('type', $id)->first();
        // dd($eventsection);
        $type = $id;
        return view('Admin.pages.updateeventsection')->with(compact('eventsection', 'events', 'type'));
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
        // dd($request->all());
        // dd($id);
        $event = EventSections::find($id);
        $input['imagename'] =  $event->image;
        if($request->hasfile('image') && $request->image){
            if(!empty($event->image) && file_exists(public_path('images/eventsection').'/'.$event->image)){
                unlink(public_path('images/eventsection').'/'.$event->image);
            }
            $image = $request->file('image');
            $input['imagename'] = time().'.'.$request->image->extension();
            $destinationPath = public_path('images/eventsection');
            $image->move($destinationPath, $input['imagename']);
            // $image = $request->file('image');
            // $input['imagename'] = time().'.'.$request->image->extension();
            // $destinationPath = public_path('images/eventsection');
            // $img = Image::make($image->path())->encode($request->image->extension(), 90);
            // $img->resize(1024, 512, function ($constraint) {
            //     $constraint->upsize();
            // })->save($destinationPath.'/'.$input['imagename']);
        }

        // $event->type = $request->type;
        // $event->event_id = $request->event_id;
        $event->title = $request->title;
        $event->sub_title = $request->sub_title;
        $event->short_description = $request->short_description;
        $event->description = $request->description;
        $event->user_id = session('Adminuser.id');
        $event->image = $input['imagename'];
        $event->save();
        return back()->with('status', 'EventSections has been created.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = EventSections::find($id);
        if(file_exists(public_path('images/eventsection').'/'.$event->image)){
            unlink(public_path('images/eventsection').'/'.$event->image);
        }
        $event->delete();
        return back()->with('events_deleted', 'EventSections deleted Successfully');
    }

    public function status($id)
    {
        $event = EventSections::find($id);
        if($event->status == '1'){
            $event->status = '0';
        }else{
            $event->status = '1';
        }
        $event->save();
        return back()->with('events_deleted', 'EventSections deleted Successfully');
    }
}