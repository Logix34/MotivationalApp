<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dislike;
use App\Models\Like;
use Illuminate\Http\Request;

class LikesController extends Controller
{
   public function likes(Request $request){
       $request->validate([
           'user_id'     => 'required',
           'quote_id'     => 'required',
       ]);
       try {
           $like_user=Like::whereUserId($request->user_id)->whereQuoteId($request->quote_id)->first();
           if($like_user){
               Like::whereUserId($request->user_id)->whereQuoteId($request->quote_id)->delete();
               return  response()->json([
                   "status"     =>'like removed successfully',
                   "message" => trans('message.like_removed_successfully')
               ]);
           }
           $like= Like::create([
               'user_id' => $request['user_id'],
               'quote_id' => $request['quote_id'],
           ]);
           return  response()->json([
               "status"     =>'like successfully',
               "message" => trans('message.like_successfully'),
               "user"   =>$like,
           ]);


       }catch (\Exception $e) {
           return  $e->getMessage() . "on line" . $e->getLine();

       }

   }
    public function dislikes(Request $request){
        $request->validate([
            'user_id'     => 'required',
            'quote_id'     => 'required',
        ]);
        try {
            $dislike_user=Dislike::whereUserId($request->user_id)->whereQuoteId($request->quote_id)->first();
            if($dislike_user){
                Dislike::whereUserId($request->user_id)->whereQuoteId($request->quote_id)->delete();
                return  response()->json([
                    "status"     =>'dislike removed successfully',
                    "message" => trans('message.like_removed_successfully')
                ]);
            }
            $dislike= Dislike::create([
                'user_id' => $request['user_id'],
                'quote_id' => $request['quote_id'],
            ]);
            return  response()->json([
                "status"     =>'dislike successfully',
                "message" => trans('message.like_successfully'),
                "user"   =>$dislike,
            ]);


        }catch (\Exception $e) {
            return  $e->getMessage() . "on line" . $e->getLine();

        }

    }
}
