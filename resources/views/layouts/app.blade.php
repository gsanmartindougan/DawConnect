<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DawConnect') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="secure_asset('css/summernote-lite.css')">
    <link rel="stylesheet" href="secure_asset('css/bootstrap.css')">
    <link rel="stylesheet" href="secure_asset('css/styles.css')">
</head>

<body>
    <div id="app">
        @include('layouts.nav')
        <main class="py-2">
            @yield('content')
            @if (auth()->user())
                @include('layouts.action')
            @endif
        </main>
    </div>
    <script src="secure_asset('js/summernote-lite.js')"></script>
    <script src="secure_asset('js/bootstrap.bundle.js')"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     {{-- @include('layouts.footer') --}}
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 500,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['codeview', 'help']],
                    ['height', ['height']]
                ]
            });
        });
    </script>
    @stack('custom-scripts')
</body>

</html>
