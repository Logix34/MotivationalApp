<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class QuoteController extends Controller
{

    public function index()
    {

          $quotations=Quote::with('category','subcategory','collection')
              ->withCount('likes','dislikes','favorites','unfavorites')
              ->orderBy(DB::raw('RAND()'));
          $quotations->paginate(100);
        return response()->json([
            "status"      =>'Success',
            "data"        =>$quotations->get(),
        ]);
    }

    ///////////////////////.......CreateQuote Api Section........./////////////////////
    public function createQuote(Request $request)
    {
        $request->validate([
             'author_name'   => 'required',
            'category_id'    => 'required',
            'subcategory_id' => 'required',
            'collection_id'  => 'required',
            'quote'          => 'required',
        ]);
        try {
                $quote= Quote::create([
                    'author_name' => $request['author_name'],
                    'category_id' => $request['category_id'],
                    'subcategory_id' => $request['subcategory_id'],
                    'collection_id' => $request['collection_id'],
                    'quote'   => $request['quote'],
                ]);
                return  response()->json([
                    "status"     =>'success',
                    "quotes"   =>$quote,
                ]);
            }catch (\Exception $e) {
                return  $e->getMessage() . "on line" . $e->getLine();

            }
        }
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
