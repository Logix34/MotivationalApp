<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CollectionController extends Controller
{

    public function collectionQuotes()
    {
           $collections=Auth::user()->collections->all();
              foreach ($collections as $collection){
                      $collection->collection_type;
                  if ($collection->collection_type == 0 || $collection->collection_type == 1){
                         $res=Collection::with('quotes')->whereCollectionType(0)->get() ;
                         $col= Auth::user()->collections->where('collection_type', 1);
                      return response()->json([
                          "status" => 'success',
                          "user_public_collection"   => $res,
                          "user_private_collection"   => $col,
                      ]);
                  }else{
                      return response()->json([
                          "status" => 'failed',
                          "msg"    => 'User have no Collections',
                      ]);
                  }
              }
    }



    public function collection()
    {
         $collection=Collection::all();
             return response()->json([
                 "status"      =>'Success',
                 "message" => trans('message.collection_get_successfully'),
                 "data"        =>$collection,
             ]);
    }

    public function createCollection(Request $request)
    {
        $request->validate([
            'collection_name'     => 'required',
            'collection_type'     => 'required'
        ]);
        try {
        Collection::create([
            'collection_name'     => $request['collection_name'],
            'collection_type'     => $request['collection_type'],

        ]);
        return  response()->json([
            "status"     =>'success',
            "message"    =>trans('message.collection_add_successfully'),
        ]);
        }catch (\Exception $e) {
            return  $e->getMessage() . "on line" . $e->getLine();

        }
    }

    public function edit(Request $request)
    {
        $request->validate([
            'id'     => 'required',
        ]);
        try {
             $collection=Collection::whereId($request['id'])->first();
                $collection->update([
                    'collection_name'     => $request['collection_name'],
                ]);
                return  response()->json([
                    "status"     =>'success',
                ]);
        }catch (\Exception $e) {
            return  $e->getMessage() . "on line" . $e->getLine();
        }
    }

    public function addToCollection(Request $request)
    {
        $request->validate([
            'collection_name'     => 'required',
            'quote_id'            => 'required'
        ]);

    }
    public function destroy($id)
    {

    }
}
