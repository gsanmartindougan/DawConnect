@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-12">
            <div class="text-center">
                {{--dd(session('user'))--}}
                <h1>Editar Publicación</h1>
            </div>
            <form action="{{route('post.update', $post->id)}}" method="POST">
                @csrf
                @method('patch')
                <label for="titulo" class="fs-4">Título</label>
                <input type="text" id="titulo" name="titulo" class="form-control mb-2" value="{{$post->title}}">
                <textarea id="summernote" name="content">{{$post->content}}</textarea>
                <input type="hidden" name="user_id" value="{{session('user')->id}}">
                <button type="submit" class="btn btn-primary mt-2">Guardar</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection
