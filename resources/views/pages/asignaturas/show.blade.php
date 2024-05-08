@extends('layouts.app')

@section('content')
<div id="paginacion-container">
    @include('pages.asignaturas.posts')
</div>
@endsection

@push('custom-scripts')
    <script src=" {{asset('js/paginacion.js')}} "></script>
@endpush
