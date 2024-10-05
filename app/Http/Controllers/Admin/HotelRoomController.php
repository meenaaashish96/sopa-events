<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\HotelRoom;
use Illuminate\Http\Request;

class HotelRoomController extends Controller
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
                $query = HotelRoom::query()->with('user')->where('title','LIKE','%'.$title.'%');
            }else{
                $query = HotelRoom::query()->with('user');
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
        return view('Admin.pages.hotelroom')->with(compact('data', 'title'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        $events = Event::where('status', '1')->get();
        return view('Admin.pages.addhotelroom')->with(compact('events')); 
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
            'name' => 'required',
            'event_id' => 'required',
            'amount'=> 'required',
            'amount_unit'=> 'required',
            'amount_tax'=> 'required',
            'type'=> 'required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $dataArray = array(
            "name" => $request->name,
            "event_id" => $request->event_id,
            "amount" => $request->amount,
            "amount_unit" => $request->amount_unit,
            "type" => $request->type,
            "amount_tax" => $request->amount_tax,
            "user_id" => session('Adminuser.id'),
            "status" => '1',
        );
        $status = HotelRoom::create($dataArray);
        if($status){
            return  redirect('sopa/admin/hotelroom')->with('status', 'HotelRoom has been created.');
        }else{
            return  redirect('sopa/admin/hotelroom/add')->with('status', 'HotelRoom not created.');
        }


        // if($request->hasfile('image')){
        //     $image = $request->file('image');
        //     $input['imagename'] = time().'.'.$request->image->extension();
        //     $destinationPath = public_path('images/hotelroom');
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
        $hotelroom = HotelRoom::find($id);
        return view('Admin.pages.updatehotelroom')->with(compact('hotelroom', 'events'));
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
        $event = HotelRoom::find($id);
        // $input['imagename'] =  $event->image;
        // if($request->hasfile('image') && $request->image){
        //     if(file_exists(public_path('images/HotelRoom').'/'.$event->image)){
        //         unlink(public_path('images/HotelRoom').'/'.$event->image);
        //     }
        //     $image = $request->file('image');
        //     $input['imagename'] = time().'.'.$request->image->extension();  
        //     $destinationPath = public_path('images/hotelroom');
        //     $img = Image::make($image->path())->encode($request->image->extension(), 90);
        //     $img->resize(1024, 512, function ($constraint) {
        //         $constraint->upsize();
        //     })->save($destinationPath.'/'.$input['image']);
        // }

        // dd($request->all());
        $event->name = $request->name;
        $event->event_id = $request->event_id;
        $event->amount = $request->amount;
        $event->amount_tax = $request->amount_tax;
        $event->amount_unit = $request->amount_unit;
        $event->type = $request->type;
        $event->user_id = session('Adminuser.id');
        $event->save();
        return redirect('sopa/admin/hotelroom')->with('status', 'HotelRoom has been created.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = HotelRoom::find($id);
        // if(file_exists(public_path('images/hotelroom').'/'.$event->image)){
        //     unlink(public_path('images/hotelroom').'/'.$event->image);
        // }
        $event->delete();
        return back()->with('events_deleted', 'HotelRoom deleted Successfully');
    }

    public function status($id)
    {
        $event = HotelRoom::find($id);
        if($event->status == '1'){
            $event->status = '0';
        }else{
            $event->status = '1';
        }
        $event->save();
        return back()->with('events_deleted', 'HotelRoom deleted Successfully');
    }
}