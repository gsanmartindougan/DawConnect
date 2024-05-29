@extends('layouts.app')

@section('content')
    {{-- dd($tareas) --}}
    <div class="d-flex row m-1">
        <div class="col-12 col-md-4 mt-2 mx-0">
            <div class="bg-info text-center py-1">
                <h5><x-carbon-task-view /> Pendientes</h5>
            </div>
            <div class="bg-info p-1" style="max-height: 600px; min-height:600px; overflow-y: auto;">
                <div class="card-body">
                    @forelse ($pendientes as $tarea)
                        <div class="shadow p-3 mb-1 bg-body rounded">
                            <textarea id="titulo{{ $tarea->id }}" type="text" class="form-control">{{ $tarea->title }}</textarea>
                            <div class="text-end">
                                <small class="text-info" onclick="update('{{ $tarea->id }}')">
                                    <x-carbon-save />
                                </small>
                                <small class="text-warning" onclick="estado('{{ $tarea->id }}')">
                                    <x-carbon-task-settings />
                                </small>
                                <small class="text-danger" onclick="borrar('{{ $tarea->id }}')">
                                    <x-carbon-task-remove />
                                </small>
                            </div>
                        </div>
                    @empty
                        Sin tareas pendientes
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4 mx-0 mt-2">
            <div class="bg-warning text-center py-1">
                <h5><x-carbon-task-settings /> En proceso</h5>
            </div>
            <div class="bg-warning p-1" style="max-height: 600px; min-height:600px; overflow-y: auto">
                <div class="card-body">
                    @forelse ($proceso as $tarea)
                        <div class="shadow p-3 mb-1 bg-body rounded">
                            <textarea id="titulo{{ $tarea->id }}" type="text" class="form-control">{{ $tarea->title }}</textarea>
                            <div class="text-end">
                                <small class="text-info" onclick="update('{{ $tarea->id }}')">
                                    <x-carbon-save />
                                </small>
                                <small class="text-success" onclick="estado('{{ $tarea->id }}')">
                                    <x-carbon-task />
                                </small>
                                <small class="text-danger" onclick="borrar('{{ $tarea->id }}')">
                                    <x-carbon-task-remove />
                                </small>
                            </div>
                        </div>
                    @empty
                        Sin tareas en proceso
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4 mt-2 mx-0">
            <div class="bg-success text-center py-1">
                <h5><x-carbon-task /> Completadas</h5>
            </div>
            <div class="bg-success p-1" style="max-height: 600px; min-height:600px; overflow-y: auto">
                <div class="card-body">
                    @forelse ($completado as $tarea)
                        <div class="shadow p-3 mb-1 bg-body rounded">
                            <p class="text-break">{{ $tarea->title }}</p>
                            <div class="text-end">
                                <small class="text-danger" onclick="borrar('{{ $tarea->id }}')">
                                    <x-carbon-task-remove />
                                </small>
                            </div>
                        </div>
                    @empty
                        Sin tareas completadas
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom-scripts')
    <script>
        function activar(target) {
            target.removeAttribute('readonly');
            target.focus();
        }

        function update(tareaId) {
            Swal.showLoading()
            let id = tareaId;
            let formData = {
                titulo: document.getElementById('titulo' + tareaId).value,
                id: tareaId
            }
            //console.log(tareaId)
            axios.patch('{{ route('tareas.update', ['tarea' => 'tarea']) }}', formData)
                .then(function(response) {
                    let mensaje = response.data.mensaje;
                    localStorage.setItem('mensaje', mensaje);
                    window.location.reload();
                })
                .catch(function(error) {
                    console.error(error);
                });
        }

        function estado(tareaId) {
            Swal.showLoading()
            let formData = {
                id: tareaId,
            }
            axios.post('{{ route('estado') }}', formData)
                .then(function(response) {
                    let mensaje = response.data.mensaje;
                    localStorage.setItem('mensaje', mensaje);
                    window.location.reload();
                })
                .catch(function(error) {
                    console.error(error);
                });
        }

        function borrar(tareaId){
            Swal.showLoading()
            let formData = {
                id: tareaId,
            }
            axios.post('{{ route('borrado') }}', formData)
                .then(function(response) {
                    let mensaje = response.data.mensaje;
                    localStorage.setItem('mensaje', mensaje);
                    window.location.reload();
                })
                .catch(function(error) {
                    console.error(error);
                });
        }
    </script>
@endpush
