<?php

use App\Http\Controllers\ClientController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(ClientController::class) -> group(function(){

    Route::get('/clients', 'getClientAll'); /* Working */
    Route::get('/client/{id}', 'searchClient');/* Working */

    Route::post('/client/add', 'addClient');/* Working */

    Route::put('/client/edit/{id}', 'editById');/* Working */

    Route::delete('/client/delete/{id}', 'deleteById');/* Working */
    Route::delete('/client/deleteall', 'deleteAll');
});
