@extends('layout')

@section('title', "Usuario {$user->id}")

@section('content')
    <h1>Usuario #{{ $user->id }}</h1>

    <p>Nombre del usuario: {{ $user->name }}</p>
    <p>Correo electrónico: {{ $user->email }}</p>

    {{-- <a href="{{ url('/usuarios')}}">Regresar</a> --}}
    {{-- <a href="{{ url()->previous() }}">Regresar</a> --}}
    {{-- <a href="{{ action('UserController@index') }}">Regresar</a> --}}
    <a href="{{ route('users')}}">Ver detalles</a>

@endsection

