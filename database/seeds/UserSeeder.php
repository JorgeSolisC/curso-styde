<?php

use App\User;
use App\Profession;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $professionId = Profession::where('title','Desarrollador back-end')->value('id');

        User::create([
            // ..
            'name'=>'CURCO',
            'email'=>'cur@example.com',
            'password' => bcrypt('laravel'),
            'profession_id' => $professionId,
            'is_admin'=> true,
        ]);

        //crea aleatorios
        factory(User::class)->create([
            'profession_id'=>$professionId
        ]);

        factory(User::class)->create();

        factory(User::class)->create([
            // ..

            'password' => bcrypt('laravel'),
            'profession_id' => $professionId,
            'is_admin'=> true,
        ]);

        //crea 48 registros
        factory(User::class, 48)->create();

        //método DB::select podemos construir una consulta SELECT de SQL de forma manual:
        //$professions = DB::select('SELECT id FROM professions WHERE title = ?', ['Desarrollador back-end']);

            //constructor de consultas podemos realizar una consulta SQL
        //$profession = DB::table('professions')->select('id')->take(1)->get();
        //$profession = DB::table('professions')->select('id')->first();

            //Consultas con condicionales (WHERE)
        //$profession = DB::table('professions')->select('id')->where('title', '=', 'Desarrollador back-end')->first();
            //El operador = dentro del método where es opcional.
        //$profession = DB::table('professions')->select('id')->where('title', 'Desarrollador back-end')->first();
            //El método where también acepta un array asociativo,
        //$profession = DB::table('professions')->select('id')->where(['title' => 'Desarrollador back-end'])->first();

            //Omitiendo el método select al utilizar DB::table podemos retornar todas las columnas:
        // $profession = DB::table('professions')->where('title', '=', 'Desarrollador back-end')->first();

            //Métodos dinámicos
        /*$professionId = DB::table('professions')
        ->where('title','Desarrollador back-end')
        -> value('id');
        $professionId = DB::table('professions')
        ->whereTitle('Desarrollador back-end')->first();

        //$professions->first(); // en vez de $professions[0]
        dd($professionId);

        DB::table('users')->insert([
            // ..
            'name'=>'CURCO',
            'email'=>'cur@example.com',
            'password' => bcrypt('laravel'),
            'profession_id' => $professionId,
        ]);*/

    }
}
