<!doctype html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="description" content="{{ $metaDescription }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $pageTitle }}</title>

        {!! HTML::style('css/app.css') !!}
        {!! MaterializeCSS::include_css() !!}
        {!! HTML::style('css/materialize-xl.css') !!}
        {!! HTML::style('css/style.css') !!}


        @if (session()->has('user.accessibility_opts'))

        {{-- Small device screen --}}
        @if (in_array(2, session('user.accessibility_opts')))
        <style>
            .container {
                max-width: none !important;
                width: 90% !important;
            }
        </style>
        @endif

        {{-- Large screen --}}
        @if (in_array(3, session('user.accessibility_opts')))
        <style>
            .container {
                max-width: none !important;
                width: 60% !important;
            }
        </style>
        @endif

        {{-- Small screen --}}
        @if (in_array(4, session('user.accessibility_opts')))
        <style>
            .container {
                max-width: none !important;
                width: 80% !important;
            }
        </style>
        @endif

        {{-- High Contrast --}}
        @if (in_array(6, session('user.accessibility_opts')))
        <style>
            body * {
                color: #000000 !important;
                background-color: #ffffff !important;
            }
        </style>
        @endif

        {{-- Shades of grey --}}
        @if (in_array(7, session('user.accessibility_opts')))
        <style>
            body, .content {
                background-color: #dddddd !important;
            }
            body *, body .content * {
                color: #000000 !important;
                background-color: #f2f2f2 !important;
            }
        </style>
        @endif

        {{-- Neutrals --}}
        @if (in_array(8, session('user.accessibility_opts')))
        <style>
            body, .content {
                background-color: #E7E5D2 !important;
            }
            body *, body .content * {
                color: #000000 !important;
                background-color: #f2f2f2 !important;
            }
        </style>
        @endif

        {{-- Small font --}}
        @if (in_array(10, session('user.accessibility_opts')))
        <style>
            html {
                font-size: 12px !important;
            }
        </style>
        @endif

        {{-- Large font --}}
        @if (in_array(11, session('user.accessibility_opts')))
        <style>
            html {
                font-size: 16px !important;
            }
        </style>
        @endif

        {{-- Very large font --}}
        @if (in_array(12, session('user.accessibility_opts')))
        <style>
            html {
                font-size: 18px !important;
            }
        </style>
        @endif

        {{-- Blind user --}}
        @if (in_array(14, session('user.accessibility_opts')))
        <style>
            html {
                font-size: 18px !important;
            }
            body {
                background-color: #FCFF00 !important;
            }
            body * {
                color: #000000 !important;
                background-color: transparent !important;
            }
        </style>
        @endif

        {{-- Glaucoma --}}
        @if (in_array(15, session('user.accessibility_opts')))
        <style>
            .container {
                max-width: 340px !important;
                width: auto !important;
            }
        </style>
        @endif

        @endif
    </head>

    <body>
        @section('header')
            @include('partials.header')
        @show

        @yield('content')

        {!! HTML::script('js/app.js') !!}
        {!! MaterializeCSS::include_js() !!}
        <script>
            var mobileMenu = document.getElementById('nav-menu');
            var mobileMenuBtn = document.getElementById('mobile-menu-btn');

            mobileMenuBtn.addEventListener('click', function(e){
                mobileMenu.classList.toggle("nav-menu-open");
                mobileMenuBtn.classList.toggle("menu-opened");
            });
        </script>

        @yield('jslibs')
    </body>
</html>