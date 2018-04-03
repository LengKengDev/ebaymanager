@extends('layouts.layout')
@section("title", "Create a new user")
@section('content')
    <div class="row">
        <div class="col-sm-12">
            {{ Breadcrumbs::render('users.create') }}
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
                    <h3 class="panel-title">Create a new user</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{url()->route("users.store")}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label text-muted text-right">Email</label>

                            <div class="col-sm-4">
                                <input type="email" class="form-control" value="{{ old("email") }}" name="email" required placeholder="example@example.com">
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
                            <label for="email" class="col-sm-4 control-label text-muted text-right">Name</label>

                            <div class="col-sm-4">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old("name") }}" placeholder="Jonh Doe">
                            </div>
                            <div class="col-sm-4">
                                @if ($errors->has('name'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-4 control-label text-muted text-right">Password</label>

                            <div class="col-sm-4">
                                <input type="password" required class="form-control" name="password" value="" placeholder="Min length 6 characters">
                            </div>
                            <div class="col-sm-4">
                                @if ($errors->has('password'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label text-muted text-right">Re-password</label>

                            <div class="col-sm-4">
                                <input type="password" required class="form-control" name="password_confirmation" value="" placeholder="Min length 6 characters">
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
