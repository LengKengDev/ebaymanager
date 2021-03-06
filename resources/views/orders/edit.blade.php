@extends('layouts.layout')
@section("title", "Edit order")
@section('content')
    <div class="row">
        <div class="col-sm-12">
            {{ Breadcrumbs::render('orders.edit') }}
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
                    <form class="form-horizontal" method="POST" action="{{url()->route("orders.update", ['order' => $order])}}">
                        {{ csrf_field() }}
                        @method("PATCH")
                        @if(Auth::user()->can('views_full'))
                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label text-muted text-right">Account</label>

                            <div class="col-sm-4">
                                <select name="account_id" id="" class="form-control" @if(Auth::user()->cannot('views_full')) disabled @endif>
                                    <option value="0">Select</option>
                                    @foreach($accounts as $account)
                                        <option value="{{$account->id}}" {{$account->id == $order->account_id ? "selected" : ''}}>{{$account->name}}</option>
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
                                <select name="user_id" id="" class="form-control" @if(Auth::user()->cannot('views_full')) disabled @endif>
                                    <option value="0">Select</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}" {{$user->id == $order->user_id ? "selected" : ''}}>{{$user->name}}</option>
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
                                <input type="text" class="form-control" name="buyer" value="{{ $order->buyer }}" placeholder="Jonh Doe" @if(Auth::user()->cannot('views_full')) disabled @endif>
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
                            <label for="email" class="col-sm-4 control-label text-muted text-right">Transaction ID</label>

                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="transaction_id" value="{{ $order->transaction_id }}" disabled placeholder="Jonh Doe">
                            </div>
                            <div class="col-sm-4">
                                @if ($errors->has('transaction_id'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('transaction_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label text-muted text-right">Address</label>

                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="address" value="{{ $order->address }}" placeholder="Address" @if(Auth::user()->cannot('views_full')) disabled @endif>
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
                                <input type="text" class="form-control" name="item" value="{{ $order->item }}" placeholder="Item name" @if(Auth::user()->cannot('views_full')) disabled @endif>
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
                            <label for="email" class="col-sm-4 control-label text-muted text-right">Quantity</label>

                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="quantity" value="{{ $order->quantity }}" placeholder="Item name" @if(Auth::user()->cannot('views_full')) disabled @endif>
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
                                    <input type="text" class="form-control" name="price"
                                           value="{{ $order->price }}" placeholder="price" @if(Auth::user()->cannot('views_full')) disabled @endif>
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
                                <input type="text" class="form-control" name="tracking"
                                       value="{{ $order->tracking }}" placeholder="tracking code">
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
                            <label for="email" class="col-sm-4 control-label text-muted text-right">Site order</label>

                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="site" value="{{ $order->site }}" placeholder="http://...">
                            </div>
                            <div class="col-sm-4">
                                @if ($errors->has('site'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('site') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label text-muted text-right">Email order</label>

                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="email" value="{{ $order->email }}" placeholder="Email order">
                            </div>
                            <div class="col-sm-4">
                                @if ($errors->has('email'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label text-muted text-right">Order number</label>

                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="number" value="{{ $order->number }}" placeholder="Order number">
                            </div>
                            <div class="col-sm-4">
                                @if ($errors->has('number'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label text-muted text-right">Status</label>

                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="status"
                                       value="{{ ucwords(str_replace("_", " ", $order->status)) }}" placeholder="Status" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label text-muted text-right">Last update</label>

                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="last_update"
                                       value="{{ $order->last_update }}" placeholder="Not update" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label text-muted text-right">Note</label>

                            <div class="col-sm-4">
                                <textarea type="text" class="form-control" name="note"placeholder="Note" rows="6">{{ $order->note }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-4 text-center">
                                <hr>
                                <button class="btn btn-success btn-block">
                                    <i class="fa fa-fw fa-save"></i> Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
