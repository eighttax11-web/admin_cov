<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModalityController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\GradeController;

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

Route::get('/careers', [CareerController::class, 'list']);
Route::get('/careers/{uuid}', [CareerController::class, 'find']);
Route::post('/careers/search', [CareerController::class, 'search']);
Route::post('/careers', [CareerController::class, 'create']);
Route::put('/careers/{uuid}', [CareerController::class, 'update']);
Route::delete('/careers/{uuid}', [CareerController::class, 'delete']);

Route::get('/periods', [PeriodController::class, 'list']);
Route::get('/periods/{uuid}', [PeriodController::class, 'find']);
Route::post('/periods/search', [PeriodController::class, 'search']);
Route::post('/periods', [PeriodController::class, 'create']);
Route::put('/periods/{uuid}', [PeriodController::class, 'update']);
Route::delete('/periods/{uuid}', [PeriodController::class, 'delete']);

Route::get('/grades', [GradeController::class, 'list']);
Route::get('/grades/{uuid}', [GradeController::class, 'find']);
Route::post('/grades/search', [GradeController::class, 'search']);
