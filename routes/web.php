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

Route::namespace('Api')->prefix("api")->name("api.")->group(function () {
    Route::resource("accounts", "AccountsController", ["only" => ["index"]]);
    Route::resource("users", "UsersController", ["only" => ["index"]]);
});
