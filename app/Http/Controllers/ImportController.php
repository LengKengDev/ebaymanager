<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Validator;
use Excel;
use Exception;

class ImportController extends Controller
{
    public function create()
    {
        return view("import.create");
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'csv'      => 'required|file|mimetypes:application/vnd.ms-excel,text/plain,text/csv,text/tsv',
            "account_id" => "exists:accounts,id",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $request->file('csv')->getRealPath();

        $data = Excel::load($request->file('csv')->getRealPath(), function($reader) {})->get()->toArray();

        $count = 0;

        try {
            foreach ($data as $item) {
                $count++;
                Order::create([
                    "account_id" => $request->input("account_id"),
                    "buyer" => $item["buyer_fullname"],
                    "item" => $item["item_title"]." x ".$item["quantity"],
                    "price" => str_replace("$", "",$item["total_price"]),
                    "note" => "Email: {$item["buyer_email"]} \n Payment Method: {$item["payment_method"]} \n Shipping service: {$item["shipping_service"]} \n Note: {$item["notes_to_yourself"]}",
                    "address" => "{$item["buyer_address_1"]}, {$item["buyer_city"]}, {$item["buyer_state"]}, {$item["buyer_country"]}, (Zip: {$item["buyer_zip"]})"
                ]);
            }
        } catch (Exception $exception){
            return back()->with("status", __("File CSV can't parse with error: :error", ["error" => $exception->getMessage()]));
        }


        return back()->with("status", __("Successfully imported :count orders", ['count' => $count]));
    }
}
