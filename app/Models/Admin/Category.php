<?php

namespace App\Models\Admin;

use App\Models\Admin\Subcategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }  
     
}