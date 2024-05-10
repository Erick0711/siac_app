@extends('adminlte::page')

@section('plugins.Sweetalert2', true)
@section('title', 'Cargo')
@livewireStyles

@section('content_header')
    <h1 class="fw-bold font-italic">Gestion</h1>
@stop

@section('content')
    @livewire('PeriodoLivewire')
@stop

@livewireScripts

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src='{{asset('vendor/js/helpers.js')}}'></script>
    <script>
        notificacion();
        confirmacion('delete', 'destroy');
    </script>
@stop