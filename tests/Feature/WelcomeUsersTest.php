<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomeUsersTest extends TestCase
{
    /*@test*/
    function it_welcomes_users_with_nickname()
    {
        $this->get('saludo/Jorge/Tomy')
            ->assertStatus(200)
            ->assertSee('Bienvenido Jorge, tu apodo es Tomy');
    }

    /*@test*/
    function it_welcomes_users_without_nickname()
    {
        $this->get('saludo/Jorge')
            ->assertStatus(200)
            ->assertSee('Bienvenido Jorge');
    }
}
