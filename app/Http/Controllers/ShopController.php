<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\ProductImage;
use App\Models\Admin\Subcategory;
use App\Models\Admin\ProductSubcategory;

class ShopController extends Controller
{
    public function shop()
    {
        $product = Product::paginate(1);
        $subcategories = Subcategory::get();
        $product_subcategory = ProductSubcategory::get();

        // dd($product->links);
        
        return view('admin.shop.shop', compact('product', 'subcategories', 'product_subcategory'));
    }

    public function productDetails($id)
    {
        $product = Product::find($id);
        $product_image = ProductImage::where('product_id', $id)->get(); 

        return view('admin.shop.product-details', compact('product', 'product_image'));
    }

    public function cart()
    {
        return view('admin.shop.cart');
    }
}