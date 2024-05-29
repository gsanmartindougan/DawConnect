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
    <script>
        let mensaje = localStorage.getItem('mensaje');

        if (mensaje) {
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: mensaje,
            });
            localStorage.removeItem('mensaje_error');
            localStorage.removeItem('mensaje');
        }
        let mensaje_error = localStorage.getItem('mensaje_error');

        if (mensaje_error) {
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: mensaje_error,
            });
            localStorage.removeItem('mensaje');
            localStorage.removeItem('mensaje_error');
        }
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
            $('.data_table').DataTable({
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "«",
                        "sLast": "»",
                        "sNext": "›",
                        "sPrevious": "‹"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });
        });
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
    @stack('custom-scripts')
</body>

</html>
