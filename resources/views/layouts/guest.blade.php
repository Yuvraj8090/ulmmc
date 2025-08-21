<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | {{ $header ?? 'Dashboard' }}</title>
<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">


    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
     @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
</head>
    <body>
        <x-navbar-user/>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
<x-footer-user/>
<script src="{{ asset('js/bootstrap.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="{{ asset('js/script.js') }}"></script>
        @livewireScripts
    </body>
</html>
