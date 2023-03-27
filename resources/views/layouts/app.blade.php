<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">

        <meta name="application-name" content="{{ config('app.name') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('scripts')
    </head>

    <body class="antialiased">
        {{-- {{ $slot }} --}}
        <div id="app"></div>
        <script>
            // window.Laravel = {csrfToken : '{{ csrf_token() }}'}
        </script>
    </body>
</html>
