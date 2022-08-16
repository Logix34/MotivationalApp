<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users=User::whereUserType(2)->get();
        return response()->json([
            "status"      =>'Success',
            "data"        =>$users,
        ]);
    }


    public function addTheme(Request $request)
    {
       $credential=$request->validate([
            'name'              => 'required',
            'background_image'  => 'required' ,
        ]);
        try {
            if ($request->hasFile('background_image')) {
                $file = $request->file('background_image');
                $extention = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extention;
                $background_image= $file->move('uploads/Themes/BackgroundImage' , $filename);
            }
            if($credential){
                $theme=Theme::create([
                    'name' => $request['name'],
                    'background_image' => $background_image,
                ]);
                return response()->json([
                    "status"      =>'Success',
                    "data"        =>$theme->first(),
                ]);
            }else{
                return response()->json([
                    "status"      =>'Failed',
                ]);
            }
        }catch (\Exception $e) {
        return  $e->getMessage() . "on line" . $e->getLine();
    }

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
