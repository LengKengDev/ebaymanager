@if(Auth::user()->can("views_full"))
    <div class="row">
        <div class="col-sm-12 text-right">
            <a href="{{url()->route("orders.create")}}" class="btn btn-primary"><i class="fa fa-user-plus fa-fw"></i> Create a new order</a>
            <a href="{{url()->route("import.create")}}" class="btn btn-success"><i class="fa fa-fw fa-upload"></i> Import Data</a>
            <hr>
        </div>
   </div>
@endif
<div class="table-responsive">
    <table class="table table-hover table-striped display responsive no-wrap"  id="order" width="100%">
        <thead>
        <tr>
            <th><input type="checkbox" class="select-all"></th>
            <th>ID</th>
            <th>Buyer</th>
            <th>Account</th>
            <th>User</th>
            <th>Address</th>
            <th>Item</th>
            <th>$</th>
            <th>Last Update</th>
            <th>Tracking</th>
            <th>Status</th>
            <th>Note</th>
            <th>Action</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Buyer</th>
            <th>Account</th>
            <th>User</th>
            <th>Address</th>
            <th>Item</th>
            <th>$</th>
            <th>Last Update</th>
            <th>Tracking</th>
            <th>Status</th>
            <th>Note</th>
            <th>Action</th>
        </tr>
        </tfoot>
    </table>
</div>
