@extends('layouts.app')
@section('content')
    <div class="card mx-1" style="background-color: rgb(254, 253, 237, 0.4); ">
        <div class="card-body justify-content-center">
            <div class="card shadow-lg p-2 mb-5 bg-white rounded">
                <div class="p-1 text-center">
                    @if ($aviso->user->id == auth()->user()->id)
                        <a href="{{ route('perfil.index') }}" class="link-dark link-underline-opacity-0">
                            <img src="{{ asset($aviso->user->avatar()) }}" alt="{{ asset('images/avatar/default.png') }}"
                                style="width: 40px; height: 40px; border-radius: 50%;" class="py-0">
                            {{ $aviso->user->name }}
                        </a>
                    @else
                        <a href="{{ route('perfil.show', $aviso->user->id) }}" class="link-dark link-underline-opacity-0">
                            <img src="{{ asset($aviso->user->avatar()) }}" alt="{{ asset('images/avatar/default.png') }}"
                                style="width: 40px; height: 40px; border-radius: 50%;" class="py-0">
                            {{ $aviso->user->name }}
                        </a>
                    @endif
                </div>
                <div class="card-body">
                    <h2>{{ $aviso->title }}</h2>
                    <hr>
                    <p>{!! $aviso->content !!}</p>
                </div>
                <div class="d-flex p-1">
                    <div class="col-3 text-start">
                    </div>
                    <div class="col-9 text-end">
                        <span>{{ (new DateTime($aviso->created_at))->format('d-m-Y H:i') }}</span>
                        @if ($aviso->mod_id == auth()->user()->id)
                            <a href="{{ route('avisos.edit', $aviso->id) }}" class="h-6 w-6 text-red-600"
                                title="editar"><x-antdesign-edit-o /></a>
                            <a class="h-6 w-6 text-red-600 text-danger" data-bs-toggle="modal"
                                data-bs-target="#confirmDeleteModal{{ $aviso->id }}" title="borrar">
                                <x-antdesign-delete-o /></a>
                            @include('pages.avisos.modal.borrar')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

