<div class="text-center">
    <a href="{{url()->route('orders.edit', ['order' => $id])}}" class="btn btn-primary btn-xs">
        <i class="fa fa-fw fa-edit"></i>
    </a>
    <a href="#" class="btn btn-danger btn-xs" onclick="event.preventDefault();if(confirm('Are you sure you want to delete order?')){
            document.getElementById('order-delete-form-{{$id}}').submit();}">
        <i class="fa fa-fw fa-trash"></i>
    </a>
    <form id="order-delete-form-{{$id}}" action="{{ url()->route('orders.destroy', ['order' => $id]) }}" method="POST" style="display: none;">
        {{ csrf_field() }}
        @method("DELETE")
    </form>
</div>
