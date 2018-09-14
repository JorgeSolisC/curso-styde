<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => 'required',
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'password.required' => 'El campo password es obligatorio',
        ]);
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
        return redirect()->route('users.index');
    }
    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    public function update(User $user){

        $data = request()->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => '',
        ]);

        if ($data['password'] != null) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('users.show',['user'=>$user]);
    }

    function destroy(User $user){
        $user->delete();
        return redirect()->route('users.index');
    }
}
