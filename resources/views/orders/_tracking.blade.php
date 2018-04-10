<button class="btn btn-xs" data-toggle="modal" data-target="#myModal-{{$id}}"><i class="fa fa-edit"></i></button>

<a target='_new' href='https://www.packagetrackr.com/track/{{$tracking}}'>{{$tracking}}</a>
<!-- Modal -->
<div id="myModal-{{$id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Edit tracking code for order {{$id}}</h4>
            </div>
            <div class="modal-body">
                <form action="{{url()->route("orders.update", ['order' => $id])}}" method="POST" >
                    @method("PATCH")
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="email" class="col-sm-4 control-label text-muted text-right">Track</label>

                        <div class="col-sm-4">
                            <input type="text" class="form-control" value="{{$tracking}}" name="tracking">
                        </div>
                        <div class="col-sm-2 col-sm-offset-2">
                            <button class="btn btn-success"><i class="fa fa-fw fa-save"></i> Save</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
