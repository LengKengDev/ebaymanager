<?php

namespace App\Http\Controllers\Api;

use App\Account;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;

class AccountsController extends Controller
{
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
            ->rawColumns(['name', 'action'])
            ->make();
    }
}
