<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('signup API works correctly', function () {
    $response = $this->postJson('/api/sinup', [
        'name' => 'Test User',
        'email' => 'testuser@gmail.com',
        'password' => '123456',
        'address' => 'Some Address',
    ]);

    $response->assertStatus(200)
             ->assertJson([
                 'status' => true,
                 'response' => 'your data has been saved'
    ]);
});
