<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\sinup;

uses(RefreshDatabase::class);

test('signup API works correctly', function () {

    $response = $this->postJson('/api/sinup', [
        'name' => 'Test User',
        'email' => 'testuser@gmail.com',
        'password' => '123456',
        'address' => 'Some Address',
        'image' => \Illuminate\Http\UploadedFile::fake()->image('test.jpg')
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'status' => true,
            'response' => 'your data has been saved'
        ]);
});


test('API login test', function () {

    sinup::create([
        'name' => 'Test',
        'email' => 'testuser@gmail.com',
        'password' => bcrypt('123456'),
        'address' => 'some address',
        'image' => 'test.png'
    ]);

    $response = $this->postJson('/api/login', [
        'email' => 'testuser@gmail.com',
        'password' => '123456'
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'status' => true,
            'response' => 'welcome to dashboard'
        ]);
});


test('api fetch works', function () {

    sinup::create([
        'name' => 'Test',
        'email' => 'testuser@test.com',
        'password' => bcrypt('123456'),
        'address' => 'test address',
        'image' => 'test.png',
    ]);

    $response = $this->getJson('/api/read');

    $response->assertStatus(200)
        ->assertJsonStructure([
            'status',
            'message',
            'data'
        ]);
});