<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Stall;
use App\Models\StallLayouts;
use App\Models\StallLayoutCells;

use Illuminate\Http\Request;

class StallController extends Controller
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
                $query = Stall::query()->with('user')->where('title','LIKE','%'.$title.'%');
            }else{
                $query = Stall::query()->with('user');
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
        return view('Admin.pages.stalls')->with(compact('data', 'title'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        $events = Event::where('status', '1')->get();
        return view('Admin.pages.addstalls')->with(compact('events')); 
    }

    public function layout(Request $request){
        $events = Event::where('status', '1')->get();
        $stalls = Stall::where('status', '1')->get();
        $stalllayout = StallLayouts::where('status', '1')->first();
        $stallGrids = array();
        if(!empty($stalllayout)){
            $stallGrids = StallLayoutCells::where('layout_id', $stalllayout->id)->get();
        }
        $stallNumbers = array();
        foreach ($stallGrids as $key => $value) {
            if(!empty($value['stall_number'])){
                array_push($stallNumbers,$value['stall_number']);                
            }
        }
        return view('Admin.pages.addstalllayout')->with(compact('events', 'stalls', 'stalllayout', 'stallGrids', 'stallNumbers')); 
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
            'complementary_delegate'=> 'required',
            'amount_tax'=> 'required',
            'package_type'=> 'required',
            'color'=>'required',
            // 'stall'=> 'required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $dataArray = array(
            "name" => $request->name,
            "event_id" => $request->event_id,
            "amount" => $request->amount,
            "complementary_delegate" => $request->complementary_delegate,
            "package_type" => $request->package_type,
            // "stall" => $request->stall,
            "amount_tax" => $request->amount_tax,
            "color" => $request->color,
            "user_id" => session('Adminuser.id'),
            "status" => '1',
        );
        $status = Stall::create($dataArray);
        if($status){
            return  redirect('sopa/admin/stall')->with('status', 'Stall has been created.');
        }else{
            return  redirect('sopa/admin/stall/add')->with('status', 'Stall not created.');
        }


        // if($request->hasfile('image')){
        //     $image = $request->file('image');
        //     $input['imagename'] = time().'.'.$request->image->extension();
        //     $destinationPath = public_path('images/stall');
        //     $img = Image::make($image->path())->encode($request->image->extension(), 90);
        //     $img->resize(1024, 512, function ($constraint) {
        //         $constraint->upsize();
        //     })->save($destinationPath.'/'.$input['imagename']);

    
            
        // }else{
            
        // }
    }

    public function layoutadd(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'horizontal_grid' => 'required',
            'event_id' => 'required',
            'vartical_grid'=> 'required',
        ]);
        $status = '';
        if(!empty($request->layoutId)){
            $event = StallLayouts::find($request->layoutId);
            $event->horizontal_grid = $request->horizontal_grid;
            $event->event_id = $request->event_id;
            // $event->disclaimer = $request->disclaimer;
            $event->vartical_grid = $request->vartical_grid;
            $event->user_id = session('Adminuser.id');
            $status = $event->save();
        }else{
            $dataArray = array(
                "horizontal_grid" => $request->horizontal_grid,
                "event_id" => $request->event_id,
                "vartical_grid" => $request->vartical_grid,
                // "disclaimer" => $request->disclaimer,
                "user_id" => session('Adminuser.id'),
                "status" => '1',
            );
            // dd($dataArray);
            $status = StallLayouts::create($dataArray);
        }

       
       
        if($status){
            return  redirect('sopa/admin/stall/layout')->with('status', 'Stall has been created.');
        }else{
            return  redirect('sopa/admin/stall/layout')->with('status', 'Stall not created.');
        }
    }

    public function gridadd(Request $request)
    {
        // dd($request->all());
        // $validated = $request->validate([
        //     'layout_id' => 'required',
        //     'call' => 'required',
        //     'vartical_grid'=> 'required',
        // ]);
        $status = '';
        $layout_id = $request->layout_id;
        $calls = $request->call;
        $ids = $request->id;
        $stallNumbers = $request->stall_number;
        $stallPackages = $request->stall_package;
        // 'call', 'stall_number', 'stall_id', 'layout_id'

        $StallLayouts = StallLayouts::find($layout_id);
        $StallLayouts->disclaimer = $request->disclaimer;
        $StallLayoutStatus = $StallLayouts->save();

        for ($i=0; $i < count($calls) ; $i++) { 
            // $ele = 
            if(!empty($ids[$i])){
                $event = StallLayoutCells::find($ids[$i]);
                $event->call = $calls[$i];
                $event->stall_number = $stallNumbers[$i];
                $event->stall_id = $stallPackages[$i];
                $event->layout_id = $layout_id;
                $status = $event->save();
            }else{
                $dataArray = array(
                    "call" =>  $calls[$i],
                    "stall_number" => $stallNumbers[$i],
                    "stall_id" => $stallPackages[$i],
                    "layout_id" => $layout_id
                );
                // dd($dataArray);
                $status = StallLayoutCells::create($dataArray);
            }
        }
       
        if($status){
            return  redirect('sopa/admin/stall/layout')->with('status', 'Stall has been created.');
        }else{
            return  redirect('sopa/admin/stall/layout')->with('status', 'Stall not created.');
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
        $stall = Stall::find($id);
        return view('Admin.pages.updatestalls')->with(compact('stall', 'events'));
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
        $event = Stall::find($id);
        // $input['imagename'] =  $event->image;
        // if($request->hasfile('image') && $request->image){
        //     if(file_exists(public_path('images/Stall').'/'.$event->image)){
        //         unlink(public_path('images/Stall').'/'.$event->image);
        //     }
        //     $image = $request->file('image');
        //     $input['imagename'] = time().'.'.$request->image->extension();  
        //     $destinationPath = public_path('images/stall');
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
        $event->complementary_delegate = $request->complementary_delegate;
        $event->package_type = $request->package_type;
        // $event->stall = $request->stall;
        $event->color = $request->color;
        $event->user_id = session('Adminuser.id');
        $event->save();
        return redirect('sopa/admin/stall')->with('status', 'Stall has been created.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Stall::find($id);
        // if(file_exists(public_path('images/stall').'/'.$event->image)){
        //     unlink(public_path('images/stall').'/'.$event->image);
        // }
        $event->delete();
        return back()->with('events_deleted', 'Stall deleted Successfully');
    }

    public function destroygrid($id)
    {
        $event = StallLayoutCells::find($id);
        // if(file_exists(public_path('images/stall').'/'.$event->image)){
        //     unlink(public_path('images/stall').'/'.$event->image);
        // }
        $event->delete();
        return response()->json([
            'data' => [
                'status' => true,
                'message' => 'Stall Deleted',
            ]
        ], 200);
        // return back()->with('events_deleted', 'Stall deleted Successfully');
    }

    public function status($id)
    {
        $event = Stall::find($id);
        if($event->status == '1'){
            $event->status = '0';
        }else{
            $event->status = '1';
        }
        $event->save();
        return back()->with('events_deleted', 'Stall deleted Successfully');
    }
}