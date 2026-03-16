<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalcController;

Route::get('/test', function () {
    return 'Request received';
});
Route::post('/calc', [CalcController::class, 'calc']);
