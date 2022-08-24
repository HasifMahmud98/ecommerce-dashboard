<?php

namespace App\Models\Admin;

use App\Models\Admin\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subcategory extends Model
{
    protected $guarded = [];
    // protected $fillable = [
    //     'name',
    //     'category_id' ,
    //     'description',
    // ];
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}