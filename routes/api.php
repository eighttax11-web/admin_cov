<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModalityController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/modalities', [ModalityController::class, 'list']);
Route::get('/modalities/{uuid}', [ModalityController::class, 'find']);
Route::post('/modalities/search', [ModalityController::class, 'search']);
Route::post('/modalities', [ModalityController::class, 'create']);
Route::put('/modalities/{uuid}', [ModalityController::class, 'update']);
Route::delete('/modalities/{uuid}', [ModalityController::class, 'delete']);
