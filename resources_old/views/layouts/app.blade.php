<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.header')
    <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
        @include('layouts.navbar')
        <div class="container-fluid">
            @yield('content')
        </div>
        @include('layouts.footer')
        @yield('scripts')
    </body>
</html>
