<?php

namespace App\Models\Admin;

use App\Models\Admin\Product;
use App\Models\Admin\Subcategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductSubcategory extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
}