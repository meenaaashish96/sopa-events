<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\documnet;
use App\Models\Event;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class DocumentController extends Controller
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
                $query = documnet::query()->with('user')->where('title','LIKE','%'.$title.'%');
            }else{
                $query = documnet::query()->with('user');
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
        return view('Admin.pages.documents')->with(compact('data', 'title'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        $types = array(
            "Schedule",
            "Delegate",
            "Floor Plan",
            "Advertise",
            "Exhibit"
        );
        $events = Event::where('status', '1')->get();
        $documnets = documnet::where('status', '1')->get();
        // dd($documnets);
        if(count($documnets)!=0){
            foreach ($documnets as $key => $value) {
                // dd($value->type);
                $key = array_search($value->type, $types, true);
                // dd($key);
                if ($key !== false) {
                  unset($types[$key]);
                }
            }
        }
        // dd($types);
        return view('Admin.pages.adddocuments')->with(compact('events', 'documnets', 'types')); 
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
            'type' => 'required',
            'event_id' => 'required',
            'file' => 'required',
        ]);
        if($request->hasfile('file')){
            $image = $request->file('file');
            $imagename = time().'.'.$request->file->extension();
            $destinationPath = public_path('images/documents');
            $image->move($destinationPath, $imagename);

    
            $dataArray = array(
                "type" => $request->type,
                "event_id" => $request->event_id,
                "user_id" => session('Adminuser.id'),
                "file" => $imagename,
                "status" => '1',
            );
            $status = documnet::create($dataArray);
            if($status){
                return  redirect('sopa/admin/document')->with('status', 'documnet has been created.');
            }else{
                return  redirect('sopa/admin/document/add')->with('status', 'documnet not created.');
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
        $types = array(
            "Schedule",
            "Delegate",
            "Floor Plan",
            "Advertise",
            "Exhibit"
        );

        $events = Event::where('status', '1')->get();
        $document = documnet::find($id);
        return view('Admin.pages.updatedocuments')->with(compact('document', 'events', 'types'));
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
        $event = documnet::find($id);
        $imagename = $event->file;
        if($request->hasfile('file')){
            if(!empty($event->file) && file_exists(public_path('images/documents').'/'.$event->file)){
                unlink(public_path('images/documents').'/'.$event->file);
            }

            $image = $request->file('file');
            $imagename = time().'.'.$request->file->extension();
            $destinationPath = public_path('images/documents');
            $image->move($destinationPath, $imagename);
        }

        // dd($request->all());
        $event->type = $request->type;
        $event->event_id = $request->event_id;
        $event->user_id = session('Adminuser.id');
        $event->file = $imagename;
        $event->save();
        return redirect('sopa/admin/document')->with('status', 'documnet has been created.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = documnet::find($id);
        if(file_exists(public_path('images/sponsors').'/'.$event->image)){
            unlink(public_path('images/sponsors').'/'.$event->image);
        }
        $event->delete();
        return back()->with('events_deleted', 'documnet deleted Successfully');
    }

    public function status($id)
    {
        $event = documnet::find($id);
        if($event->status == '1'){
            $event->status = '0';
        }else{
            $event->status = '1';
        }
        $event->save();
        return back()->with('events_deleted', 'documnet deleted Successfully');
    }
}