<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\sinup;

uses(TestCase::class, RefreshDatabase::class);

test('signup API works correctly', function () {
    $response = $this->postJson('/api/sinup', [
        'name' => 'Test User',
        'email' => 'testuser@gmail.com',
        'password' => '123456',
        'address' => 'Some Address',
        'image' => \Illuminate\Http\UploadedFile::fake()->image('test.jpg')
    ]);

    $response->assertStatus(200)->assertJson([
        'status' => true,
        'response' => 'your data has been saved'
    ]);
});


test('API login test', function (){
    $user = sinup::create([
        'name' => 'Test',
        'email' => 'Test123@gmail.com',
        'password' => bcrypt('123456'),
        'address' => 'some address',
        'image' => 'test.png'
    ]);

    $response = $this->postJson('api/login', [
        'email' => 'testuser@gmail.com',
        'password' => '123456'
    ]);

    $response->assertStatus(200)->assertJson([
        'status' => true,
        'response' => 'welcome to dashboard'
    ]);
});
