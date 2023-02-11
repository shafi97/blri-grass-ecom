<?php

namespace App\Models;

use App\Models\Traits\Hasid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ["id"];



    public function subCategories()
    {
        return $this->hasMany(SubCategory::class, 'category_id', 'id')->orderBy('name');
    }
}
