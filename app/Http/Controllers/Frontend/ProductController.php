<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function productByCat($id)
    {
        $products = Product::with(['category','file'])->whereCategory_id($id)->get();
        if($products->count() < 1){
            Alert::info('Opps..','No Product Found');
            return back();
        }
        return view('frontend.product_by_cat', compact('products'));
    }

    public function productBySubCat($id)
    {
        $products = Product::with(['file'])->whereSub_category_id($id)->get();
        if($products->count() < 1){
            Alert::info('Opps..','No Product Found');
            return back();
        }
        return view('frontend.product_by_cat', compact('products'));
    }

    public function show($id)
    {
        $product = Product::with(['file'])->whereId($id)->first();
        auth()->check() ?
        $cart = Cart::whereUser_id(user()->id)->whereProduct_id($id)->first() :
        $cart = 1;
        return view('frontend.product_show', compact('product','cart'));
    }
}
