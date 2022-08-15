<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SubCategoriesController extends Controller
{

    public function index()
    {
        $categories=Category::all();
        $subcategories=SubCategory::with('category')->get();
        return view('layouts.SubCategories.index',compact('subcategories','categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'description' => 'required',
        ]);
        try {
            SubCategory::create([
                'name'=> $request['name'],
                'category_id' => $request['category_id'],
                'description'=> $request['description'],
            ]);
            Session::flash('success','Sub Category Create Successfully');
            return redirect('sub_categories');
        }catch (\Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage() .' '.$exception->getLine());
        }
    }

    public function edit($id)
    {
        return SubCategory::whereId($id)->first();
    }

    public function update(Request $request)
    {
        {
            $request->validate([
                'name' => 'required',
                'category_id' => 'required',
                'description' => 'required',
            ]);
            try {
                $subcategory=SubCategory::whereId($request['id'])->first();
                $subcategory->update([
                    'name'=> $request['name'],
                    'category_id' => $request['category_id'],
                    'description'=> $request['description'],
                ]);
                Session::flash('success','Sub Category Create Successfully');
                return redirect('sub_categories');
            }catch (\Exception $exception){
                return redirect()->back()->with('error', $exception->getMessage() .' '.$exception->getLine());
            }
        }
    }

    public function destroy($id)
    {
        SubCategory::whereId($id)->delete();
        Session::flash('success','Subcategory Delete Successfully');
        return redirect('sub_categories');
    }
}
