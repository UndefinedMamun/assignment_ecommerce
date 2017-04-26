<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function auth_check(){
        $admin_id = Session::get('admin_id');
//        echo $admin_id;
//        exit();
        if($admin_id != NULL){
            Redirect::to('/dashboard')->send();
        }
    }
    public function index()
    {
        $this->auth_check();
        return view('admin.admin_login');
        
    }
    
    public function admin_log_in_check(Request $request)
    {
        $admin_email_address = $request->admin_email_address;
        $admin_password = $request->admin_password;
        $admin_info = DB::table('tbl_admin')
                ->where('admin_email_address',$admin_email_address)
                ->where('admin_password',  md5($admin_password))
                ->first();
        if($admin_info){
            Session::put('admin_id',$admin_info->admin_id);
            Session::put('admin_name',$admin_info->admin_name);
            return redirect('/dashboard');
        }
        else
        {
            Session::put('exception','Your User Id or Password is wrong !!');
            return redirect('/admin');
        }
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
