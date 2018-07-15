<?php

namespace App\Http\Controllers\Api;

use App\Order;
use DateTime;
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
            ->editColumn('status', 'orders._status')
            ->editColumn('price', function ($order) {
                return money($order->price, 'USD', true);
            })
            ->editColumn('last_update', function ($order) {
                $date = new DateTime($order->last_update);
                if ($order->last_update == null) {
                    return '';
                }
                return $date->format("d/m/Y");
            })
            ->editColumn('item', function ($order) {
                return "<b class='text-primary text-lg'>{$order->quantity}</b> x <span title='$order->item'>".str_limit($order->item, 30)."</span>";
            })
            ->editColumn('address', function ($order) {
                return "<span title='$order->address'>".str_limit($order->address, 30)."</span>";
            })
            ->editColumn('tracking', 'orders._tracking')
            ->editColumn('note', function ($order) {
                if ($order->tracking != null) {
                    return "<span class='text-primary'>{$order->note}</span>";
                }
                return "{$order->note} | {$order->site} | {$order->email} | {$order->number}";
            })
            ->editColumn('buyer', function ($order) {
                return "<a target='_new' href='https://feedback.ebay.com/ws/eBayISAPI.dll?ViewFeedback2&userid={$order->buyer}&ftab=AllFeedback'>{$order->buyer}</a>";
            })
            ->editColumn('account.name', function ($order) {
                if ($order->account == null) {
                    return "<span class='text-danger'>Not Set</span>";
                }
                return "<a target='_new' href='https://feedback.ebay.com/ws/eBayISAPI.dll?ViewFeedback2&userid=".($order->account->name == null ? '': $order->account->name)."&ftab=AllFeedback'>".($order->account->name == null ? '': $order->account->name)."</a>";
            })
            ->editColumn('user.name', function ($order) {
                if ($order->user == null) {
                    return "<span class='text-danger'>Not Set</span>";
                }
                return "<a target='_new' href='".(url()->route('users.show', ['user' => $order->user]))."'>{$order->user->name}</a>";
            })
            ->addColumn("is_tracking", function ($order) {
                return is_null($order->tracking);
            })
            ->rawColumns(['status', 'action', 'item', 'note', 'tracking', 'account.name', 'buyer', 'user.name', 'address'])
            ->make();
    }
}
