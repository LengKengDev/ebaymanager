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
        $users = User::select(['id','name', 'per', 'created_at', 'email']);
        return DataTables::of($users)
            ->addColumn('action', 'users._action')
            ->addColumn('needPay', function ($user) {
                return money($user->needPay(), 'USD');
            })
            ->addColumn('total', function ($user) {
                return $user->orders->count(). " orders (".money($user->totalAmount(), "USD").")";
            })
            ->addColumn('delivered', function ($user) {
                return $user->totalOrdersDelivered(). " orders (".money($user->totalAmountDelivered(),"USD").")";
            })
            ->editColumn('name', 'users._name')
            ->editColumn('created_at', function ($account) {
                return $account->created_at->diffForHumans();
            })
            ->editColumn('per', function ($account) {
                return $account->per." %";
            })
            ->rawColumns(['name', 'action'])
            ->make();
    }
}
