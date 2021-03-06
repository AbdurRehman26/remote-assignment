<?php

use App\Http\Controllers\API\FileController;
use App\Http\Controllers\API\ResourceController;
use Illuminate\Support\Facades\Route;

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

Route::resource('resource', ResourceController::class);
Route::post('upload-file', [FileController::class, 'upload']);
