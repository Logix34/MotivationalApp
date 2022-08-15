<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller
{

    public function index()
    {
        $categories=Category::all();
        return view('layouts.categories.index',compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        try {
            Category::create([
                'name'=> $request['name'],
                'description'=> $request['description'],
            ]);
            Session::flash('success','Category Create Successfully');
            return redirect('categories');
        }catch (\Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage() .' '.$exception->getLine());
        }
    }

    public function editcategory($id){

        return Category::whereId($id)->first();
    }


    public function update(Request $request)
    {
        {
            $request->validate([
                'name' => 'required',
            ]);
            try {
                $category=Category::whereId($request['id'])->first();
                $category->update([
                    'name'=> $request['name'],
                    'description' => $request['description'],
                ]);
                Session::flash('success','Category update Successfully');
                return redirect('categories');

            }catch (\Exception $exception){
                return redirect()->back()->with('error', $exception->getMessage() .' '.$exception->getLine());
            }
        }
    }
    public function destroy($id)
    {
       Category::whereId($id)->delete();
        Session::flash('success','Category Delete Successfully');
        return redirect('categories');

    }
}
