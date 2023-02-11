<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function productByCat($id)
    {
        $products = Product::with(['file'])->whereCategory_id($id)->get();
        return view('frontend.product_by_cat', compact('products'));
    }

    public function productBySubCat($id)
    {
        $products = Product::with(['file'])->whereSub_category_id($id)->get();
        return view('frontend.product_by_cat', compact('products'));
    }

    public function show($id)
    {
        // return user()->district_id;
        $product = Product::with(['file'])->whereid($id)->first();

        auth()->check() ?
        $cart = Cart::whereUser_id(user()->id)->whereProduct_id($id)->first() :
        $cart = 1;


        return view('frontend.product_show', compact('product','cart'));
    }
}
