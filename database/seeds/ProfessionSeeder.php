<?php

use App\Profession;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //metodo inset sql
        //DB::insert('INSERT INTO professions (title) VALUES ("Desarrollardor back-end")');

        //metodo insert con parametros dinamico protege contra la inyeccion de sql
        //DB::insert('INSERT INTO professions (title) VALUES (?)', ['Desarrollador back-end']);
        //DB::insert('INSERT INTO professions (title) VALUES (:title)', ['title'=>'Desarrollador back-end']);


        //Metodo constructor de consultas por sql laravel
/*         DB::table('professions')->insert([
            'title' => 'Desarrollador back-end',
        ]);

        DB::table('professions')->insert([
            'title' => 'Desarrollador front-end',
        ]);

        DB::table('professions')->insert([
            'title' => 'Diseñador web',
        ]); */

        //Ver insertar datos de Eloquent

        Profession::create([
            'title' => 'Desarrollador back-end',
        ]);

        Profession::create([
            'title'=> 'Desarrollador front-end'
        ]);

        Profession::create([
            'title'=> 'Diseñador web'
        ]);

        factory(Profession::class)->times(17)->create();
    }
}
