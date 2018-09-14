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
            ->assertSee('Crear usuario');
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
    /** @test */
    function the_email_is_required()
    {
        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => 'CURCO',
                'email' => '',
                'password' => 'Laravel'
            ])
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['email']);
        $this->assertEquals(0, User::count());
    }
    /** @test */
    function the_email_must_be_valid()
    {
        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => 'CURCO',
                'email' => 'correo-no-valido',
                'password' => 'Laravel'
            ])
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['email']);
        $this->assertEquals(0, User::count());
    }
    /** @test */
    function the_email_must_be_unique()
    {
        factory(User::class)->create([
            'email' => 'cur@example.com'
        ]);
        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => 'CURCO',
                'email' => 'cur@example.com',
                'password' => 'Laravel'
            ])
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['email']);
        $this->assertEquals(1, User::count());
    }
    /** @test */
    function the_password_is_required()
    {
        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => 'CURCO',
                'email' => 'cur@example.com',
                'password' => ''
            ])
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['password']);
        $this->assertEquals(0, User::count());
    }

    /** @test */
    function it_loads_the_edit_user_page()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $this->get("/usuarios/{$user->id}/editar") // usuarios/5/editar
            ->assertStatus(200)
            ->assertViewIs('users.edit')
            ->assertSee('Editar usuario')
            ->assertViewHas('user', function ($viewUser) use ($user) {
                return $viewUser->id === $user->id;
            });
    }
    /** @test */
    function it_updates_a_user(){
        $user = factory(User::class)->create();

        $this->withoutExceptionHandling();

        $this->put("/usuarios/{$user->id}",[
                'name' => 'CURCO',
                'email' => 'cur@example.com',
                'password' => 'Laravel'
            ])->assertRedirect("/usuarios/{$user->id}");

        $this->assertCredentials([
            'name' => 'CURCO',
            'email' => 'cur@example.com',
            'password' => 'Laravel'
        ]);
    }

    /** @test */
    function the_name_is_required_when_updating_a_user(){

        //$this->withoutExceptionHandling();

        $user=factory(User::class)->create();

        $this->from("usuarios/{$user->id}/editar")
            ->put("usuarios/{$user->id}",
            [
                'name' => '',
                'email' => 'cur@example.com',
                'password' => 'Laravel'
            ])->assertRedirect("usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['name']);

        $this->assertDatabaseMissing('users', ['email'=>'cur@example.com']);
    }

        /** @test */
    function the_email_must_be_valid_when_updating_the_user()
    {

        $user=factory(User::class)->create();
        $this->from("usuarios/{$user->id}/editar")
            ->put("usuarios/{$user->id}",[
                'name' => 'CURCO',
                'email' => 'correo-no-valido',
                'password' => 'Laravel'
            ])
            ->assertRedirect("usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['email']);

        $this->assertDatabaseMissing('users', ['name'=>'CURCO']);
    }
    /** @test */
    function the_email_must_be_unique_when_updating_the_user()
    {
        //$this->withoutExceptionHandling();

        factory(User::class)->create([
            'email' => 'existing-email@example.com',
        ]);
        $user = factory(User::class)->create([
            'email' => 'cur@example.net'
        ]);
        $this->from("usuarios/{$user->id}/editar")
            ->put("usuarios/{$user->id}", [
                'name' => 'CURCO',
                'email' => 'existing-email@example.com',
                'password' => 'Laravel'
            ])
            ->assertRedirect("usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['email']);

    }
    /** @test */
    function the_users_email_can_stay_the_same_when_updating_the_user()
    {
        $user=factory(User::class)->create([
            'email' => 'cur@example.com',
        ]);

        $this->from("usuarios/{$user->id}/editar")
        ->put("usuarios/{$user->id}",[
                'name' => 'CURCO',
                'email' => 'cur@example.com',
                'password' => 'Laravel'
            ])->assertRedirect("usuarios/{$user->id}");

            $this->assertDatabaseHas('users',[
                'name' => 'CURCO',
                'email' => 'cur@example.com',
            ]);
    }
    /** @test */
    function the_password_is_optional_when_updating_the_user()
    {
        $oldPassword='CLAVE_ANTERIOR';

        $user=factory(User::class)->create([
            'password'=>bcrypt($oldPassword)
        ]);

        $this->from("usuarios/{$user->id}/editar")
        ->put("usuarios/{$user->id}",[
                'name' => 'CURCO',
                'email' => 'cur@example.com',
                'password' => ''
            ])->assertRedirect("usuarios/{$user->id}");

            $this->assertCredentials([
                'name' => 'CURCO',
                'email' => 'cur@example.com',
                'password' => $oldPassword
                ]);
    }

}
?>
