<?php

namespace App\Http\Controllers;

use App\Http\Middleware\HasAdminRole;
use App\Order;
use DateTime;
use Illuminate\Http\Request;
use Validator;
use Excel;
use Exception;

class ImportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware([HasAdminRole::class]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view("import.create");
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
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
                    $date = new DateTime($item["paid_on_date"]);
                    Order::create([
                        "account_id" => $request->input("account_id"),
                        "buyer" => $item["user_id"],
                        "item" => $item["item_title"],
                        "quantity" => $item["quantity"],
                        "paid_on_date" => $item["paid_on_date"],
                        "transaction_id" => $item["paypal_transaction_id"] ?: $item["transaction_id"],
                        "price" => str_replace("$", "",$item["total_price"]),
                        "note" => $item["paid_on_date"] == null ? "" : "Order add new at: {$date->format("d/m/Y")}",
                        "address" => " {$item["buyer_fullname"]} | {$item["buyer_phone_number"]} | {$item["buyer_address_1"]} | {$item["buyer_city"]} | {$item["buyer_state"]} | {$item["buyer_country"]} | (Zip: {$item["buyer_zip"]})"
                    ]);
                }
            }
        } catch (Exception $exception){
            return back()->with("status", __("File CSV can't parse with error: :error", ["error" => $exception->getMessage()]));
        }


        return back()->with("status", __("Successfully imported :count orders", ['count' => $count]));
    }
}
