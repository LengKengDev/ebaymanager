<?php

namespace App\Http\Controllers\Api;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ixudra\Curl\Facades\Curl;
use Yangqi\Htmldom\Htmldom;
use Sunra\PhpSimple\HtmlDomParser;

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
            return response()->json(["status" =>  "Order haven't tracking code"], 500);
        }
        $response = Curl::to($this->base_url."guess/{$order->tracking}")->asJson()->get();
        $carrier = $response[0] ?? null;
        switch ($carrier) {
            case null:
                break;
            case "ups";
                $url = "http://www.theupsstore.ca/track/{$order->tracking}/";
                $html = new Htmldom($url);
                $array = $html->find('td.desc');
                if (count($array) > 0) {
                    $order->status = $array[0]->text();
                    $order->save();
                }
                return response()->json(["status" => "Order {$order->id} update status to `{$order->status}`"]);
                break;
            default:
                $url = $this->base_url."carriers/$carrier/{$order->tracking}";
                $response = Curl::to($url)->asJson($url)->get();
                $status = $response["activities"][0]["details"] ?? null;
                if ($status != null) {
                    if (strpos($status, "Delivered") !== false) {
                        $status = "Delivered";
                    }
                    $order->status= $status;
                    $order->save();
                    return response()->json(["status" => "Order {$order->id} update status to `{$status}`"]);
                }
                return response()->json(["status" =>  "Tracking code incorrect"], 500);
        }
        return response()->json(["status" =>  "Order haven't tracking code"], 500);
    }
}
