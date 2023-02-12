<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('templates.head')
    <body>
        <div class="container">
            @yield('content')
        </div>
        @vite('resources/js/app.js')
    </body>
</html>