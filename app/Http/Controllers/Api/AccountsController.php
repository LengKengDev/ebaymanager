<?php

namespace App\Http\Controllers\Api;

use App\Account;
use App\Http\Middleware\HasAdminRole;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;

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
        $accounts = Account::select(['id','name', 'created_at']);

        return DataTables::of($accounts)
            ->addColumn('action', 'accounts._action')
            ->editColumn('name', 'accounts._name')
            ->editColumn('created_at', function ($account) {
                return $account->created_at->diffForHumans();
            })
            ->addColumn('total', function ($account) {
                return $account->orders->count()." orders ( {$account->totalAmount()} $)";
            })
            ->rawColumns(['name', 'action'])
            ->make();
    }
}
