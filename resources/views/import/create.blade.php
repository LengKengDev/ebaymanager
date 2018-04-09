@extends('layouts.layout')
@section("title", "Import CSV file")
@section('content')
    <div class="row">
        <div class="col-sm-12">
            {{ Breadcrumbs::render('import') }}
        </div>
        <div class="row">
            <div class="col-sm-12">
                @include("layouts.message")
            </div>
        </div>
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Import CSV file</h3>
                </div>
                <div class="panel-body">
                    <form action="{{url()->route("import.store")}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label text-muted text-right">Account</label>

                            <div class="col-sm-4">
                                <select name="account_id" id="" class="form-control">
                                    <option value="0">Select account</option>
                                    @foreach(\App\Account::all() as $account)
                                        <option value="{{$account->id}}">{{$account->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4">
                                @if ($errors->has('account_id'))
                                    <span class="help-block text-danger">
                                            <strong>{{ $errors->first('account_id') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                            <label for="email" class="col-md-4 control-label text-muted text-right">File</label>

                            <div class="col-md-4">
                                <div class="input-group input-file" name="csv">
                                        <input type="text" class="form-control" placeholder='Choose a file...' />
                                        <span class="input-group-btn">
                                        <button class="btn btn-default btn-choose" type="button">Choose</button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                @if ($errors->has('csv'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('csv') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-4 text-center">
                                <hr>
                                <button type="submit" class="btn btn-success btn-lg btn-block"><i class="fa fa-fw fa-upload"></i> Import</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script>
        function bs_input_file() {
            $(".input-file").before(
                function() {
                    if ( ! $(this).prev().hasClass('input-ghost') ) {
                        var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0'>");
                        element.attr("name",$(this).attr("name"));
                        element.change(function(){
                            element.next(element).find('input').val((element.val()).split('\\').pop());
                        });
                        $(this).find("button.btn-choose").click(function(){
                            element.click();
                        });
                        $(this).find("button.btn-reset").click(function(){
                            element.val(null);
                            $(this).parents(".input-file").find('input').val('');
                        });
                        $(this).find('input').css("cursor","pointer");
                        $(this).find('input').mousedown(function() {
                            $(this).parents('.input-file').prev().click();
                            return false;
                        });
                        return element;
                    }
                }
            );
        }
        $(function() {
            bs_input_file();
        });
    </script>
@endsection
