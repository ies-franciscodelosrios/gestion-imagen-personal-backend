<?php

use App\Http\Controllers\AppointmentController;
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
Route::controller(AppointmentController::class) -> group(function(){

    /*___________________________________________________________________________________________________________________ */

                                                    /*  GET */
    Route::get('/appointments', 'getAll');
    Route::get('/appointment/{id}', 'getAppointmentById');
    Route::get('/appointment/dni/client/{DNI_client}', 'getAppointmentByDNIClient');
    Route::get('/appointment/dni/student/{DNI_Student}', 'getClientByDniStudent');
/*___________________________________________________________________________________________________________________ */

                                                    /*  POST */
    Route::post('/appointment/add', 'addAppointment');
    /*___________________________________________________________________________________________________________________ */

                                                    /*  PUT */
    Route::put('/appointment/edit/{id}', 'editAppointment');
    /*___________________________________________________________________________________________________________________ */

                                                    /*  DELETE */
    Route::delete('/appointment/{id}', 'DeleteAppointmenById');
    Route::delete('/delete-all', 'deleteAll');
});
