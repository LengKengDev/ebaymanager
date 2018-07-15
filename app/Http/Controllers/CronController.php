<?php

namespace App\Http\Controllers;

use App\Jobs\OrderTracking;
use App\Order;
use Illuminate\Http\Request;

class CronController extends NoAuthController
{
    public function index()
    {
        $i = 1;
        $orders = Order::where('status', '!=', 'Delivered')->get();

        foreach ($orders as $order) {
            $this->dispatch((new OrderTracking($order))->delay($i++));
        }
        return view('cron.index');
    }
}
