<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    </head>
    <body class="d-flex flex-column h-100">
    @include('includes.menu')
    <div class="container">
       @yield('content')
    </div>
    <footer class="footer mt-auto py-3">
        <div class="container">
          <span class="text-muted">Place sticky footer content here.</span>
        </div>
      </footer>
        <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
    </body>
</html>
