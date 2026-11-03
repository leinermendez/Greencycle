<?php

use App\Http\Controllers\TreeCareController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/trees/{tree}/care', [TreeCareController::class, 'store'])
    ->middleware('auth:sanctum');
