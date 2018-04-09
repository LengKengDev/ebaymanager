@extends('layouts.layout')
@section("title", "Edit user information")
@section('content')
    <div class="row">
        <div class="col-sm-12">
            {{ Breadcrumbs::render('users.edit', $user) }}
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
                    <h3 class="panel-title">Edit user</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{url()->route("users.update", ["user" => $user])}}">
                        {{ csrf_field() }}
                        @method("PATCH")
                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label text-muted text-right">ID</label>

                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="{{ $user->id }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label text-muted text-right">Email</label>

                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="{{ $user->email }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label text-muted text-right">Name</label>

                            <div class="col-sm-4">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label text-muted text-right">%</label>

                            <div class="col-sm-4">
                                <input id="name" type="number" class="form-control" name="per" value="{{ $user->per }}" placeholder="%" required min="0" max="100">
                            </div>
                            <div class="col-sm-4">
                                @if ($errors->has('per'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('per') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label text-muted text-right">Created at</label>

                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="{{ $user->created_at->diffForHumans() }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-4 text-center">
                                <hr>
                                <button class="btn btn-success btn-block">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
