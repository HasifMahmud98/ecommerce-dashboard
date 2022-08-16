<?php

namespace App\Http\Controllers\Admin;

use App\Traits\FileSaver;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    
    use FileSaver;
    
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

            DB::beginTransaction();
            
            if($request->status == "on") {
                $status = 1;
            } else {
                $status = 0;
            }

            $category = Category::create([

                'name'          => $request->name,
                'description'   => $request->description,
                'status'        => $status,
            ]);

            // Upload Image
            $this->UploadWebp($request->image[0], $category, 'image', 'uploads/category', 940 , 705);
            
            DB::commit();
            return redirect()->route('category.index')->withMessage('Category Save Succesfully');

        } catch (\Throwable $th) {

            DB::rollback();
            return redirect()->back()->withError('Something went wrong! Please try again.');
        }
        
    }

    public function update(Request $request,$id)
    {
        try {

            DB::beginTransaction();

            $category = Category::find($id);

            if($category->status == "on") {
                $status = 1;
            } else {
                $status = 0;
            }
            
            $category->update([

                'name'          => $request->name,
                'description'   => $request->description,
                'status'        => $status,

            ]);

            // Upload Image
            $this->UploadWebp($request->image[0] ?? null, $category, 'image', 'uploads/category', 940 , 705);
            
            DB::commit();
            return redirect()->route('category.index')->withMessage('Category Save Succesfully');


        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
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