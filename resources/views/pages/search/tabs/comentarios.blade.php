<div class="col-12 card">
    <div class="col-12 card-body">
        <div class="table-responsive">
            <table id="comentarios_table" class="table table-striped col-12 w-100 data_table">
                <thead>
                    <tr>
                        <th class="p-0">Comentario</th>
                        <th class="p-0">Fecha</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results['comments'] as $comment)
                        <tr>
                            <td class="p-0"><a
                                    class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                    href="{{ route('post.show', $comment->post->id) }}">{!! strip_tags($comment->content) !!}</a></td>
                            <td class="p-0">{{ $comment->created_at->format('d-m-Y H:i') }}</td>
                            <td class="text-end p-0">
                                @if ($comment->user_id == auth()->user()->id)
                                    <a data-bs-toggle="modal" data-bs-target="#editComentario{{ $comment->id }}"
                                        class="h-6 w-6 text-red-600" title="editar"><x-antdesign-edit-o /></a>
                                    <a data-bs-toggle="modal" data-bs-target="#delCom{{ $comment->id }}"
                                        class="h-6 w-6 text-red-600 text-danger" title="borrar">
                                        <x-antdesign-delete-o /></a>
                                    @include('pages.post.comentarios.edit')
                                    @include('pages.post.comentarios.borrar')
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
