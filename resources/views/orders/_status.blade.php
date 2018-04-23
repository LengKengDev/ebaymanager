{{ucwords(str_replace("_", " ", $status))}}
@if(strlen($tracking) > 0)
    <button href="{{url()->route('api.tracking.show', ['order' => $id], false)}}" class="btn btn-success btn-status btn-xs pull-right">
        <i class="fa fa-fw fa-refresh"></i>
    </button>
@endif
