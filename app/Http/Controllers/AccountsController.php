<?php

namespace App\Http\Controllers;

use App\Account;
use App\Http\Middleware\HasAdminRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountsController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('accounts.index');
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
            "name" => "required"
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)
                ->withInput();
        }

        $account = Account::create(["name" => $request->input("name")]);

        return redirect()->route("accounts.index")
                ->with("status", __("Account `:account` has been created", ["account" => $account->name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        return view("accounts.show", compact("account"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        return view("accounts.edit", compact("account"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required"
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)
                ->withInput();
        }

        $account->name = $request->input("name", $account->name);
        $account->save();

        return back()
            ->with("status", __("Account `:account` has been updated", ["account" => $account->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        $account->delete();
        return back()->with("status", __("Account `:account` has been deleted", ["account" => $account->name]));
    }
}
