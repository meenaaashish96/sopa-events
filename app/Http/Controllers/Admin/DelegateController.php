<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Delegates;
use App\Models\Event;
use Illuminate\Http\Request;

class DelegateController extends Controller
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
                // array('deletegateRegistation' => function($query)
                // {
                //     $query->orderBy('organization_name');
                // },'user')

                $query = Delegates::query()->with('user', 'deletegateRegistation')->where('title','LIKE','%'.$title.'%')->where('status', 1);
            }else{
                $query = Delegates::query()->with('user', 'deletegateRegistation')->where('status', 1);
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
        return view('Admin.pages.delegates')->with(compact('data', 'title'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        $events = Event::where('status', '1')->get();
        return view('Admin.pages.adddelegates')->with(compact('events')); 
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
            'email'=> 'required',
            'mobile'=> 'required',
            'designation'=> 'required',
            'delegate_types'=> 'required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $dataArray = array(
            "name" => $request->name,
            "event_id" => $request->event_id,
            "email" => $request->email,
            "mobile" => $request->mobile,
            "designation" => $request->designation,
            "delegate_types" => $request->delegate_types,
            "user_id" => session('Adminuser.id'),
            "status" => '1',
        );
        $status = Delegates::create($dataArray);
        if($status){
            return  redirect('sopa/admin/delegates')->with('status', 'Delegates has been created.');
        }else{
            return  redirect('sopa/admin/delegates/add')->with('status', 'Delegates not created.');
        }


        // if($request->hasfile('image')){
        //     $image = $request->file('image');
        //     $input['imagename'] = time().'.'.$request->image->extension();
        //     $destinationPath = public_path('images/delegates');
        //     $img = Image::make($image->path())->encode($request->image->extension(), 90);
        //     $img->resize(1024, 512, function ($constraint) {
        //         $constraint->upsize();
        //     })->save($destinationPath.'/'.$input['imagename']);

    
            
        // }else{
            
        // }
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
        $delegates = Delegates::find($id);
        return view('Admin.pages.updatedelegates')->with(compact('delegates', 'events'));
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
        $event = Delegates::find($id);
        // $input['imagename'] =  $event->image;
        // if($request->hasfile('image') && $request->image){
        //     if(file_exists(public_path('images/Delegates').'/'.$event->image)){
        //         unlink(public_path('images/Delegates').'/'.$event->image);
        //     }
        //     $image = $request->file('image');
        //     $input['imagename'] = time().'.'.$request->image->extension();  
        //     $destinationPath = public_path('images/delegates');
        //     $img = Image::make($image->path())->encode($request->image->extension(), 90);
        //     $img->resize(1024, 512, function ($constraint) {
        //         $constraint->upsize();
        //     })->save($destinationPath.'/'.$input['image']);
        // }

        // dd($request->all());
        $event->name = $request->name;
        $event->event_id = $request->event_id;
        $event->email = $request->email;
        $event->mobile = $request->mobile;
        $event->designation = $request->designation;
        $event->delegate_types = $request->delegate_types;
        $event->user_id = session('Adminuser.id');
        $event->save();
        return redirect('sopa/admin/delegates')->with('status', 'Delegates has been created.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Delegates::find($id);
        // if(file_exists(public_path('images/delegates').'/'.$event->image)){
        //     unlink(public_path('images/delegates').'/'.$event->image);
        // }
        $event->delete();
        return back()->with('events_deleted', 'Delegates deleted Successfully');
    }

    public function status($id)
    {
        $event = Delegates::find($id);
        if($event->status == '1'){
            $event->status = '0';
        }else{
            $event->status = '1';
        }
        $event->save();
        return back()->with('events_deleted', 'Delegates deleted Successfully');
    }
}