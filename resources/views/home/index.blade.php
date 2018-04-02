@extends('layouts.layout')
@section("title", "Dashboard")
@section('content')
    <div class="row">
        <div class="col-sm-12">
            {{ Breadcrumbs::render('dashboard') }}
        </div>
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Panel title</h3>
                </div>
                <div class="panel-body">
                    Panel body ...
                </div>
            </div>
        </div>
    </div>
@endsection
