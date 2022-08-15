<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\SignUp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{

    ///////////////////////.......Login Api Section........./////////////////////

    public function login(Request $request)
    {
        $credentials= $request->validate([
            'email' => 'required|exists:Users,email',
            'password'      =>'required|min:7',
        ]);

        try {
            $user= User::whereEmail($request->email)->first();
            if($user && Hash::check($request->password,$user->password) && $request->user_type== 1){
                $token = $user->createToken("name")->plainTextToken;
                $lang=$user->lang;
                App::setLocale($lang);
                return response()->json([
                    "status"      =>'Login Successfully',
                    "message" => trans('message.login_successfully'),
                    "token"       =>$token,
                    "data"        =>$user,
                ]);
            }else{
                return response()->json([
                    "status"     => 'Login failed',
                ]);
            }
        }catch (\Exception $e) {
            return  $e->getMessage() . "on line" . $e->getLine();

        }
    }
    ///////////////////////.......SignUp Api Section........./////////////////////
    public function signUp(Request $request)
    {
        $request->validate([
            'first_name'     => 'required',
            'last_name'     => 'required',
            'email'         => 'required',
            'password'      => 'required|min:7',
            'device_name'   => 'required',
            'theme_id'      => 'required',
            'profile_image' => 'required',
            'lang'   => 'required',
        ]);
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $profile_image= $file->move('uploads/profile_image/' , $filename);
        }

        $user_data = [
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'profile_image' =>$profile_image,
            'email' => $request['email'],
            'lang'   => $request['lang'],
            'theme_id' => $request['theme_id'],
            'password' => Hash::make($request['password']),
            'user_type'=>2,
        ];
        if($user_data){
            $user= User::create($user_data);
            Auth::login($user);
            $token = $request->user()->createToken($request->device_name)->plainTextToken;
            return  response()->json([
                "status"     =>'success',
                "message" => trans('message.signUp_successfully'),
                "token"      =>$token,
                "user"   =>$user->first(),
            ]);
        }else{
            return  response()->json([
                "status" =>'failed',
            ]);
        }
    }


    ///////////////////////.......forget Api........./////////////////////

    public function forget(Request $request){
        $request->validate([
            'email' => 'required|exists:Users,email',
        ]);
        $user_mail= User::whereEmail($request->email);
        if($user_mail->first()) {
            $code = rand(1001, 99999);
            $user_mail->update(['code'=> $code]);
//            Mail::to($user_mail->first()->email)->send(new SignUp($code));
            return  response()->json([
                "status" =>'success',
                "mail_OTP" =>$code,
            ]);
        }else{
            return  response()->json([
                "status" =>'failed',
            ]);
        }
    }

    ///////////////////////.......Reset Api Section........./////////////////////
    public function reset(Request $request){
        $request->validate([
            'code' => 'required|exists:Users,code',
            'password'=> 'required|min:7',
        ]);
        $user= User::whereCode($request['code']);
        if($request['code']){
            $code=rand(1001,99999);
            $user->update(['password'=>\Hash::make($request['password']),'code'=>$code]);
            return  response()->json([
                "status" =>'success',
            ]);
        }else{
            return  response()->json([
                "status" =>'failed',
            ]);
        }
    }

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
