@extends('layouts.app')

@section('content')
<div class="card mx-4" style="background-color: rgb(254, 253, 237, 0.4); ">
    <div class="card-body justify-content-md-center mx-4">
        <div class="col-md-12">
            <div class="text-center">
                {{-- dd(session('user')) --}}
                <h3 class="card-title">Editar Publicación</h3>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{route('post.update', $post->id)}}" method="post">
                        @csrf
                        @method('patch')
                        <label for="titulo" class="fs-5">Título</label>
                        <input type="text" id="titulo" name="titulo" class="form-control mb-2" value="{{$post->title}}">
                        <textarea id="summernote" name="content">{{$post->content}}</textarea>
                        <input type="hidden" name="user_id" value="{{ session('user')->id }}">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-2">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
