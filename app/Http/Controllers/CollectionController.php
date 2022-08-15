<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Quote;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class CollectionController extends Controller
{

    public function index()
    {

//        $post=Quote::get();
//       $coll = Collection::select('id')
//            ->join('collections', 'id', '=', 'quotes.collection_id')
//           ->where('collections.collection_id', $post)
//            ->get();
        $collections=Collection::with('quotes')->withAvg('ratings','rating')->get();
//        $ratings=Rating::whereCollectionId()->avg('rating')

        return view('layouts.collections.index',compact('collections'));
    }

    public function changeCollectionType($id){
        $collections= Collection::whereId($id)->first();
        if($collections->collection_type == 1){
            $collections->update([
                'collection_type' => 0,
            ]);
            Session::flash('success','Collection type Change Successfully');
            return redirect('collections');
        }elseif (($collections->collection_type == 0))
            $collections->update([
                'collection_type' => 1,
            ]);
        Session::flash('success','Collection type Change Successfully');
        return redirect('collections');
    }

////////////////.................Collection Rating section..........////////////////////////



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
