<?php

use Faker\Generator as Faker;

$factory->define(\App\Profession::class, function (Faker $faker) {
    return [
        'title'=>$faker->sentence(2, false)//crea sentencias de Tres palabras
    ];
});
