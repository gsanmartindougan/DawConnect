<div class="card mx-0">
    <div class="card-body">
        <div class="table-responsive p-1">
            <table id="cursos_table" class="table table-striped col-12 w-100 data_table">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Título</th>
                        <th>Fecha</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cursos as $curso)
                        <tr>
                            <td>{{ $curso->user->name }}</td>
                            <td><a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                    href="{{ route('cursos.show', $curso->id) }}">{{ $curso->title }}</a></td>
                            <td>{{ $curso->created_at->format('d-m-Y H:i') }}</td>
                            <td class="text-end">
                                @if ($curso->student_id == auth()->user()->id)
                                    <a href="{{ route('cursos.edit', $curso->id) }}"
                                        class="h-6 w-6 text-red-600"><x-antdesign-edit-o /></a>
                                    <a class="h-6 w-6 text-red-600 text-danger" data-bs-toggle="modal"
                                        data-bs-target="#confirmDeleteModal{{ $curso->id }}">
                                        <x-antdesign-delete-o /></a>
                                    {{-- @include('pages.asignaturas.modal.borrar') --}}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
