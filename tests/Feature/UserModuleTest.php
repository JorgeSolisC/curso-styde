<?php

namespace Tests\Feature;
use App\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersModuleTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    function it_shows_the_users_list()
    {
        factory(User::class)->create([
            'name' => 'Joel'
        ]);
        factory(User::class)->create([
            'name' => 'Ellie',
        ]);
        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee('Listado de usuarios')
            ->assertSee('Joel')
            ->assertSee('Ellie');
    }
    /** @test */
    function it_shows_a_default_message_if_the_users_list_is_empty()
    {
        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee('No hay usuarios registrados.');
    }

    /** @test */
    function it_displays_the_users_details()
    {
        $user = factory(User::class)->create([
            'name' => 'CURCO'
        ]);
        $this->get('/usuarios/'.$user->id) // usuarios/5
            ->assertStatus(200)
            ->assertSee('CURCO');
    }

    /**@test */
    function it_displays_a_404_error_if_the_user_is_not_found(){
        $this->get('/usuarios/990')
        ->assertStatus(404)
        ->assertSee('Pagina no encontrada');
    }

    /** @test */
    function it_loads_the_new_users_page()
    {
        $this->get('/usuarios/nuevo')
            ->assertStatus(200)
            ->assertSee('Crear nuevo usuario');
    }
    /** @test */
    function it_creates_a_new_user()
    {
        $this->withoutExceptionHandling();

        $this->post('/usuarios/', [
            'name' => 'CURCO',
            'email' => 'cur@example.com',
            'password' => 'Laravel'
        ])->assertRedirect('usuarios');

        $this->assertCredentials([
            'name' => 'CURCO',
            'email' => 'cur@example.com',
            'password' => 'Laravel',
        ]);
    }

    function the_name_is_required(){
        $this->from('usuarios/nuevo')
            ->post('/usuarios/',[
                'name'=>'',
                'email'=>'cur@example.com',
                'password'=>'Laravel'
            ])
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['name'=>'El campo nombre es obligatorio']);

        $this->assertEquals(0, User::count());
        // $this->assertDatabaseMissing('users',[
        //     'email'=>'cur@example.com',
        // ]);
    }
}
