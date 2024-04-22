<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DawConnect') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/summernote-lite.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    <div id="app">
        @include('layouts.nav')
        <main class="py-4">
            <div class="container">
                @if(session('success'))
                <div class="d-flex alert alert-success mt-3" role="alert">
                    <div class="col-10">
                        {{ session('success') }}
                    </div>
                    <div class="d-flex col-2 justify-content-end">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif
                @yield('content')
            </div>
        </main>
    </div>
    @include('layouts.action')
    <script src="{{ asset('js/summernote-lite.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    {{-- @include('layouts.footer') --}}
    @stack('custom-scripts')
</body>

</html>
