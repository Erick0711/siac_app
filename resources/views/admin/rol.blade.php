@extends('adminlte::page')

@section('title', 'Dashboard')
@section('plugins.Sweetalert2', true)
@livewireStyles
@section('content_header')

    <h1>Dashboard</h1>
@stop

@section('content')
    @livewire('RolLivewire')
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop
@livewireScripts
@section('js')

    <script src='{{asset('vendor/js/helpers.js')}}'></script>

    <script>
        notificacion();
        confirmacion('delete', 'eliminar');
    </script>

@stop