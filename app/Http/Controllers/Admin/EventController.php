<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Intervention\Image\ImageManagerStatic as Image;

class EventController extends Controller
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
                $query = Event::query()->with('user')->where('title','LIKE','%'.$title.'%');
            }else{
                $query = Event::query()->with('user');
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
        return view('Admin.pages.events')->with(compact('data', 'title'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        return view('Admin.pages.addevents'); 
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
            'title' => 'required',
            'sub_title' => 'required',
            'start_date'=> 'required',
            'end_date' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if($request->hasfile('logo') || $request->hasfile('banner')){

            $image = $request->file('logo');
            $input['imagename'] = time().'.'.$request->logo->extension();
            $destinationPath = public_path('images/event');
            $image->move($destinationPath, $input['imagename']);


            $bannerImage = $request->file('banner');
            $input['imagebannername'] = time().'.'.$request->banner->extension();
            $destinationPath = public_path('images/event');
            $bannerImage->move($destinationPath, $input['imagebannername']);

      
            $dataArray = array(
                "title" => $request->title,
                "slug" =>SlugService::createSlug(Event::class, 'slug', $request->title),
                "sub_title" => $request->sub_title?$request->sub_title:'',
                "start_date" => $request->start_date,
                "end_date" => $request->end_date,
                "user_id" => session('Adminuser.id'),
                "logo" => $input['imagename'],
                "status" => '1',
                "banner" => $input['imagebannername']
            );
            $status = Event::create($dataArray);
            if($status){
                return  redirect('sopa/admin/event')->with('status', 'Event has been created.');
            }else{
                return  redirect('sopa/admin/event/add')->with('status', 'Event not created.');
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
        $event = Event::find($id);
        return view('Admin.pages.updateevents')->with(compact('event'));
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
        // $validated = $request->validate([
        //     'title' => 'required',
        //     'discription' => 'required',
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        // dd($request->all());
        $event = Event::find($id);
        $input['imagenamebanner'] =  $event->banner;
        $input['imagenamelogo'] =  $event->logo;
        if($request->hasfile('logo') && $request->logo){
            if(file_exists(public_path('images/event').'/'.$event->logo)){
                unlink(public_path('images/event').'/'.$event->logo);
            }
            $image = $request->file('logo');
            $input['imagenamelogo'] = time().'.'.$request->logo->extension();
            $destinationPath = public_path('images/event');
            $image->move($destinationPath, $input['imagenamelogo']);
        }

        if($request->hasfile('banner') && $request->banner){
           
            if(file_exists(public_path('images/event').'/'.$event->banner)){
                unlink(public_path('images/event').'/'.$event->banner);
            }

            $imagebanner = $request->file('banner');
            $input['imagenamebanner'] = time().'.'.$request->banner->extension();
            $destinationPath = public_path('images/event');
            $imagebanner->move($destinationPath, $input['imagenamebanner']);
        }

        $event->title = $request->title;
        $event->slug =  SlugService::createSlug(Event::class, 'slug', $request->title);
        $event->sub_title = $request->sub_title?$request->sub_title:'';
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->user_id = session('Adminuser.id');
        $event->banner = $input['imagenamebanner'];
        $event->logo = $input['imagenamelogo'];
        $event->save();
        return redirect('sopa/admin/event')->with('status', 'Event has been created.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        if(file_exists(public_path('images/event').'/'.$event->image)){
            unlink(public_path('images/event').'/'.$event->image);
        }
        $event->delete();
        return back()->with('events_deleted', 'Event deleted Successfully');
    }

    public function status($id)
    {
        $event = Event::find($id);
        if($event->status == '1'){
            $event->status = '0';
        }else{
            $event->status = '1';
        }
        $event->save();
        return back()->with('events_deleted', 'Event deleted Successfully');
    }
}
