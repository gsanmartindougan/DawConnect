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
    <link rel="stylesheet" href="{{ asset('css/summernote-lite.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jkanban.min.css') }}">
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        @include('layouts.nav')
        <main class="py-2">
            @yield('content')
            @if (auth()->user())
                {{-- @include('layouts.action') --}}
                @include('pages.tareas.create')
            @endif
        </main>
        @include('layouts.footer')
    </div>
    <script src="{{ asset('js/summernote-lite.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/jkanban.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (auth()->user())
        <script src="{{ asset('js/app.js') }}"></script>
        <script id="cid0020000378051268285" data-cfasync="false" async src="//st.chatango.com/js/gz/emb.js"
            style="width: 320px;height: 485px;">
            {
                "handle": "dawconnect",
                "arch": "js",
                "styles": {
                    "a": "58A399",
                    "b": 100,
                    "c": "FFFFFF",
                    "d": "FFFFFF",
                    "k": "58A399",
                    "l": "58A399",
                    "m": "58A399",
                    "n": "FFFFFF",
                    "p": "10",
                    "q": "58A399",
                    "r": 100,
                    "pos": "bl",
                    "cv": 1,
                    "cvbg": "58A399",
                    "cvw": 71,
                    "cvh": 26
                }
            }
        </script>
        <script>
            function actualizarNotificaciones() {
                axios.get('{{ route('notifications') }}')
                    .then(function(response) {
                        document.getElementById('drop_notificaciones').innerHTML = response.data.unreadNotifications;
                        //console.log(response.data.unreadNotifications)
                        //console.log(document.querySelector('.icono_notificacion'))
                        const iconoNotificacionesComen = document.querySelectorAll('.icono_comentario');
                        const iconoNotificacionesAviso = document.querySelectorAll('.icono_aviso');
                        if (iconoNotificacionesComen) {
                            iconoNotificacionesComen.forEach(icono => {
                                icono.innerHTML = '{{ svg('carbon-add-comment') }}';
                            });
                        }
                        if (iconoNotificacionesAviso) {
                            iconoNotificacionesAviso.forEach(icono => {
                                icono.innerHTML = '{{ svg('carbon-rule') }}';
                            });
                        }
                    })
                    .catch(function(error) {
                        console.error('Error al obtener notificaciones:', error);
                    });
            }
            actualizarNotificaciones();
            setInterval(actualizarNotificaciones, 60 * 1000);
        </script>
    @endif

    @stack('custom-scripts')

</body>

</html>
