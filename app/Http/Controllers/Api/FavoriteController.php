<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\UnFavorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{

    public function favorite(Request $request){
        $request->validate([
            'user_id'     => 'required',
            'quote_id'     => 'required',
        ]);
        try {
            $Quote_Favorite_user=Favorite::whereUserId($request->user_id)->whereQuoteId($request->quote_id)->first();
            if($Quote_Favorite_user){
                Favorite::whereUserId($request->user_id)->whereQuoteId($request->quote_id)->delete();
                return  response()->json([
                    "status"     =>'Quote Favorite removed successfully',
                    "message" => trans('message.like_removed_successfully')
                ]);
            }
            $favorite= Favorite::create([
                'user_id' => $request['user_id'],
                'quote_id' => $request['quote_id'],
            ]);
            return  response()->json([
                "status"     =>'Quote Favorite successfully',
                "message" => trans('message.like_successfully'),
                "user"   =>$favorite,
            ]);


        }catch (\Exception $e) {
            return  $e->getMessage() . "on line" . $e->getLine();

        }

    }

    public function unfavorite(Request $request){
        $request->validate([
            'user_id'     => 'required',
            'quote_id'     => 'required',
        ]);
        try {
            $user_Favorite_Quote_=UnFavorite::whereUserId($request->user_id)->whereQuoteId($request->quote_id)->first();
            if($user_Favorite_Quote_){
                UnFavorite::whereUserId($request->user_id)->whereQuoteId($request->quote_id)->delete();
                return  response()->json([
                    "status"     =>'Quote Favorite removed successfully',
                    "message" => trans('message.like_removed_successfully')
                ]);
            }
            $unfavorite= UnFavorite::create([
                'user_id' => $request['user_id'],
                'quote_id' => $request['quote_id'],
            ]);
            return  response()->json([
                "status"     =>'Quote Favorite successfully',
                "message" => trans('message.like_successfully'),
                "user"   =>$unfavorite,
            ]);


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
