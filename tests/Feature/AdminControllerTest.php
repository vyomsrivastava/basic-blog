<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

it('it returns the login page', function (){
    $this->withExceptionHandling();
    $this->artisan('migrate');
    $response = $this->get('/login');
    $response->assertStatus(200);
});

it('it throws error if passed incorrect credentials', function (){
    $this->withExceptionHandling();
    $this->artisan('migrate');
    $response = $this->post('/login', [
        'email' => "abcs@gmail.com",
        'password' => "apple"
    ]);
    $errors = session('errors');
    $response->assertStatus(302);
    $response->assertSessionHasErrors();
    $this->assertEquals($errors->get('email')[0], 'The provided credentials do not match our records.');
});

