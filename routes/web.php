<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource("/", "HomeController", ["names" => ["index" => "home"], "only" => ["index"]]);

Auth::routes();

Route::resource("/accounts", "AccountsController", [
    "only" => ["index", "store", "edit", "update", "destroy"]
]);

Route::resource("/users", "UsersController", [
    "only" => ["index", "show", "create", "store", "edit", "update", "destroy"]
]);

Route::patch("/orders/assign", "OrdersController@assignUserForOrders")->name("orders.assign");
Route::delete("/orders/remove", "OrdersController@destroyMultiOrders")->name("orders.remove");

Route::resource("/orders", "OrdersController", [
    "only" => ["index", "show", "create", "store", "edit", "update", "destroy"]
]);

Route::resource("/import", "ImportController", [
    "only" => ["create", "store"]
]);

Route::namespace('Api')->prefix("api")->name("api.")->group(function () {
    Route::resource("accounts", "AccountsController", ["only" => ["index"]]);
    Route::resource("users", "UsersController", ["only" => ["index"]]);
    Route::resource("orders", "OrdersController", ["only" => ["index"]]);
    Route::resource("tracking", "TrackingController", [
        "only" => ["show"],
        "parameters" => [
            "tracking" => "order"
        ]
    ]);
});

Route::resource("/transactions", "TransactionsController", [
    "only" => ["destroy", "store"]
]);

Route::resource("/cron", "CronController", ['only' => ['index']]);
