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
            user()->role == 1 ? $orders = Order::with(['product'])->latest() :
                $orders = Order::whereUser_id(user()->id)->with(['product'])->latest();
            return DataTables::eloquent($orders)
                ->addIndexColumn()
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('image', function ($row) {
                    $src = imagePath('product', $row->image);
                    return '<img src="' . $src . '" width="200px">';
                })



                ->addColumn('product', function (Order $order) {
                    return $order->product->name;
                })


                ->addColumn('action', function ($row) {
                    $btn = '';
                    if (userCan('order-edit')) {
                        $btn .= view('button', ['type' => 'ajax-edit', 'route' => route('admin.slider.edit', $row->id), 'row' => $row]);
                    }
                    if (userCan('order-delete')) {
                        $btn .= view('button', ['type' => 'ajax-delete', 'route' => route('admin.slider.destroy', $row->id), 'row' => $row, 'src' => 'dt']);
                    }
                    return $btn;
                })
                ->rawColumns(['image', 'action', 'created_at'])
                ->make(true);
        }
        return view('dashboard.order.index');
    }
}
