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
                    <h3 class="panel-title">Analyst</h3>
                </div>
                <div class="panel-body">
                    Panel body ...
                </div>
            </div>
        </div>
    </div>
@endsection
