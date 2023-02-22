<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Slider;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class IndexController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        $products = Product::with(['file'])->get();
        $discountProducts = Product::with(['file'])->whereNotNull('discount')->orderBy('discount', 'DESC')->get();
        // return Category::withCount(['products'])->get(['id', 'name']);
        return view('frontend.index', compact('sliders','products','discountProducts'));
    }
}
