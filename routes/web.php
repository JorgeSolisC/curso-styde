<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return 'Home';
});

Route::get('/usuarios', 'UserController@index')
    ->name('users.index');

Route::get('/usuarios/{user}', 'UserController@show')
    ->where('user','[0-9]+')
    ->name('users.show');
// Route::get('/usuarios/{id}', 'UserController@show')
//     ->where('id','[0-9]+')
//     ->name('users.show');

Route::get('usuarios/nuevo', 'UserController@create')
    ->name('users.create');

Route::post('usuarios/', 'UserController@store');

Route::get('/usuarios/{user}/editar', 'UserController@edit')->name('users.edit');

Route::put('/usuarios/{user}', 'UserController@update');

Route::get('saludo/{name}/{nickname?}', 'WelcomeUserController@index');

Route::delete('/usuarios/{user}', 'UserController@destroy')->name('users.destroy');

/*
Route::get('/usuarios', 'UserController@index') {
    return 'Usuarios';
});

Route::get('/usuarios/detalles', function () {
    return 'Mostrando detalle del usuario: '.$_GET['id'];
});

Route::get('/usuarios/{id}', function ($id) {
    return 'Mostrando detalle del usuario: '.$id;
});

Route::get('/usuarios/{id}', function ($id) {
    return "Mostrando detalle del usuario: {$id}";
})->where('id','\d+');

Route::get('/usuarios/{id}', function ($id) {
    return "Mostrando detalle del usuario: {$id}";
})->where('id','[0-9]+');

Route::get('usuarios/nuevo', function () {
    return 'Crear nuevo usuario';
});

Route::get('saludo/{name}/{nickname}', function ($name,$nickname) {
    return "Bienvenido {$name}, tu apodo es {$nickname}";
});

Route::get('saludo/{name}/{nickname?}', function ($name,$nickname = null) {
    if($nickname){
        return "Bienvenido {$name}, tu apodo es {$nickname}";
    }else{
        return "Bienvenido {$name}";
    }
});
*/
?>
