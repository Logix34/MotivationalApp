<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reminder;
use App\Models\User;
use Illuminate\Http\Request;

class ReminderController extends Controller
{

    public function setReminder(Request $request)
    {
        $request->validate([
            'reminder_at' => 'required',
            'due_date'   => 'required',
            'user_id' => 'required',
            'is_important' => 'required',
            'reminder_for'   => 'required',
        ]);
        try {
           User::whereId($request['user_id'])->get();
            if($request['user_id']){
                $reminder= Reminder::with('user')->get();
                Reminder::create([
                    'reminder_at'     => $request['reminder_at'],
                    'due_date'     => $request['due_date'],
                    'user_id'     => $request['user_id'],
                    'is_important'     => $request['is_important'],
                    'reminder_for'     => $request['reminder_for'],
                ]);
                return  response()->json([
                    "status"     =>'success',
                    "data"       => $reminder,
                ]);
            }else{
                return  response()->json([
                    "status"     =>'failed',
                     "msg"       =>'something missing'
                ]);
            }

        }catch (\Exception $e) {
            return  $e->getMessage() . "on line" . $e->getLine();

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
