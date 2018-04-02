<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="{{ config("app.name") }}">
        <meta name="author" content="lengkeng">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <base href="{{ url('/') }}">
        <title>{{ config("app.name") }} | @yield("title", __("Manager"))</title>
        @include("layouts._metatags")
        <!-- Bootstrap -->
        <link rel="stylesheet" href="{{ mix("css/app.css") }}">
        @yield("styles")
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        @include("layouts.header")
        <div class="container content">
            @yield("content")
        </div>
        <script src="{{ mix("js/app.js") }}"></script>
        @yield("scripts")
    </body>
</html>
