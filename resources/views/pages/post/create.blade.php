@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <div class="text-center">
                    {{--dd(session('user'))--}}
                    <h1>Nueva Publicación</h1>
                </div>
                <form action="{{route('post.store')}}" method="post">
                    @csrf
                    <label for="asignatura" class="fs-4">Asignatura</label>
                    <select name="asignatura" id="asignatura" class="form-select form-select-lg mb-3">
                        @php
                            $asignaturas = session('asignaturas');
                        @endphp
                        @foreach ($asignaturas as $asignatura)
                            <option value="{{ $asignatura->id }}">{{ $asignatura->name }}</option>
                        @endforeach
                    </select>
                    <label for="titulo" class="fs-4">Título</label>
                    <input type="text" id="titulo" name="titulo" class="form-control mb-2">
                    <textarea id="summernote" name="content"></textarea>
                    <input type="hidden" name="user_id" value="{{session('user')->id}}">
                    <button type="submit" class="btn btn-primary mt-2">Publicar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('custom-scripts')

@endpush
