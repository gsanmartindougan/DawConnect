@extends('layouts.app')
@section('content')
    <div class="kanban-board"></div>
    {{-- dd($kanban) --}}
@endsection

@push('custom-scripts')
    {!! $kanban->scripts() !!}
@endpush
