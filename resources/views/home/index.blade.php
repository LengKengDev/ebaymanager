@extends('layouts.layout')
@section("title", "Dashboard")
@section('content')
    <div class="row">
        <div class="col-sm-12">
            {{ Breadcrumbs::render('dashboard') }}
        </div>
        <div class="row">
            <div class="col-sm-12">
                @include("layouts.message")
            </div>
        </div>
        <div class="col-sm-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Analysts</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover table-responsive table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>Total orders</td>
                                <td>$</td>
                                <td>Order need pay</td>
                                <td>$</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{\App\Order::count()}}</td>
                                <td>{{\App\Order::all()->sum("price")}}</td>
                                <td>Order need pay</td>
                                <td>$</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Dashboard</h3>
                </div>
                <div class="panel-body">
                    @include('orders._orders')
                </div>
                @if(Auth::user()->can("views_full"))
                    <div class="panel-footer">
                        <a href="{{url()->route("orders.create")}}" class="btn btn-primary"><i class="fa fa-user-plus fa-fw"></i> Create a new order</a>
                        <a href="{{url()->route("import.create")}}" class="btn btn-success"><i class="fa fa-fw fa-upload"></i> Import Data</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script>
        $(document).ready(function () {
            function format ( d ) {
                return '<div style="font-size: 17.5px;"><i class="fa fa-map-marker fa-fw"></i> : '+d.address+'<br>'+
                    '<i class="fa fa-fw fa-shopping-bag"></i> : '+d.item+'<br>'+
                    '<i class="fa fa-fw fa-newspaper-o"></i> : Note</div><blockquote>' + (d.note == null ? '' : d.note.toString().replace(/\n/g, "<br />")) + "</blockquote>";
            }

            $.fn.dataTable.render.ellipsis = function ( cutoff ) {
                return function ( data, type, row ) {
                    if ( type === 'display' ) {
                        var str = data.toString(); // cast numbers

                        return str.length < cutoff ?
                            str :
                            str.substr(0, cutoff-1) +'&#8230;';
                    }

                    // Search, order and type can use the original data
                    return data;
                };
            };

            var dt = $('table#order').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{{ url()->route("api.orders.index") }}',
                columns: [
                    {
                        "class":          "details-control",
                        "orderable":      false,
                        "data":           null,
                        "defaultContent": "",
                        searchable: false
                    },
                    {data: 'id'},
                    {data: 'buyer'},
                    {data: 'account.name', "defaultContent": "<span class='text-danger'>Not set</span>"},
                    {data: 'user.name', "defaultContent": "<span class='text-danger'>Not set</span>"},
                    {data: 'address'},
                    {data: 'item'},
                    {data: 'price'},
                    {data: 'last_update', "defaultContent": "<span class='text-danger'>Not set</span>"},
                    {data: 'status'},
                    {data: 'note', "visible": false},
                    {data: 'action', orderable: false, searchable: false},
                ],
                order: [[1, 'desc']],
            });

            var detailRows = [];

            $('#order tbody').on( 'click', 'tr td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = dt.row( tr );
                var idx = $.inArray( tr.attr('id'), detailRows );

                if ( row.child.isShown() ) {
                    tr.removeClass( 'details' );
                    row.child.hide();

                    // Remove from the 'open' array
                    detailRows.splice( idx, 1 );
                }
                else {
                    tr.addClass( 'details' );
                    row.child( format( row.data() ) ).show();

                    // Add to the 'open' array
                    if ( idx === -1 ) {
                        detailRows.push( tr.attr('id') );
                    }
                }
            } );

            // On each draw, loop over the `detailRows` array and show any child rows
            dt.on( 'draw', function () {
                $.each( detailRows, function ( i, id ) {
                    $('#'+id+' td.details-control').trigger( 'click' );
                } );
            } );

        });
    </script>
@endsection
