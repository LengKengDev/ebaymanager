@extends('layouts.layout')
@section("title", "Accounts")
@section('content')
    <div class="row">
        <div class="col-sm-12">
            {{ Breadcrumbs::render('accounts') }}
        </div>
        <div class="row">
            <div class="col-sm-12">
                @include("layouts.message")
            </div>
        </div>
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Create a new account</h3>
                </div>
                <div class="panel-body">
                    <form action="{{url()->route("accounts.store")}}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                            <label for="email" class="col-md-4 control-label text-muted text-right">Name</label>

                            <div class="col-md-4">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-user-plus"></i> Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <h3 class="panel-title">List accounts</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover table-responsive table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Total</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Total</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script>
        $(document).ready(function () {
            $('table').dataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{{ url()->route("api.accounts.index") }}',
                columns: [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'total'},
                    {data: 'created_at'},
                    {data: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endsection
