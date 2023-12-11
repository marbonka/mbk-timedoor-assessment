<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{$strPageTitle}}</title>
        <style>
            body{
                margin: 10px 0px;
            }
        </style>
    </head>
    <body>
        @include('layouts.menu-layout')
        <main>
            @yield('content')
        </main>
    </body>
</html>
