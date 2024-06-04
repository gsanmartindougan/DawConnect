@extends('layouts.app')

@section('content')
{{ Breadcrumbs::render('moderacion.index') }}
    <div class="col-12 card" style="background-color: rgba(254, 253, 237, 0.4);">
        <div class="col-12 card-body">
            <div class="card p-2">
                <div class="table-responsive">
                    <table id="mis_publicaciones_table" class="table table-striped col-12 w-100 p-0 data_table">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Incidencias</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                                @if ($usuario->total)
                                    <tr>
                                        <td><a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                                href="{{ route('perfil.show', $usuario->id) }}"><img
                                                    src="{{ asset($usuario->avatar()) }}"
                                                    alt="{{ asset('images/avatar/default.png') }}"
                                                    style="width: 20px; height: 20px; border-radius: 50%;" class="py-0">
                                                {{ $usuario->name }}</a></td>
                                        <td>{{ $usuario->total }}</td>
                                        <td class="text-end">
                                            <a class="h-6 w-6 text-red-600" href="{{ route('moderacion.show', $usuario->id) }}"><x-carbon-data-view-alt /></a>
                                            @if ($usuario->ban)
                                                <a class="h-6 w-6 text-red-600 text-success" onclick="unban({{$usuario->id}})"><x-antdesign-user-add-o /></a>
                                            @else
                                                <a class="h-6 w-6 text-red-600 text-danger" onclick="ban({{$usuario->id}})"><x-antdesign-user-delete-o /></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
    <script>
        function ban(user_id){
            event.preventDefault();
            Swal.showLoading()
            let formData = ({
                id : user_id,
            });
            axios.post('{{ route('ban') }}', formData)
                .then(function(response) {
                    let mensaje = response.data.mensaje;
                    let mensaje_error = response.data.mensaje_error;
                    if (mensaje) {
                        localStorage.setItem('mensaje', mensaje);
                    }
                    if (mensaje_error) {
                        localStorage.setItem('mensaje_error', mensaje_error);
                    }
                    window.location.reload();
                })
                .catch(function(error) {
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: '¡Algo ha salido mal!',
                    });
                });
        }

        function unban(user_id){
            event.preventDefault();
            Swal.showLoading()
            let formData = ({
                id : user_id,
            });
            axios.post('{{ route('unban') }}', formData)
                .then(function(response) {
                    let mensaje = response.data.mensaje;
                    let mensaje_error = response.data.mensaje_error;
                    if (mensaje) {
                        localStorage.setItem('mensaje', mensaje);
                    }
                    if (mensaje_error) {
                        localStorage.setItem('mensaje_error', mensaje_error);
                    }
                    window.location.reload();
                })
                .catch(function(error) {
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: '¡Algo ha salido mal!',
                    });
                });
        }
    </script>
@endpush
