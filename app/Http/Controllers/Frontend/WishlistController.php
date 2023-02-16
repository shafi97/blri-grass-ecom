<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class WishlistController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $wishlists = Wishlist::with(['product', 'product.file'])->whereUser_id(user()->id)->get();
            return view('frontend.wishlist', compact('wishlists'));
        } else {
            return redirect()->route('index');
        }
    }

    public function store(Request $request)
    {
        try {
            Wishlist::updateOrCreate(
                [
                    'product_id' => $request->product_id,
                    'user_id' => user()->id
                ],
                [
                    'product_id' => $request->product_id,
                    'user_id' => user()->id,
                    // 'quantity' => 1,
                ]
            );
            return response()->json(['message' => 'Added to wishlist'], 200);
        } catch (\Exception $e) {
            // return response()->json(['message'=>__('app.oops')], 500);
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function wishlistAddToCart(Request $request)
    {
        $product_id = Wishlist::find($request->id)->product_id;
        try {
            Cart::updateOrCreate(
                [
                    'product_id' => $product_id,
                    'user_id' => user()->id
                ],
                [
                    'product_id' => $product_id,
                    'user_id' => user()->id,
                    'quantity' => 1,
                ]
            );
            Wishlist::find($request->id)->delete();
            return response()->json(['message' => 'Added to cart'], 200);
        } catch (\Exception $e) {
            // return response()->json(['message'=>__('app.oops')], 500);
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function show()
    {
        $wishlists = Wishlist::with(['product', 'product.file'])->whereUser_id(user()->id)->get();
        $wishlist = view('frontend.layouts.includes.wishlist', ['wishlists' => $wishlists])->render();
        return response()->json(['status' => 'success', 'html' => $wishlist, 'wishlist']);
    }

    public function destroy(Request $request)
    {
        try {
            Wishlist::find($request->id)->delete();
            return response()->json(['message' => 'Remove from wishlist'], 200);
        } catch (\Exception $e) {
            // return response()->json(['message'=>__('app.oops')], 500);
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        try {
            Wishlist::find($id)->delete();
            Alert::success('Success', 'Cart deleted successfully');
            return back();
        } catch (\Exception $e) {
            return back();
            Alert::success('Success', 'Cart delete failed');
            return back();
            // return response()->json(['message'=>__('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }
}
