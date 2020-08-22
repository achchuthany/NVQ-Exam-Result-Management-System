<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{env('APP_NAME')}} - @yield('title')</title>
        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    </head>
    <body class="d-flex flex-column h-100">
     @if (Auth::user()->hasRole('Admin'))
         @include('includes.menu')
     @elseif(Auth::user()->hasRole('Lecturer'))
         @include('includes.menu_lecturer')
     @elseif(Auth::user()->hasRole('Student'))
         @include('includes.menu_student')
     @endif


    <div class="container-fluid mb-5 px-5">
       @include('includes.message')
       @include('includes.errors')
       @yield('content')
    </div>
    @include('includes.footer')
        <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
        @yield('script')
    </body>
</html>
