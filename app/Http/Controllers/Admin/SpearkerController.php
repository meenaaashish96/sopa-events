<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Speakers;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class SpearkerController extends Controller
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
                $query = Speakers::query()->with('user')->where('title','LIKE','%'.$title.'%');
            }else{
                $query = Speakers::query()->with('user');
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
        return view('Admin.pages.speakers')->with(compact('data', 'title'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        $events = Event::where('status', '1')->get();
        return view('Admin.pages.addspeakers')->with(compact('events')); 
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
            'name' => 'required',
            'event_id' => 'required',
            'type' => 'required',
            'designation'=> 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        // dd($request);
        if($request->hasfile('image')){
            // $image = $request->file('image');
            // $input['imagename'] = time().'.'.$request->image->extension();
            // $destinationPath = public_path('images/speaker');
            // $img = Image::make($image->path())->encode($request->image->extension(), 90);
            // $img->resize(1024, 512, function ($constraint) {
            //     $constraint->upsize();
            // })->save($destinationPath.'/'.$input['imagename']);

            $image = $request->file('image');
            $input['imagename'] = time().'.'.$request->image->extension();
            $destinationPath = public_path('images/speaker');
            $image->move($destinationPath, $input['imagename']);

    
            $dataArray = array(
                "name" => $request->name,
                "event_id" => $request->event_id,
                "type" => $request->type,
                "designation" => $request->designation,
                "user_id" => session('Adminuser.id'),
                "image" => $input['imagename'],
                "status" => '1',
            );
            $status = Speakers::create($dataArray);
            if($status){
                return  redirect('sopa/admin/speaker')->with('status', 'Speakers has been created.');
            }else{
                return  redirect('sopa/admin/speaker/add')->with('status', 'Speakers not created.');
            }
        }else{
            
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
        $speaker = Speakers::find($id);
        return view('Admin.pages.updatespeakers')->with(compact('speaker', 'events'));
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
        $event = Speakers::find($id);
        $input['imagename'] =  $event->image;
        if($request->hasfile('image') && $request->image){
            if(file_exists(public_path('images/speaker').'/'.$event->image)){
                unlink(public_path('images/speaker').'/'.$event->image);
            }
            // $image = $request->file('image');
            // $input['imagename'] = time().'.'.$request->image->extension();  
            // $destinationPath = public_path('images/speaker');
            // $img = Image::make($image->path())->encode($request->image->extension(), 90);
            // $img->resize(1024, 512, function ($constraint) {
            //     $constraint->upsize();
            // })->save($destinationPath.'/'.$input['imagename']);

            $image = $request->file('image');
            $input['imagename'] = time().'.'.$request->image->extension();
            $destinationPath = public_path('images/speaker');
            $image->move($destinationPath, $input['imagename']);
        }

        $event->name = $request->name;
        $event->event_id = $request->event_id;
        $event->type = $request->type;
        $event->designation = $request->designation;
        $event->user_id = session('Adminuser.id');
        $event->image = $input['imagename'];
        $event->save();
        return redirect('sopa/admin/speaker')->with('status', 'Speakers has been created.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Speakers::find($id);
        if(file_exists(public_path('images/speaker').'/'.$event->image)){
            unlink(public_path('images/speaker').'/'.$event->image);
        }
        $event->delete();
        return back()->with('events_deleted', 'Speakers deleted Successfully');
    }

    public function status($id)
    {
        $event = Speakers::find($id);
        if($event->status == '1'){
            $event->status = '0';
        }else{
            $event->status = '1';
        }
        $event->save();
        return back()->with('events_deleted', 'Speakers deleted Successfully');
    }
}