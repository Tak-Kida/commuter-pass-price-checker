<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalcController;

Route::get('/', function () {
    return view('top');
});

Route::post('/calc', [CalcController::class, 'calc']);
