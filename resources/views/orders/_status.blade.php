{{ucwords(str_replace("_", " ", $status))}}
@if(strlen($tracking) > 0)
    <a href="#" class="btn btn-success btn-xs pull-right" onclick="event.preventDefault();if(confirm('Are you sure you want to update status order?')){
            document.getElementById('order-status-form-{{$id}}').submit();}">
        <i class="fa fa-fw fa-refresh"></i>
    </a>
    <form id="order-status-form-{{$id}}" action="{{ url()->route('api.tracking.show', ['order' => $id]) }}" method="GET" style="display: none;">
    </form>
@endif
