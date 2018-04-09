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

        $ids = Order::all()->pluck("transaction_id")->toArray();

        $request->file('csv')->getRealPath();

        $data = Excel::load($request->file('csv')->getRealPath(), function($reader) {})->get()->toArray();

        $count = 0;

        try {
            foreach ($data as $item) {
                if(!in_array($item["paypal_transaction_id"] ?: $item["transaction_id"], $ids)){
                    $count++;
                    Order::create([
                        "account_id" => $request->input("account_id"),
                        "buyer" => $item["buyer_fullname"],
                        "item" => $item["item_title"],
                        "quantity" => $item["quantity"],
                        "transaction_id" => $item["paypal_transaction_id"] ?: $item["transaction_id"],
                        "price" => str_replace("$", "",$item["total_price"]),
                        "note" => "Email: {$item["buyer_email"]} \n Payment Method: {$item["payment_method"]} \n Shipping service: {$item["shipping_service"]} \n Order add new at: {$item["paid_on_date"]} \n <span class='text-warning'>Note</span>: \n {$item["notes_to_yourself"]}",
                        "address" => "{$item["buyer_phone_number"]} | {$item["buyer_address_1"]} | {$item["buyer_city"]} | {$item["buyer_state"]} | {$item["buyer_country"]} | (Zip: {$item["buyer_zip"]})"
                    ]);
                }
            }
        } catch (Exception $exception){
            return back()->with("status", __("File CSV can't parse with error: :error", ["error" => $exception->getMessage()]));
        }


        return back()->with("status", __("Successfully imported :count orders", ['count' => $count]));
    }
}
