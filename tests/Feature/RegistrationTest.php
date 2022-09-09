<?php

namespace Tests\Feature;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRegisterForm()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function testCreateUser()
    {
        $response = $this->post('/register', [
            'name' => 'Test wewew',
            'email' => 'testfsdfds@gmail.com'.rand(),
            'password' => 'pakistan123',
            'password_confirmation' => 'pakistan123',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        // dd($response);
        $this->assertAuthenticated();
        $response->assertRedirect('/home');
    }
}
