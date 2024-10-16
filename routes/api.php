<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Owner\WorkerController;
use App\Http\Controllers\RecordOfWork\MultiStepFormController;
use Illuminate\Support\Facades\Route;


Route::post('/login', [LoginController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout']);
});


Route::post('/save-form', [MultiStepFormController::class, 'saveForm']);
Route::post('/workers', [WorkerController::class, 'store']);
Route::get('/workers', [WorkerController::class, 'getWorker']);
Route::put('/workers/{id}', [WorkerController::class, 'updateWorker']);
Route::delete('/workers/{id}', [WorkerController::class, 'deleteWorker']);
