<?php

namespace App\Http\Controllers\Api;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        $orders = null;

        if ($request->user()->can("views_full")) {
            $orders = Order::with(["user", "account"])->select();
        }
        else {
            $orders = $request->user()->orders;
            $orders->load(["user", "account"]);
        }

        return DataTables::of($orders)
            ->addColumn('action', 'orders._action')
            ->editColumn('status', function ($order) {
                return ucwords(str_replace("_", " ", $order->status));
            })
            ->editColumn('item', function ($order) {
                return "<b class='text-primary text-lg'>{$order->quantity}</b> x ".$order->item;
            })
            ->rawColumns(['action', 'item', 'note'])
            ->make();
    }
}
