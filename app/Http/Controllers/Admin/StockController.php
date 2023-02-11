<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        if ($error = $this->authorize('stock-manage')) {
            return $error;
        }
        $stocks = Product::withCount(['sales'])->latest()->get();
        return view('dashboard.order.index', compact('stocks'));
    }
}
