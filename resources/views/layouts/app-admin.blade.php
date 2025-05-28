<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <title>{{ config('app.name', 'Studify') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    @include('layouts.partials.navbar-admin')

    @include('layouts.partials.sidebar-admin')

    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    @include('layouts.partials.footer-admin')
</body>
</html>