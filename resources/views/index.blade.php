<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - @yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>
<body>
  <div id="app">
    <app></app>
  </div>
  <script type="text/javascript">
    window.data = {
      app: {
        name: "{{ config('app.name') }}"
      },
      year: "{{ date('Y') }}"
    };
  </script>
  <script async type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</body>
</html>
