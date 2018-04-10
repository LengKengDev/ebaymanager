@extends('layouts.layout')
@section("title", "Users")
@section('content')
    <div class="row">
        <div class="col-sm-12">
            {{ Breadcrumbs::render('users') }}
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
                    <h3 class="panel-title">List users</h3>
                </div>
                <div class="panel-body">

                    <table class="table table-hover table-responsive table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>%</th>
                            <th>Total orders</th>
                            <th>Orders success</th>
                            <th>Need pay</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>%</th>
                            <th>Total orders</th>
                            <th>Orders success</th>
                            <th>Need pay</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="panel-footer">
                    <a href="{{url()->route("users.create")}}" class="btn btn-primary"><i class="fa fa-user-plus fa-fw"></i> Create a new user</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script>
        $(document).ready(function () {
            $('table').dataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url()->route("api.users.index") }}',
                columns: [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'email'},
                    {data: 'per'},
                    {data: 'total'},
                    {data: 'delivered'},
                    {data: 'needPay'},
                    {data: 'created_at'},
                    {data: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endsection
