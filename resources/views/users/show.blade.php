@extends('layout')

@section('title', "Usuario {$user->id}")

@section('content')

<div class="card" >
        <h4 class="card-header">Usuario #{{ $user->id }}</h4>
        <ul class="list-group list-group-flush">
        <li class="list-group-item">Nombre del usuario: {{ $user->name }}</li>
        <li class="list-group-item">Correo electrónico: {{ $user->email }}</li>
        <li class="list-group-item"><a href="{{ route('users.index')}}">Regresar al listado de usuarios</a></li>
        </ul>
</div>

    {{-- <a href="{{ url('/usuarios')}}">Regresar</a> --}}
    {{-- <a href="{{ url()->previous() }}">Regresar</a> --}}
    {{-- <a href="{{ action('UserController@index') }}">Regresar</a> --}}
@endsection

