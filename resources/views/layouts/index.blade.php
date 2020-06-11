<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{env('APP_NAME')}} - @yield('title')</title>
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    <style>
        #cover {
            background-size: cover;
            height: 100%;
            display: flex;
            align-items: center;
            position: relative;
        }

        #cover-caption {
            width: 100%;
            position: relative;
            z-index: 1;
        }

        /* only used for background overlay not needed for centering */
        form:before {
            content: '';
            height: 100%;
            left: 0;
            position: absolute;
            top: 0;
            width: 100%;
            /*background-color: rgba(0,0,0,0.05);*/
            z-index: -1;
            border-radius: 10px;
        }
    </style>
</head>
<body>
<div>
    @include('includes.message')
    @include('includes.errors')
    @yield('content')
</div>
@include('includes.footer')
<script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
@yield('script')
</body>
</html>
