<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;


class UserController extends Controller
{

    public function index()
    {
        return view('layouts.Dashboard');
    }

    Public function user(){
          $users = User::whereUserType(2)->get();
        return view('layouts.Users.index',compact('users'));
    }

    public function usersList(){
          $users = User::whereUserType(2)->get();
        return datatables::of($users)
            ->editColumn('created_at',function ($row){
                return   Carbon::create($row->created_at)->format('Y-m-d');
            })
            ->addColumn('action',function ($users){
                $button='';
                if($users->status == "1"){
                    $button.='<a type="button" href="'. url("change_status/".$users->id) .'" class="btn btn-danger">Suspended</a>';
                }elseif($users->status == "0"){
                    $button.='<a type="button" href="'. url("change_status/".$users->id) .'" class="btn btn-success">Active</a>';
                }else{

                }
                return $button;
            })->addColumn('status',function ($users){
                return $users->status==='1'?'<p class=" mt-3 ml-5 align-items-center text-white card w-25 bg-gradient-success">Active</p>' :'<p class=" mt-3 ml-5 align-items-center text-white card bg-gradient-danger" style="width:100px;">Suspended</p>';
            })->rawColumns(['action','status'])->make(true);
    }
    public function changeStatus($id){
        $user= User::whereId($id)->first();
        if($user->status == 1){
            $user->update([
                'status' => 0,
            ]);
            Session::flash('success','Status Change Successfully');
            return redirect('users');
        }elseif (($user->status == 0))
            $user->update([
                'status' => 1,
            ]);
        Session::flash('success','Status Change Successfully');
        return redirect('users');
    }

// ..................User Themes Section ...................//////////////////////////

    public function theme()
    {
        $userThemes=Theme::all();
        return view('layouts.Users.Themes.index',compact('userThemes'));
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
