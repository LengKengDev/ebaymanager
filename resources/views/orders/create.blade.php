@extends('layouts.layout')
@section("title", "Create a new order")
@section('content')
    <div class="row">
        <div class="col-sm-12">
            {{ Breadcrumbs::render('orders.create') }}
        </div>
        <div class="row">
            <div class="col-sm-12">
                @include("layouts.message")
            </div>
        </div>
        <div class="col-sm-12">
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <h3 class="panel-title">Create a new order</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{url()->route("orders.store")}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label text-muted text-right">Account</label>

                            <div class="col-sm-4">
                                <select name="account_id" id="" class="form-control">
                                    <option value="0">Select</option>
                                    @foreach($accounts as $account)
                                        <option value="{{$account->id}}">{{$account->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-sm-4">
                                @if ($errors->has('account_id'))
                                    <span class="help-block text-danger">
                                            <strong>{{ $errors->first('account_id') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label text-muted text-right">User</label>

                            <div class="col-sm-4">
                                <select name="user_id" id="" class="form-control">
                                    <option value="0">Select</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-sm-4">
                                @if ($errors->has('user_id'))
                                    <span class="help-block text-danger">
                                            <strong>{{ $errors->first('user_id') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label text-muted text-right">Buyer</label>

                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="buyer" value="{{ old("buyer") }}" placeholder="Jonh Doe">
                            </div>
                            <div class="col-sm-4">
                                @if ($errors->has('buyer'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('buyer') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label text-muted text-right">Address</label>

                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="address" value="{{ old("address") }}" placeholder="Address">
                            </div>
                            <div class="col-sm-4">
                                @if ($errors->has('address'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label text-muted text-right">Item</label>

                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="item" value="{{ old("item") }}" placeholder="Item name">
                            </div>
                            <div class="col-sm-4">
                                @if ($errors->has('item'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('item') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label text-muted text-right">Price</label>

                            <div class="col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" class="form-control" name="price" value="{{ old("price") }}" placeholder="price">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                @if ($errors->has('item'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('item') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label text-muted text-right">Tracking</label>

                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="tracking" value="{{ old("tracking") }}" placeholder="tracking code">
                            </div>
                            <div class="col-sm-4">
                                @if ($errors->has('tracking'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('tracking') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label text-muted text-right">Note</label>

                            <div class="col-sm-4">
                                <textarea class="form-control" name="note"placeholder="Note" rows="6">{{ old("note") }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-4 text-center">
                                <hr>
                                <button class="btn btn-success btn-block"><i class="fa fa-fw fa-plus"></i> Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
