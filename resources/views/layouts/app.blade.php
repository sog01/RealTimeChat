<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::to('css/app.css') }}">
    @yield('style')
</head>

<body>
    <div id="app">
        @yield('content')
    </div>
</body>
<script src="{{ URL::to('js/app.js') }}"></script>
@yield('script')

</html>
