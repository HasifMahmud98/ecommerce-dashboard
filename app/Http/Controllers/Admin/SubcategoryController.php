<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Subcategory;
use App\Models\Admin\Category;
use Illuminate\Support\Facades\DB;
use App\Traits\FileSaver;


class SubcategoryController extends Controller
{

    use FileSaver;
    
    public function index()
    {
        $subcategory = Subcategory::get();
        $category = Category::get();
        
        return view('admin.subcategory.index',compact('subcategory', 'category'));
    }

    public function create()
    {
        $category = Category::get();
        
        return view('admin.subcategory.create', compact('category'));
    }

    public function edit($id)
    {
        $subcategory = Subcategory::find($id);
        $category = Category::get();

        return view('admin.subcategory.edit',compact('subcategory', 'category'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        try {

            DB::beginTransaction();
            
            if($request->status == "on") {
                $status = 1;
            } else {
                $status = 0;
            }

            $subcategory = Subcategory::create([

                'name'          => $request->name,
                'category_id'   => $request->category_id,
                'description'   => $request->description,
                'status'        => $status,
            ]);

            // Upload Image
            $this->UploadWebp($request->image[0], $subcategory, 'image', 'uploads/subcategory', 940 , 705);
            
            DB::commit();
            return redirect()->route('subcategory.index')->withMessage('Subcategory Save Succesfully');

        } catch (\Throwable $th) {
            
            DB::rollback();
            return redirect()->back()->withError('Something went wrong! Please try again.');
        }
        
    }

    public function update(Request $request,$id)
    {
        try {

            DB::beginTransaction();

            $subcategory = Subcategory::find($id);

            if($subcategory->status == "on") {
                $status = 1;
            } else {
                $status = 0;
            }
            
            $subcategory->update([

                'name'          => $request->name,
                'category_id'   => $request->category_id,
                'description'   => $request->description,
                'status'        => $status,

            ]);

            // Upload Image
            $this->UploadWebp($request->image[0] ?? null, $subcategory, 'image', 'uploads/subcategory', 940 , 705);
            
            DB::commit();
            return redirect()->route('subcategory.index')->withMessage('Category Save Succesfully');


        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            return redirect()->back()->withError('Something went wrong! Please try again.');
        }
    }


    public function destroy($id)
    {
        try {

            $subcategory = Subcategory::find($id)->delete();
            return redirect()->route('subcategory.index')->withMessage('Subcategory Delete Succesfully');
        } catch (\Throwable $th) {

            return redirect()->back()->withError('Something went wrong! Please try again.');
        }
    }
}