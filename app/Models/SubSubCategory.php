<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubSubCategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ["id"];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id','id');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id','id');
    }
}
