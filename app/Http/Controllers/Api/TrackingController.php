<?php

namespace App\Http\Controllers\Api;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ixudra\Curl\Facades\Curl;
use Yangqi\Htmldom\Htmldom;

class TrackingController extends Controller
{
    private $base_url = "http://shipit-api.herokuapp.com/api/";
    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        if(strlen($order->tracking) == 0) {
            return back()->with("status",  "Order haven't tracking code");
        }
        $response = Curl::to($this->base_url."guess/{$order->tracking}")->asJson()->get();
        $carrier = $response[0] ?? null;
        if ($carrier != null) {
            $url = $this->base_url."carriers/$carrier/{$order->tracking}";
            $response = Curl::to($url)->asJson($url)->get();
            $status = $response["activities"][0]["details"] ?? null;
            if ($status != null) {
                $order->status= $status;
                $order->save();
                return back()->with("status", "Order {$order->id} update status to `{$status}`");
            }
            return back()->with("status", "Tracking code incorrect");

        }
        else {
            return back()->with("status",  "Order haven't tracking code");
        }
    }
}
