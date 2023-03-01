<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GlobalController extends Controller
{
    public function getSubCategory(Request $request)
    {
        if ($request->ajax()){
            $datum = SubCategory::whereCategory_id($request->category_id)->get();
            $subCategories = view('dashboard.includes.sub_category', ['datum' => $datum])->render();
            return response()->json(['status' => 'success', 'html' => $subCategories, 'subCategories']);
        }
    }
}
