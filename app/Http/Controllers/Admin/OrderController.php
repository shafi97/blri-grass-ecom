<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        if ($error = $this->authorize('order-manage')) {
            return $error;
        }
        $orders = Sale::with(['user','product.user','product'])->latest()->get();
        return view('dashboard.order.index', compact('orders'));
    }
}
