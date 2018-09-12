@extends('layout')

@section('title', "Pagina no encontrada")

@section('content')
    <h1>Pagina no encontrada</h1>
    <a href="{{ route('users')}}">Ver detalles</a>

@endsection

