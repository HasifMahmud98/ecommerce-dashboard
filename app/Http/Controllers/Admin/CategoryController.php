<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::get();
        return view('admin.category.index',compact('category'));
    }



    public function create()
    {
        return view('admin.category.create');
    }


    public function edit($id)
    {
        $category = Category::find($id);

        return view('admin.category.edit',compact('category'));
    }


    public function store(Request $request)
    {
        try {

            Category::create([

                'name'    => $request->name,
                'status'  => $request->status,
            ]);

            return redirect()->route('category.index')->withMessage('Category Save Succesfully');

        } catch (\Throwable $th) {

            return redirect()->back()->withError('Something went wrong! Please try again.');
        }
    }


    public function update(Request $request,$id)
    {
        try {

            $category = Category::find($id);
            $category->update([

                'name'    => $request->name,
                'status'  => $request->status,

            ]);

            return redirect()->route('category.index')->withMessage('Category Update Succesfully');


        } catch (\Throwable $th) {

            return redirect()->back()->withError('Something went wrong! Please try again.');
        }
    }


    public function destroy($id)
    {
        try {

            $category = Category::find($id)->delete();
            return redirect()->route('category.index')->withMessage('Category Delete Succesfully');
        } catch (\Throwable $th) {

            return redirect()->back()->withError('Something went wrong! Please try again.');
        }
    }
}