@extends('layout')

@section('title', "Editar usuario")

@section('content')
    <h1>Editar usuario</h1>

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

    <form method="POST" action="{{ url("usuarios/{$user->id}") }}">
        {{ method_field('PUT') }}
        {{ csrf_field() }}

        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" placeholder="Pedro Perez" value="{{ old('name', $user->name) }}">
        {{-- OTra forma de validar  --}}
        {{-- @if ($errors->has('name'))
            <p>* {{ $errors->first('name') }}</p>
        @endif --}}
        <br>
        <label for="email">Correo electronico:</label>
        <input type="email" name="email" id="email" placeholder="pedro@exmaple.com" value="{{old('email', $user->email)}}">
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" placeholder="Mayor de 6 caracteres">
        <br>
        <button type="submit">Actualizar usuario</button>
    </form>

    <p>
        <a href="{{ route('users.index') }}">Regresar al listado de usuarios</a>
    </p>
@endsection
