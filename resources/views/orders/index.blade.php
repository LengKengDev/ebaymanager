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
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Orders</h3>
                </div>
                <div class="panel-body">
                    @include('orders._orders')
                </div>
                @if(Auth::user()->can("views_full"))
                    <div class="panel-footer">

                        <br>
                        <div class="row">
                            <div class="col-sm-3">
                                <form action="{{url()->route("orders.assign")}}" method="POST" id="assign" class="form-horizontal">
                                    {{csrf_field()}}
                                    @method("PATCH")
                                    <div class="form-group">
                                        <label for="email" class="col-sm-4 control-label text-muted text-right">Assign for</label>

                                        <div class="col-sm-4">
                                            <select name="user_id" id="" class="form-control">
                                                <option value="0">Select</option>
                                                @foreach(\App\User::all() as $user)
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <button class="btn btn-primary assign"><i class="fa fa-fw fa-bitcoin"></i>Assign</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-1 col-sm-offset-8">
                                <form action="{{url()->route("orders.remove")}}" method="POST" id="delete" class="form-horizontal">
                                    {{csrf_field()}}
                                    @method("DELETE")
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-danger delete"><i class="fa fa-fw fa-trash"></i>Delete select</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    @include("orders._script")
@endsection
