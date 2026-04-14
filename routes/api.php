<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CrudsController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/sinup', [App\Http\Controllers\AuthController::class, 'sinupdata'])->name('sinup');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'logindata'])->name('login');


Route::get('/read', [App\Http\Controllers\CrudsController::class, 'fetched'])->name('reading');
