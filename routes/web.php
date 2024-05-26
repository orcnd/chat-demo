<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

Route::get(
    '/', function () {
        return view('home');
    }
);

Route::get('/main', [Controller::class, 'main'])
    ->name('main');

Route::any('/login', [Controller::class, 'login'])
    ->name('login');

Route::post('/loginAction', [Controller::class, 'loginAction'])
    ->name('loginAction');

Route::get('/messages', [Controller::class, 'messages'])
    ->name('messages');

Route::get('/lastUpdate', [Controller::class, 'lastUpdate'])
    ->name('lastUpdate');

Route::post('sendMessage', [Controller::class, 'sendMessage'])
    ->name('sendMessage');