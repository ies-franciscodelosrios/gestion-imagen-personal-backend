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

Route::controller(AppointmentController::class)->group(function () {

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
    Route::delete('/appointment/delete-all', 'deleteAll');

});

Route::controller(ClientController::class) -> group(function(){

    /*___________________________________________________________________________________________________________________ */

                                                    /*  GET */

    Route::get('/clients', 'getClientAll'); /* Working */
    Route::get('/client/{id}', 'searchClient');/* Working */
/*___________________________________________________________________________________________________________________ */

                                                    /*  POST */

    Route::post('/client/add', 'addClient');/* Working */
    /*___________________________________________________________________________________________________________________ */

                                                    /*  PUT */

    Route::put('/client/edit/{id}', 'editById');/* Working */
    /*___________________________________________________________________________________________________________________ */

                                                    /*  DELETE */

    Route::delete('/client/delete/{id}', 'deleteById');/* Working */
    Route::delete('/client/deleteall', 'deleteAll');/* Not Working */

});


Route::controller(UsersController::class) -> group(function(){

     /*___________________________________________________________________________________________________________________ */

                                                    /*  GET */

    Route::get('/users','getAll');
    Route::get('/users/rol/2','getAllStudents');
    Route::get('/users/rol/1','getAllProfessor');
    Route::get('/user/{DNI}','getUserByDni');
    Route::get('/user/Student/{Name}','getUserByName');
    Route::get('/users/course/{Course_year}','getUserByCourse');
    Route::get('/users/cycle/{Cycle}','getUserByCycle');

/*___________________________________________________________________________________________________________________ */

                                                    /*  POST */

    Route::post('/user/addstudent','addStudent');
    Route::post('/user/addprofessor','addProfessor');
    Route::post('/user/addstudents','addAllStudent');
    Route::post('/user/addprofessors','addAllProfessor');
    Route::post('/user/login','loginUser');

    /*___________________________________________________________________________________________________________________ */

                                                    /*  PUT */

    Route::put('/user/edit/{id}','editUser');

    /*___________________________________________________________________________________________________________________ */

                                                    /*  DELETE */

    Route::delete('/user/delete/{dni}','deleteUser');
    Route::delete('/user/delete/rol/{rol}','deleteByRol');
    Route::delete('/user/deleteall/rol','deleteAllByRol');


});
