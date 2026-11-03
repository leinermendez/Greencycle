<?php

   use App\Http\Controllers\TreeController;
   use Illuminate\Http\Request;
   use Illuminate\Support\Facades\Route;

   Route::get('/user', function (Request $request) {
       return $request->user();
   })->middleware('auth:sanctum');

   Route::middleware('auth:sanctum')->group(function () {
       Route::apiResource('trees', TreeController::class)
           ->only(['index', 'show', 'store', 'destroy']);
   });