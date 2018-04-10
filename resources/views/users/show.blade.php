@extends('layouts.layout')
@section("title", "User information")
@section('content')
    <div class="row">
        <div class="col-sm-12">
            {{ Breadcrumbs::render('users.show', $user) }}
        </div>
        <div class="row">
            <div class="col-sm-12">
                @include("layouts.message")
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <h3 class="panel-title">User information</h3>
                </div>
                <div class="panel-body">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label text-muted text-right">ID</label>

                            <div class="col-sm-8">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->id }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label text-muted text-right">Name</label>

                            <div class="col-sm-8">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label text-muted text-right">Email</label>

                            <div class="col-sm-8">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->email }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label text-muted text-right">Created at</label>

                            <div class="col-sm-8">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->created_at->diffForHumans() }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-4 text-center">
                                <hr>
                                <a href="{{url()->route("users.edit", ["user" => $user])}}" class="btn btn-primary btn-block"><i class="fa fa-cog fa-fw"></i> Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Transactions</h3>
                </div>
                <div class="panel-body">
                    <h3 class="text-center">Pay for user: {{$user->name}}, {{$user->email}}</h3>
                    <hr>
                    <form action="{{url()->route('transactions.store')}}" method="POST" class="form-horizontal">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label text-muted text-right">Need pay</label>

                            <div class="col-sm-4">
                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                <input id="name" type="text" class="form-control" name="value" value="{{ old("value") }}" placeholder="$ need pay">
                            </div>
                            <div class="col-sm-4">
                                @if ($errors->has('value'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('value') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-4 text-center">
                                <hr>
                                <button class="btn btn-success btn-block"><i class="fa fa-fw fa-money"></i> Pay</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">History</h3>
                </div>
                <div class="panel-body">

                    <h3 class="text-center">Transactions histories (Total: {{$user->transactions->sum('value')}}<i class="fa fa-dollar fa-fw"></i>)</h3>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <ul class="list-group">
                                @foreach($histories as $trans)
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <i class="fa fa-fw fa-money"></i> + <b class="text-primary">{{$trans->value}}</b> <i class="fa fa-dollar"></i>
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="text-muted"><i class="fa fa-clock-o fa-fw"></i>{{$trans->created_at->diffForHumans()}}</span>
                                            </div>
                                            <div class="col-sm-4 text-right">
                                                <form action="{{url()->route("transactions.destroy", ["transaction" => $trans])}}" method="POST">
                                                    {{csrf_field()}}
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-xs" title="Delete"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            {{$histories->links()}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
