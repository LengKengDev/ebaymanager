<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Order;
use Ixudra\Curl\Facades\Curl;
use Yangqi\Htmldom\Htmldom;

class TrackingController extends Controller
{
    private $base_url="http://shipit-api.herokuapp.com/api/";

    /**
     * Display the specified resource.
     *
     * @param  \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        if (strpos($order->tracking, 'TBA')) {
            $order->status= "Delivered";
            $order->save();
            return response()->json(["status"=>"Order {$order->id} update status to `{$order->status}`"]);
        }

        if (strlen($order->tracking) == 0) {
            return response()->json(["status"=>"Order haven't tracking code"], 500);
        }
        $response=Curl::to($this->base_url . "guess/{$order->tracking}")->asJson()->get();


        $carrier=$response[0] ?? null;

        if (is_array($response) && count($response) > 1) {
            $carrier=$response;
        }

        if (is_array($carrier)) {
            foreach ($carrier as $c) {
                switch ($c) {
                    case null:
                        break;
                    case "ups";
                        $url="http://www.theupsstore.ca/track/{$order->tracking}/";
                        $html=new Htmldom($url);
                        $array=$html->find('td.desc');
                        if (count($array) > 0) {
                            $status=$array[0]->text();
                            if (strpos($status, "delivered") !== false || strpos($status, "Delivered") !== false || stripos($status, "Received By The Local Post Office") !== false || stripos($status, "Package Transferred To Post Office") !== false) {
                                $status="Delivered";
                            }
                            $order->status=$status;
                            $order->save();
                        }
                        break;
                    default:
                        $url=$this->base_url . "carriers/$c/{$order->tracking}";
                        $response=Curl::to($url)->asJson($url)->get();
                        $status=$response["activities"][0]["details"] ?? null;
                        if ($status != null) {
                            if (strpos($status, "delivered") !== false || strpos($status, "Delivered") !== false || stripos($status, "Received By The Local Post Office") !== false || stripos($status, "Package Transferred To Post Office") !== false) {
                                $status="Delivered";
                            }
                            $order->status=$status;
                            $order->save();
                        }
                }
            }
            return response()->json(["status"=>"Order {$order->id} update status to `{$order->status}`"]);
        } else {
            switch ($carrier) {
                case null:
                    return response()->json(["status"=>"Tracking code incorrect"], 500);
                    break;
                case "ups";
                    $url="http://www.theupsstore.ca/track/{$order->tracking}/";
                    $html=new Htmldom($url);
                    $array=$html->find('td.desc');
                    if (count($array) > 0) {
                        $status=$array[0]->text();
                        if (strpos($status, "delivered") !== false || strpos($status, "Delivered") !== false || stripos($status, "Received By The Local Post Office") !== false || stripos($status, "Package Transferred To Post Office") !== false) {
                            $status="Delivered";
                        }
                        $order->status=$status;
                        $order->save();
                    }
                    return response()->json(["status"=>"Order {$order->id} update status to `{$order->status}`"]);
                    break;
                default:
                    $url=$this->base_url . "carriers/$carrier/{$order->tracking}";
                    $response=Curl::to($url)->asJson($url)->get();
                    $status=$response["activities"][0]["details"] ?? null;
                    if ($status != null) {
                        if (strpos($status, "delivered") !== false || strpos($status, "Delivered") !== false || stripos($status, "Received By The Local Post Office") !== false || stripos($status, "Package Transferred To Post Office") !== false) {
                            $status="Delivered";
                        }
                        $order->status=$status;
                        $order->save();
                        return response()->json(["status"=>"Order {$order->id} update status to `{$status}`"]);
                    }
                    return response()->json(["status"=>"Tracking code incorrect"], 500);
            }
        }
    }
}
