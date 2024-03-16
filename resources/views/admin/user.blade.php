@extends('adminlte::page')

@section('plugins.Sweetalert2', true)
@section('title', 'Dashboard')
@livewireStyles

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    @livewire('UserLivewire')
@stop
@livewireScripts

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src='{{asset('vendor/js/helpers.js')}}'></script>
    <script>
        notificacion();
        confirmacion('personas', 'delete');
    </script>
@stop