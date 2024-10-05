<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Event;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try { 
            $perPage = $request->input('per_page', 10);
            $operations = $request->input('operations', []);
            $select = $request->input('select', []);
            $status = $request->input('status', null);
            $orderBy = $request->input('order_by', 'created_at');
            $orderType = $request->input('order_type', 'desc');
            $groupBy = $request->input('group_by', null);
            $returnType = $request->input('return_type', 'data');
            $with = $request->input('with', '');
            $query = Gallery::query()->with('user');
            
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
        return view('Admin.pages.gallery')->with(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.pages.addgallery');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if($request->hasfile('file')){
            $image = $request->file('file');
            $imagename =$image->getClientOriginalName();
            $image->move(public_path('images/gallery'), $imagename);
            // $dataArray = array(
            //     "user_id" => session('Adminuser.id'),
            //     "name" =>$imagename
            // );
            // $status = PhotoGallery::create($dataArray);
            $events = Event::where("status", "1")->get();
            $imageUpload = new Gallery();
            $imageUpload->title = '';
            $imageUpload->event_id = $events[0]->id;
            $imageUpload->image = $imagename;
            $imageUpload->user_id = session('Adminuser.id');
            $imageUpload->save();
        
            return response()->json(['success'=>$imagename]);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function fileDestroy(Request $request)
    {
        $filename =  $request->get('filename');
        Gallery::where('name',$filename)->delete();
        $path=public_path('images/gallery').$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = Gallery::find($id);
        if(file_exists(public_path('images/gallery').'/'.$photo->image)){
            unlink(public_path('images/gallery').'/'.$photo->image);
        }
        $photo->delete();
        return back()->with('page_deleted', 'Recipes deleted Successfully');
    }
}
