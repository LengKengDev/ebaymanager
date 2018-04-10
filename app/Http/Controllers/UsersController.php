<?php

namespace App\Http\Controllers;

use App\Http\Middleware\HasAdminRole;
use App\User;
use Illuminate\Http\Request;
use Validator;

class UsersController extends Controller
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
        return view("users.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("users.create");
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            "per" => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            "name" => $request->input("name"),
            "email" => $request->input("email"),
            "password" => bcrypt($request->input("password")),
            "per" => $request->input("per", 0),
        ]);
        return redirect()->route("users.index")
            ->with("status", __("User :email has been created", ["email" => $user->email]));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, User $user)
    {
        $histories = $user->getTransactions($request);
        return view("users.show", compact("user", 'histories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view("users.edit", compact("user"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required"
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        $user->name = $request->input("name", $user->name);
        $user->per = $request->input("per", $user->per);
        $user->save();

        return back()->with("status", __("User `:email` has been updated", ["email" => $user->email]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        if($user->cannot("views_full")) {
            $user->delete();
            return back()->with("status", __("User `:email` has been deleted!", ["email" => $user->email]));
        }

        return back()->with("status", __("You can't delete user`:email`", ["email" => $user->email]));
    }
}
