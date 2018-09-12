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

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    public function create(){
        return 'Crear nuevo usuario';
    }


}
