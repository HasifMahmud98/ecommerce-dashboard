<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Category;
use App\Models\Admin\Subcategory;
use App\Models\Admin\ProductSubcategory;
use App\Models\Admin\ProductImage;
use Illuminate\Support\Facades\DB;
use App\Traits\FileSaver;
use Carbon\Carbon;

class ProductController extends Controller
{
    use FileSaver;
    
    public function __construct(ProductImage $productImage)
    {
        
        $this->image = $productImage;
    }
    
    
    public function index()
    {
        $product = Product::get();
        $subcategories = Subcategory::get();
        $product_subcategory = ProductSubcategory::get();
        
        return view('admin.product.index', compact('product', 'subcategories', 'product_subcategory'));
    }
    
    public function create()
    {
        $category = Category::get();
        $subcategory = Subcategory::get();
        
        return view('admin.product.create', compact('category', 'subcategory'));
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $subcategory = Subcategory::get();
        $selected_subcategory = ProductSubcategory::where('product_id', $id)->get();        
        $product_image = ProductImage::where('product_id', $id)->get();

        return view('admin.product.edit',compact('product', 'selected_subcategory', 'subcategory', 'product_image'));
    }

    public function getSubcategory($id)
    {
        
        $subcategory = Subcategory::where('category_id', $id)->get();
        
        return response()->json($subcategory);
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

            if($request->featured == "on") {
                $featured = 1;
            } else {
                $featured = 0;
            }
            
            $discount_start = Carbon::parse($request->discount_start)->format('Y-m-d H:i:s');
            $discount_end = Carbon::parse($request->discount_end)->format('Y-m-d H:i:s');

            $product = Product::create([

                'name'              => $request->name,
                'price'             => $request->price,
                'discount'          => $request->discount,
                'discount_start'    => $discount_start,
                'discount_end'      => $discount_end,
                'summary'           => $request->summary,
                'description'       => $request->description,
                'status'            => $status,
                'featured'          => $featured,
                'meta_title'        => $request->meta_title,
                'meta_description'  => $request->meta_description,
                'meta_keywords'     => $request->meta_keywords,
            ]);

            // Upload Image
            $this->UploadWebp($request->thumbnail[0], $product, 'thumbnail', 'uploads/product', 940 , 705);

            $this->UploadMultipleWebp($request->image, $this->image, 'product_id', $product->id, 'image', 'uploads/product', 968 , 645);
            
            foreach ($request->subcategory_id as $key => $item) {
                ProductSubcategory::create([

                    'Product_id'        => $product->id,
                    'subcategory_id'    => $item

                ]);
            }
            
            DB::commit();
            return redirect()->route('product.index')->withMessage('Product Save Succesfully');

        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            return redirect()->back()->withError('Something went wrong! Please try again.');
        }
        
    }

    public function update(Request $request,$id)
    {
        try {

            DB::beginTransaction();

            $product = Product::find($id);

            // dd($product);

            if ($request->status) {
                if($request->status == "on") {
                    $status = 1;
                } else {
                    $status = 0;
                }
            }
            else {
                $status = $product->status;
            }

            if ($request->status) {
                if($request->featured == "on") {
                    $featured = 1;
                } else {
                    $featured = 0;
                }
            }
            else {
                $featured = $product->featured;
            }
            
            if ($request->discount_start) {
                $discount_start = Carbon::parse($request->discount_start)->format('Y-m-d H:i:s');
            }
            else {
                $discount_start = Carbon::parse($product->discount_start)->format('Y-m-d H:i:s');
            }
            if($request->discount_end){
                $discount_end = Carbon::parse($request->discount_end)->format('Y-m-d H:i:s');
            }
            else {
                $discount_start = Carbon::parse($product->discount_end)->format('Y-m-d H:i:s');
            }

            $product->update([

                'name'              => $request->name,
                'price'             => $request->price,
                'discount'          => $request->discount,
                'discount_start'    => $discount_start,
                'discount_end'      => $discount_end,
                'summary'           => $request->summary,
                'description'       => $request->description,
                'status'            => $status,
                'featured'          => $featured,
                'meta_title'        => $request->meta_title,
                'meta_description'  => $request->meta_description,
                'meta_keywords'     => $request->meta_keywords,
            ]);

            // Upload Image
            $this->UploadWebp($request->thumbnail[0] ?? "", $product, 'thumbnail', 'uploads/product', 940 , 705);

            $this->UploadMultipleWebp($request->image ?? "", $this->image, 'product_id', $product->id, 'image', 'uploads/product', 968 , 645);

            // $subcategories = explode(',', $request->subcategory_id);
            
            if($request->subcategory_id) {
                $get_existing = $product->ProductSubcategorys;
                $get_existing->each->delete();
                
                
                foreach ($request->subcategory_id as $key => $item) {
                    ProductSubcategory::create([
    
                        'Product_id'        => $product->id,
                        'subcategory_id'    => $item
    
                    ]);
                }
            }
            
            DB::commit();
            return redirect()->route('product.index')->withMessage('Category Save Succesfully');


        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            return redirect()->back()->withError('Something went wrong! Please try again.');
        }
    }


    public function destroy($id)
    {
        try {

            $product = Product::find($id)->delete();
            return redirect()->route('category.index')->withMessage('Category Delete Succesfully');
        } catch (\Throwable $th) {

            return redirect()->back()->withError('Something went wrong! Please try again.');
        }
    }
}