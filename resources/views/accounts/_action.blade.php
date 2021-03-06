<div class="text-center">
    <a href="{{url()->route('accounts.edit', ['account' => $id])}}" class="btn btn-primary btn-xs">
        <i class="fa fa-fw fa-edit"></i> Edit
    </a>
    <a href="#" class="btn btn-danger btn-xs" onclick="event.preventDefault();if(confirm('Are you sure you want to delete `{{$name}}` account?')){
            document.getElementById('account-delete-form-{{$id}}').submit();}">
        <i class="fa fa-fw fa-trash"></i> Delete
    </a>
    <form id="account-delete-form-{{$id}}" action="{{ url()->route('accounts.destroy', ['account' => $id]) }}" method="POST" style="display: none;">
        {{ csrf_field() }}
        @method("DELETE")
    </form>
</div>
