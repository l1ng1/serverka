<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;

Route::get('/', [MainController::class, 'index']);
Route::get('/gallery/{id}', [MainController::class, 'gallery']);
Route::get('/signin', [AuthController::class, 'create']);
Route::post('/signin', [AuthController::class, 'registration']);

Route::get('/about', function () {
    return view('about');
});

Route::get('/contacts', function () {
    $contacts = [
        ['name' => 'Иван Иванов', 'phone' => '+7 999 111 22 33'],
        ['name' => 'Мария Петрова', 'phone' => '+7 999 444 55 66'],
    ];
    return view('contacts', ['contacts' => $contacts]);
});