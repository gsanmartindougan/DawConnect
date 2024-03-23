@extends('layouts.app')

@section('content')
    <div class="container mt-6">
        <h1>Publicaciones recientes</h1>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
           {{--  {{dd($asignaturas)}} --}}
            @foreach ($asignaturas as $asignatura)
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><a href="">{{$asignatura->name}}</a></h5>
                        <p class="card-text">Contenido de la tarjeta 2.</p>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
@endsection
