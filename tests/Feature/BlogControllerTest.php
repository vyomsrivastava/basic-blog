<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

it('it returns the index page', function (){
    $response = $this->get(route('homepage'));
    $response->assertStatus(200);
});