<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalcController;

Route::post('/calc', [CalcController::class, 'calc']);
