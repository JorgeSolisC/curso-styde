@extends('layout')

@section('title', "Crear usuario")

@section('content')
<div class="card">
    <h4 class="card-header">Crear usuario</h4>
    <div class="card-body">
    @if ($errors->any())
        <div class="alert alert-danger">
            <h6>Por favor corrige los errores de abajo:</h6>
            <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
            </ul>
        </div>
    @endif
        <form method="POST" action="{{ url('usuarios') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Pedro Perez" value="{{old('name')}}">
                {{-- OTra forma de validar  --}}
            {{-- @if ($errors->has('name'))
                <p>* {{ $errors->first('name') }}</p>
            @endif --}}
            </div>
            <div class="form-group">
                <label for="email">Correo electronico:</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Pedro Perez" value="{{old('email')}}">
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Mayor de 6 caracteres">
            </div>


            <button type="submit" class="btn btn-primary">Crear usuario</button>
            <a href="{{ route('users.index') }}" class="btn btn-link">Regresar al listado de usuarios</a>
        </form>
    </div>
</div>
@endsection
