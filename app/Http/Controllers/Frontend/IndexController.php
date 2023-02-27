<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Slider;
use App\Models\Partner;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        $products = Product::with(['file'])->get();
        $discountProducts = Product::with(['file'])->whereNotNull('discount')->orderBy('discount', 'DESC')->get();
        $partners = Partner::all();
        // return Category::withCount(['products'])->get(['id', 'name']);
        return view('frontend.index', compact('sliders','products','discountProducts','partners'));
    }
}
