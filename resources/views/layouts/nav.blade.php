<nav class="navbar sticky-top navbar-expand-lg p-0">
    <div class="container-fluid mx-4">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo/svg/logo-no-background.svg') }}"
                alt="{{ asset('images/logo/png/logo-no-background.png') }}" style="max-height: 35px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @guest
                <ul class="navbar-nav me-auto">
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registro') }}</a>
                        </li>
                    @endif
                </ul>
            @else
                <ul class="navbar-nav me-auto">
                    <li class="nav-item dropdown">
                        <a id="navbarAsignaturas" class="nav-link" href="#" role="button" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" v-pre title="Asignaturas">
                            <x-antdesign-book /> Asignaturas
                        </a>
                        @php
                            $asignaturas = session('asignaturas');
                        @endphp
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            @foreach ($asignaturas as $asignatura)
                                <a class="dropdown-item"
                                    href="{{ route('asignatura.show', $asignatura->id) }}">{{ $asignatura->name }}</a>
                            @endforeach
                        </div>
                    </li>
                </ul>
                <div class="navbar-nav py-1">
                    <div class="input-group-sm flex-nowrap">
                        <form class="form-inline" action="{{ route('buscar') }}" method="post">
                            @csrf
                            @method('post')
                            <div class="input-group flex-nowrap">
                                <input type="text" class="form-control" placeholder="Buscar..." aria-label="Busqueda"
                                    aria-describedby="addon-wrapping" name="busqueda">
                                <button class="btn btn-secondary" id="addon-wrapping"
                                    type="submit"><x-antdesign-search-o /></button>
                            </div>
                        </form>
                    </div>
                </div>
                <ul class="navbar-nav ms-auto">
                    @if (auth()->user()->avatar == 'avatar/default.png')
                        <li class="nav-item">
                            <a id="navbarPerfil" class="nav-link text-danger" role="button" aria-haspopup="true"
                                aria-expanded="false" onclick="avatarSwall()">
                                <x-carbon-warning />
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()?->mod)
                        <li class="nav-item">
                            <a id="navbarPerfil" class="nav-link" role="button" aria-haspopup="true" aria-expanded="false"
                                href="{{ route('moderacion.index') }}">
                                <x-carbon-user-data />
                            </a>
                        </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a id="navbarMas" class="nav-link" href="#" role="button" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" v-pre><x-vaadin-plus />
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            @if (auth()->user()?->student)
                                <a id="postCreate" class="dropdown-item" role="button" href="{{ route('post.create') }}">
                                    <x-carbon-pen /> Publicación
                                </a>
                            @endif
                            @if (auth()->user()?->teacher)
                                <a id="cursoCreate" class="dropdown-item" role="button" aria-haspopup="true"
                                    aria-expanded="false" href="{{ route('cursos.create') }}">
                                    <x-carbon-airline-rapid-board /> Curso
                                </a>
                            @endif
                            @if (auth()->user()?->mod)
                                <a id="cursoCreate" class="dropdown-item" role="button" aria-haspopup="true"
                                    aria-expanded="false" href="{{ route('avisos.create') }}">
                                    <x-carbon-rule /> Aviso
                                </a>
                            @endif
                            <a id="tareaCreate" class="dropdown-item" role="button" aria-haspopup="true"
                                role="button"data-bs-toggle="modal" data-bs-target="#create_tarea" aria-expanded="false"
                                href="{{ route('tareas.create') }}">
                                <x-carbon-task-add /> Tarea
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarMas" class="nav-link" href="#" role="button" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" v-pre>
                            <x-carbon-notification />
                        </a>
                        @include('layouts.notificaciones')
                    </li>
                    <li class="nav-item dropdown justify-content-end">
                        <a id="navbarPerfil" class="nav-link" href="#" role="button" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" v-pre>
                            <img src="{{ asset(auth()->user()->avatar()) }}" alt=""
                                style="width: 30px; height: 30px; border-radius: 50%;">
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('perfil.index') }}">
                                <x-antdesign-user-o /> {{ __('Perfil') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('tareas.index') }}">
                                <x-carbon-task-view /> {{ __('Tareas') }}
                            </a>
                            <hr class="dropdown-divider">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                <x-carbon-logout /> {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ secure_asset(route('logout')) }}" method="POST"
                                class="d-none">
                                @csrf

                            </form>
                        </div>
                    </li>
                </ul>
            @endguest
        </div>
    </div>
</nav>



@if (auth()->user())
    <!-- Modal Alerta Perfil-->
    @push('custom-scripts')
        <script>
            function avatarSwall() {
                swal.fire({
                        title: "¡Te queda poco!",
                        text: "¡Cambia tu foto de perfil para finalizar el registro!",
                        icon: "info",
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '{{ route('perfil.index', auth()->user()->id) }}';
                        }
                    });
            }
        </script>
    @endpush
@endif
