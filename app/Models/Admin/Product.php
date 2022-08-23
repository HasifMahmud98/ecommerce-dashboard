<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\ProductSubcategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function subcategories()
    {
        return $this->belongsToMany(Subcategory::class);
    }
    
    public function ProductSubcategorys()
    {
        return $this->hasMany(ProductSubcategory::class, 'product_id', 'id');
    }
}