<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){

       /*  if (request()->has('empty')) {
            # code...
            $users=[];
        } else {
            # code...
            $users = ['Joel','Ellie','Tess','Tommy','Billy','<script>alert("Clicker")</script>'];
        }
 */
        //Constructor de consultas
        //$users = DB::table('users')->get();

        //Eloquent
        $users = User::all();

            $title = 'Listado de usuarios';

        //return view('users')
        //  ->with('users',$users)
            //->with('title',$title);

        //De esta manera vemos que es un array asociativo
        //dd(compact('title','users'));

        //return view('users.index')->with('users', User::all())->with('title','Listado de usuarios');
        return view('users.index',compact('title','users'));
    }

    //public function show($id)
    public function show(User $user)
    {
        // findOrFail intentará encontrar el registro correspondiente a
        // la llave primaria pasada como argumento, y si este no es
        // encontrado devolverá una excepción de tipo ModelNotFoundException
        // $user = User::findOrFail($id);


        return view('users.show', compact('user'));
    }

    public function create(){
        return view('users.create');
    }

    public function store()
    {
        $data = request()->validate([
            'name'=>'required'
        ],[
            'name.required' => 'El campo nombre es obligatorio'
        ]);
        //$data = request()->all();
        //dd($data);
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        //return redirect('usuarios'); // Redirigimos a la URL "/usuarios"

        return redirect()->route('users.index'); // Redirigimos a la ruta con el nombre "users.index
    }
}
