@if(Auth::user()->can("views_full"))
    <div class="row">
        <div class="col-sm-8">
            <div class="row">
                <div class="col-sm-1 text-right"><h5>Account</h5></div>
                <div class="col-sm-2">
                    <select name="" id="account" class="form-control">
                        <option value="">All</option>
                        @foreach(\App\Account::all() as $account)
                            <option value="{{$account->name}}">{{$account->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-1 text-right"><h5>User</h5></div>
                <div class="col-sm-2">
                    <select name="" id="user" class="form-control">
                        <option value="">All</option>
                        @foreach(\App\User::all() as $account)
                            <option value="{{$account->name}}">{{$account->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-2 text-right"><h5>Show new order</h5></div>
                <div class="col-sm-1">
                    <input type="checkbox" class="form-control" id="only-new">
                </div>
            </div>
        </div>
        <div class="col-sm-4 text-right">
            <a href="{{url()->route("orders.create")}}" class="btn btn-primary"><i class="fa fa-user-plus fa-fw"></i> Create a new order</a>
            <a href="{{url()->route("import.create")}}" class="btn btn-success"><i class="fa fa-fw fa-upload"></i> Import Data</a>
            <hr>
        </div>
   </div>
@endif
<div class="table-responsive">
    <table class="table table-hover table-striped display table-bordered responsive no-wrap"  id="order" width="100%">
        <thead>
        <tr>
            <th><input type="checkbox" class="select-all"></th>
            <th>ID</th>
            @if(Auth::user()->can('views_full'))
                <th>Buyer</th>
                <th>Account</th>
                <th>User</th>
            @endif
            <th>Address</th>
            <th>Item</th>
            <th>Total price $</th>
            <th>Last Update</th>
            <th>Tracking</th>
            <th>Status</th>
            <th>Note</th>
            <th>Action</th>
            <th>email</th>
            <th>num</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th></th>
            <th>ID</th>
            @if(Auth::user()->can('views_full'))
                <th>Buyer</th>
                <th>Account</th>
                <th>User</th>
            @endif
            <th>Address</th>
            <th>Item</th>
            <th>$</th>
            <th>Last Update</th>
            <th>Tracking</th>
            <th>Status</th>
            <th>Note</th>
            <th>Action</th>
            <th>email</th>
            <th>num</th>
        </tr>
        </tfoot>
    </table>
</div>
