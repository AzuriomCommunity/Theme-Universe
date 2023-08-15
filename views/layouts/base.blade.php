<!DOCTYPE html>
@include('elements.base')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description', setting('description', ''))">
    <meta name="theme-color" content="{{ theme_config('color', '#7c3485') }}">
    <meta name="author" content="Azuriom">

    <meta property="og:title" content="@yield('title')">
    <meta property="og:type" content="@yield('type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ favicon() }}">
    <meta property="og:description" content="@yield('description', setting('description', ''))">
    <meta property="og:site_name" content="{{ site_name() }}">
    @stack('meta')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ site_name() }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ favicon() }}">

    <!-- Scripts -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('vendor/axios/axios.min.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}" defer></script>

    <!-- Page level scripts -->
    @stack('scripts')

    <!-- Fonts -->
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/base.css') }}" rel="stylesheet">
    <link href="{{ theme_asset('css/style.css') }}" rel="stylesheet">
    @stack('styles')
    @include('elements.theme-color', ['color' => $color = theme_config('color', '#7c3485')])
    <style>
        :root,
        [data-bs-theme=light] {
            --bs-secondary-bg: {{ color_mix('#e9ecef', $color, 0.95) }};
            --bs-secondary-bg-rgb: {{ color_rgb(color_mix('#e9ecef', $color, 0.95)) }};
        }

        [data-bs-theme=dark] {
            --bs-body-bg: {{ color_mix('#212529', $color, 0.88) }};
            --bs-body-bg-rgb: {{ color_rgb(color_mix('#212529', $color, 0.88)) }};
            --bs-secondary-bg: {{ color_mix('#131517', $color, 0.91) }};
            --bs-secondary-bg-rgb: {{ color_rgb(color_mix('#131517', $color, 0.91)) }};
        }
    </style>
</head>

<body @if(dark_theme(true)) data-bs-theme="dark" @endif>
<div id="app">
    <header class="text-body bg-body" data-bs-theme="dark">
        @include('elements.navbar')
    </header>

    @yield('app')
</div>

@include('elements.footer')

@stack('footer-scripts')

</body>
</html>
