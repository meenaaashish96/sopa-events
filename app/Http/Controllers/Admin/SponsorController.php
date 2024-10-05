<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use App\Models\Sponsors;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class SponsorController extends Controller
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
                $query = Sponsors::query()->with('user', 'category')->where('title','LIKE','%'.$title.'%');
            }else{
                $query = Sponsors::query()->with('user', 'category');
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
        return view('Admin.pages.sponsors')->with(compact('data', 'title'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        $events = Event::where('status', '1')->get();
        $catgories = Category::where('status', '1')->get();
        return view('Admin.pages.addsponsors')->with(compact('events', 'catgories')); 
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
            'amount' => 'required',
            'received_amount' => 'required', 
            'event_id' => 'required',
            'category_id'=> 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if($request->hasfile('image')){
            // $image = $request->file('image');
            // $input['imagename'] = time().'.'.$request->image->extension();
            // $destinationPath = public_path('images/sponsors');
            // $img = Image::make($image->path())->encode($request->image->extension(), 90);
            // $img->resize(1024, 512, function ($constraint) {
            //     $constraint->upsize();
            // })->save($destinationPath.'/'.$input['imagename']);

            $image = $request->file('image');
            $input['imagename'] = time().'.'.$request->image->extension();
            $destinationPath = public_path('images/sponsors');
            $image->move($destinationPath, $input['imagename']);
            $dataArray = array(
                "name" => $request->name,
                "event_id" => $request->event_id,
                "amount" => $request->amount,
                "received_amount" => $request->received_amount,
                "deliverables" => $request->deliverables,
                "category_id" => $request->category_id,
                "user_id" => session('Adminuser.id'),
                "image" => $input['imagename'],
                "status" => '1',
            );
            $status = Sponsors::create($dataArray);
            if($status){
                return  redirect('sopa/admin/sponsors')->with('status', 'Sponsors has been created.');
            }else{
                return  redirect('sopa/admin/sponsors/add')->with('status', 'Sponsors not created.');
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
        $sponsors = Sponsors::find($id);
        $catgories = Category::where('status', '1')->get();
        return view('Admin.pages.updatesponsors')->with(compact('sponsors', 'events', 'catgories'));
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
        $event = Sponsors::find($id);
        $input['imagename'] =  $event->image;
        if($request->hasfile('image') && $request->image){
            if(file_exists(public_path('images/sponsors').'/'.$event->image)){
                unlink(public_path('images/sponsors').'/'.$event->image);
            }
            // $image = $request->file('image');
            // $input['imagename'] = time().'.'.$request->image->extension();  
            // $destinationPath = public_path('images/sponsors');
            // $img = Image::make($image->path())->encode($request->image->extension(), 90);
            // $img->resize(1024, 512, function ($constraint) {
            //     $constraint->upsize();
            // })->save($destinationPath.'/'.$input['imagename']);

            $image = $request->file('image');
            $input['imagename'] = time().'.'.$request->image->extension();
            $destinationPath = public_path('images/sponsors');
            $image->move($destinationPath, $input['imagename']);

        }

        // dd($request->all());
        $event->name = $request->name;
        $event->amount = $request->amount;
        $event->received_amount = $request->received_amount;
        $event->event_id = $request->event_id;
        $event->deliverables = $request->deliverables;
        $event->category_id = $request->category_id;
        $event->user_id = session('Adminuser.id');
        $event->image = $input['imagename'];
        $event->save();
        return redirect('sopa/admin/sponsors')->with('status', 'Sponsors has been created.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Sponsors::find($id);
        if(file_exists(public_path('images/sponsors').'/'.$event->image)){
            unlink(public_path('images/sponsors').'/'.$event->image);
        }
        $event->delete();
        return back()->with('events_deleted', 'Sponsors deleted Successfully');
    }

    public function status($id)
    {
        $event = Sponsors::find($id);
        if($event->status == '1'){
            $event->status = '0';
        }else{
            $event->status = '1';
        }
        $event->save();
        return back()->with('events_deleted', 'Sponsors deleted Successfully');
    }
}