<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function subcategories()
    {
        return $this->belongsToMany(Subcategory::class);
    }
    
}