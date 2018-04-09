<?php

namespace App\Http\Controllers\Api;

use App\Http\Middleware\HasAdminRole;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;

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
        $users = User::select(['id','name', 'created_at', 'email']);

        return DataTables::of($users)
            ->addColumn('action', 'users._action')
            ->editColumn('name', 'users._name')
            ->editColumn('created_at', function ($account) {
                return $account->created_at->diffForHumans();
            })
            ->rawColumns(['name', 'action'])
            ->make();
    }
}
