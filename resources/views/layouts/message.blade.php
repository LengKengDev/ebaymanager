@if (session('status'))
    <div class="col-sm-12 home-alert">
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>{{ __("System message") }}! </strong> {{ session('status') }}
        </div>
    </div>
@endif
