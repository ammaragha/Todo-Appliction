<?php

use App\Http\Controllers\Api\TodoController;
use App\Http\Controllers\Api\TaskController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['prefix' => 'v1'], function () {
    Route::apiResource('todo', TodoController::class);
    Route::post('todo/finish',[TodoController::class,'finish'])->name('todo.finish');
    Route::apiResource('task', TaskController::class);
    Route::post('task/finish',[TaskController::class,'finish'])->name('task.finish');

});
