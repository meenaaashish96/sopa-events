<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session()->has('Adminuser')){
            return redirect('sopa/admin/dashboard');
        }else{
            return view('Admin.pages.login');
        }
    }

    public function Login(Request $request)
    {
        // $request = $request->all();
        // dd($request);

        $message = '';
        $user = User::where(["email"=> $request->email])->first();
        if($user){
            if(sha1($request->password) == $user->password){
                // dd($user->role_name);
                if($user->role_name == "SuperAdmin" || $user->role_name=="Admin"){
                    $request->session()->put('Adminuser', $user);
                    return redirect('sopa/admin/dashboard');
                }else{
                    $message = 'User not found.'; 
                    return view('Admin.pages.login');
                    
                }
            }else{
                $message = 'Invalid password.';
            }
        }else{
            return view('Admin.pages.login');
            $message = 'User not found.'; 
        }

        // $user=  array(
        //     "login_type" => 1,
        //     "password"  => "123",
        //     "name"  => "Sopa Admin",
        //     'id'=>1,
        //     "email"  =>'sopa@gmail.com',
        //     "phone"  => '1234567890',
        //     "google_id" => '',
        //     "status"  => 1,
        //     "profile_pic"  =>  '' ,// public_path('images/users').'/user.ico',
        //     'device_id' => '',
        //     'device_type' => ''
        // );
        // $request->session()->put('Adminuser', $user);
        // return redirect('sopa/admin/dashboard');
    }


    public function Logout(Request $request)
    {
        if(session()->has('Adminuser')){
            session()->pull('Adminuser');
        }
        return redirect('sopa/admin/');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
