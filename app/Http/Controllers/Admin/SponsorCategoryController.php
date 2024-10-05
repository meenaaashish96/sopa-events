<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class SponsorCategoryController extends Controller
{
    public function index(Request $request){
        try { 
            $title = $request->title;
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
                $query = Category::query()->with('user')->where('title','LIKE','%'.$title.'%');
            }else{
                $query = Category::query()->with('user');
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
        return view('Admin.pages.categories')->with(compact('data', 'title'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        return view('Admin.pages.addcategory'); 
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
            // 'order' => 'required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $input['imagename'] = '';
        $attends = Category::where('status', 1)->get();
        if($request->hasfile('image')){
            // $image = $request->file('image');
            // $input['imagename'] = time().'.'.$request->image->extension();
            // $destinationPath = public_path('images/category');
            // $img = Image::make($image->path())->encode($request->image->extension(), 90);
            // $img->resize(1024, 512, function ($constraint) {
            //     $constraint->upsize();
            // })->save($destinationPath.'/'.$input['imagename']);

            $image = $request->file('image');
            $input['imagename'] = time().'.'.$request->image->extension();
            $destinationPath = public_path('images/category');
            $image->move($destinationPath, $input['imagename']);
        }
        $dataArray = array(
            "name" => $request->name,
            "order" => count($attends)+1,
            "user_id" => session('Adminuser.id'),
            "image" => $input['imagename'],
            "status" => '1',
        );
        $status = Category::create($dataArray);
        if($status){
            return  redirect('sopa/admin/sponsors/category')->with('status', 'Category has been created.');
        }else{
            return  redirect('sopa/admin/sponsors/category/add')->with('status', 'Category not created.');
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
        $category = Category::find($id);
        return view('Admin.pages.updatecategory')->with(compact('category'));
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
        $event = Category::find($id);
        $input['imagename'] =  $event->image;
        if($request->hasfile('image') && $request->image){
            if(file_exists(public_path('images/category').'/'.$event->image)){
                unlink(public_path('images/category').'/'.$event->image);
            }
            // $image = $request->file('image');
            // $input['imagename'] = time().'.'.$request->image->extension();  
            // $destinationPath = public_path('images/category');
            // $img = Image::make($image->path())->encode($request->image->extension(), 90);
            // $img->resize(1024, 512, function ($constraint) {
            //     $constraint->upsize();
            // })->save($destinationPath.'/'.$input['imagename']);

            $image = $request->file('image');
            $input['imagename'] = time().'.'.$request->image->extension();
            $destinationPath = public_path('images/category');
            $image->move($destinationPath, $input['imagename']);
        }

        $event->name = $request->name;
        // $event->order = $request->order;
        $event->user_id = session('Adminuser.id');
        $event->image = $input['imagename'];
        $event->save();
        return redirect('sopa/admin/sponsors/category')->with('status', 'Category has been created.');
    }

    public function updateorder(Request $request)
    {

        // dd($request->order);
        if($request->id && count($request->id)>0){
            foreach ($request->id as $key => $value) {
                $event = Category::find($value);
                $event->order = $request->order[$key];
                $event->user_id = session('Adminuser.id');
                $event->save();
            }
            return redirect('sopa/admin/sponsors/category')->with('status', 'Category has been created.');
        }else{
            return redirect('sopa/admin/sponsors/category')->with('status', 'Category has been created.');
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
        $event = Category::find($id);
        if(file_exists(public_path('images/category').'/'.$event->image)){
            unlink(public_path('images/category').'/'.$event->image);
        }
        $event->delete();
        return back()->with('events_deleted', 'Category deleted Successfully');
    }

    public function status($id)
    {
        $event = Category::find($id);
        if($event->status == '1'){
            $event->status = '0';
        }else{
            $event->status = '1';
        }
        $event->save();
        return back()->with('events_deleted', 'Category deleted Successfully');
    }
}