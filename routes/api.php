<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RecordOfWork\MultiStepFormController;
use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;


Route::post('/login', [LoginController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout']);
});


Route::post('/save-form', [MultiStepFormController::class, 'saveForm']);
Route::get('/workers', [WorkerController::class, 'index']);
