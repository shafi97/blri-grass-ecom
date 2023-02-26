<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if ($error = $this->authorize('order-manage')) {
            return $error;
        }
        if ($request->ajax()) {
            user()->role == 1 ? $orders = Order::with(['user','product'])->latest() :
                $orders = Order::whereUser_id(user()->id)->with(['user','product'])->latest();
            return DataTables::eloquent($orders)
                ->addIndexColumn()
                ->addColumn('created_at', function ($row) {
                    return bdDateTime($row->created_at);
                })
                ->addColumn('image', function ($row) {
                    $src = imagePath('product', $row->image);
                    return '<img src="' . $src . '" width="200px">';
                })
                ->addColumn('discountPrice', function ($row) {
                    return number_format($row->price - ($row->price * $row->discount) / 100, 2);
                })
                ->addColumn('action', function ($row) {
                    $btn = '';
                    // if (userCan('order-edit')) {
                    //     $btn .= view('button', ['type' => 'ajax-edit', 'route' => route('admin.slider.edit', $row->id), 'row' => $row]);
                    // }
                    // if (userCan('order-delete')) {
                    //     $btn .= view('button', ['type' => 'ajax-delete', 'route' => route('admin.slider.destroy', $row->id), 'row' => $row, 'src' => 'dt']);
                    // }
                    return $btn;
                })
                ->filter(function ($query) use ($request) {
                    if ($request->has('product_id') && $request->product_id != '') {
                        $query->where('product_id', $request->product_id);
                    }
                })
                ->filter(function ($query) use ($request) {
                    if ($request->has('user_id') && $request->user_id != '') {
                        $query->where('user_id', $request->user_id);
                    }
                })
                ->rawColumns(['discountPrice', 'image', 'action', 'created_at'])
                ->make(true);
        }
        return view('dashboard.order.index');
    }
}
