@extends('layouts.layout')
@section("title", "Orders")
@section('content')
    <div class="row">
        <div class="col-sm-12">
            {{ Breadcrumbs::render('orders') }}
        </div>
        <div class="row">
            <div class="col-sm-12">
                @include("layouts.message")
            </div>
        </div>
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Analysts</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover table-responsive" width="100%">
                        <thead>
                            <tr>
                                <td>Total orders</td>
                                <td>$</td>
                                <td>Order need pay</td>
                                <td>$</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{\App\Order::count()}}</td>
                                <td>{{\App\Order::all()->sum("price")}}</td>
                                <td>Order need pay</td>
                                <td>$</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Orders</h3>
                </div>
                <div class="panel-body">
                    @include('orders._orders')
                </div>
                @if(Auth::user()->can("views_full"))
                    <div class="panel-footer">
                        <a href="{{url()->route("orders.create")}}" class="btn btn-primary"><i class="fa fa-user-plus fa-fw"></i> Create a new order</a>
                        <a href="{{url()->route("import.create")}}" class="btn btn-success"><i class="fa fa-fw fa-upload"></i> Import Data</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    @include("orders._script")
@endsection
