<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){

        if (request()->has('empty')) {
            # code...
            $users=[];
        } else {
            # code...
            $users = ['Joel',
            'Ellie',
            'Tess',
            'Tommy',
            'Billy',
            '<script>alert("Clicker")</script>'];
        }

            $title = 'Listado de usuarios';

        //return view('users')
          //  ->with('users',$users)
            //->with('title',$title);

        //De esta manera vemos que es un array asociativo
        //dd(compact('title','users'));
        return view('users.index',compact('title','users'));
    }

    public function show($id){
        return view('users.show',compact('id'));
    }

    public function create(){
        return 'Crear nuevo usuario';
    }


}
