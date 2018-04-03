@extends('layouts.layout')
@section("title", "Account information")
@section('content')
    <div class="row">
        <div class="col-sm-12">
            {{ Breadcrumbs::render('accounts.edit', $account) }}
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
                    <h3 class="panel-title">Account information</h3>
                </div>
                <div class="panel-body">
                    <form action="{{url()->route("accounts.update", ["account" => $account])}}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}
                        @method("PATCH")
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label text-muted text-right">Name</label>

                            <div class="col-md-3">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $account->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3 col-md-offset-4">
                                <button type="submit" class="btn btn-success btn-block"><i class="fa fa-fw fa-save"></i> Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
