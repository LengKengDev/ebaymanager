<?php

namespace App\Http\Controllers;

use App\Account;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Validator;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("orders.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accounts = Account::all();
        $users = User::all();
        return view("orders.create", compact("accounts", "users"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "user_id" => "exists:users,id",
            "account_id" => "exists:accounts,id",
            "buyer" => "required",
            "transaction_id" => "required|unique:orders"
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)
                ->withInput();
        }

        $order = Order::create([
            "transaction_id" => $request->input("transaction_id"),
            "user_id" => $request->input("user_id"),
            "account_id" => $request->input("account_id"),
            "address" => $request->input("address", ""),
            "buyer" => $request->input("buyer", ""),
            "item" => $request->input("item", ""),
            "tracking" => $request->input("tracking", ""),
            "note" => $request->input("note", ""),
        ]);

        return redirect()->route("home")->with("status", "Order has been created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $accounts = Account::all();
        $users = User::all();
        return view("orders.edit", compact("order", "users", "accounts"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        if ($request->input("user_id", $order->user_id) != 0) {
            $order->user_id = $request->input("user_id", $order->user_id);
        }
        if ($request->input("account_id", $order->account_id) != 0) {
            $order->account_id = $request->input("account_id", $order->account_id);
        }
        $order->buyer = $request->input("buyer", $order->buyer);
        $order->address = $request->input("address", $order->address);
        $order->item = $request->input("item", $order->item);
        $order->price = $request->input("price", $order->price);
        $order->tracking = $request->input("tracking", $order->tracking);
        $order->note = $request->input("note", $order->note);
        $order->site = $request->input("site", "");
        $order->email = $request->input("email", "");
        $order->number = $request->input("number", "");
        $order->save();

        return back()->with("status", __("Order :id has been updated", ["id" => $order->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return back()->with("status", "Order has been deleted");
    }

    /**
     * @param Request $request
     */
    public function destroyMultiOrders(Request $request)
    {
        $orders = Order::whereIn("id", $request->input("ids", []))->get();
        $count  = 0;
        foreach ($orders as $order) {
            $order->delete();
            $count++;
        }

        return back()->with("status", __("Successfully deleted :count orders", ["count" => $count]));
    }

    /**
     * @param Request $request
     */
    public function assignUserForOrders(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id'
        ]);

        if ($validator->fails()) {
           return back()->with("status", "User does't exists");
        }
        $user_id = $request->input("user_id");
        $orders = Order::whereIn("id", $request->input("ids", []))->get();

        $count = 0;
        foreach ($orders as $order) {
            $order->user_id = $user_id;
            $order->save();
            $count++;
        }

        return back()->with("status", __("Successfully updated :count orders", ["count" => $count]));
    }
}
