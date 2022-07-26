<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\ApiV1\Http\Controllers\ItemController;

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

// Route::middleware('auth:api')->get('/apiv1', function (Request $request) {
//     return $request->user();
// });

Route::get('/list', [ItemController::class,'list']);
Route::post('/create', [ItemController::class,'store']);
Route::put('/update/{id}', [ItemController::class,'update']);
Route::delete('/delete/{id}', [ItemController::class,'destroy']);