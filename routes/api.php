<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/* use App\Http\Controllers\UsersController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController; */

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



    /* Auth */
/* ----------------------------------------------------------------------------------------------------------------------------------------- */
Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);

Route::middleware('auth:sanctum')
    ->get('logout', [App\Http\Controllers\AuthController::class, 'logout']);

/* ----------------------------------------------------------------------------------------------------------------------------------------- */


    /* Appointment */
/* ----------------------------------------------------------------------------------------------------------------------------------------- */

/*  METODOS GET DE Appointment */
Route::middleware('auth:sanctum')->get('/appointments',[App\Http\Controllers\AppointmentController::class, 'getAll']);
Route::middleware('auth:sanctum')->get('/appointment/{id}',[App\Http\Controllers\AppointmentController::class, 'getAppointmentById']);
Route::middleware('auth:sanctum')->get('/appointment/dni/client/{DNI_client}',[App\Http\Controllers\AppointmentController::class, 'getAppointmentByDNIClient']);
Route::middleware('auth:sanctum')->get('/appointment/dni/student/{DNI_Student}',[App\Http\Controllers\AppointmentController::class, 'getClientByDniStudent']);

/*  METODOS POST DE Appointment */
Route::middleware('auth:sanctum')->post('/appointment/add',[App\Http\Controllers\AppointmentController::class, 'addAppointment']);

/*  METODOS PUT DE Appointment */
Route::middleware('auth:sanctum')->put('/appointment/edit/{id}',[App\Http\Controllers\AppointmentController::class, 'editAppointment']);

/*  METODOS DELETE DE Appointment */
Route::middleware('auth:sanctum')->put('/appointment/delete-all',[App\Http\Controllers\AppointmentController::class, 'deleteAll']);

/* ----------------------------------------------------------------------------------------------------------------------------------------- */

/* Client */
/* ----------------------------------------------------------------------------------------------------------------------------------------- */

/*  METODOS GET DE Client */
Route::middleware('auth:sanctum')->get('/clients',[App\Http\Controllers\ClientController::class, 'getClientAll']);
Route::middleware('auth:sanctum')->get('/client/{id}',[App\Http\Controllers\ClientController::class, 'searchClient']);

/*  METODOS POST DE Client */
Route::middleware('auth:sanctum')->post('/client/add',[App\Http\Controllers\ClientController::class, 'addClient']);

/*  METODOS PUT DE Client */
Route::middleware('auth:sanctum')->put('/client/edit/{id}',[App\Http\Controllers\ClientController::class, 'editById']);

/*  METODOS DELETE DE Client */
Route::middleware('auth:sanctum')->delete('/client/delete/{id}',[App\Http\Controllers\ClientController::class, 'deleteById']);
Route::middleware('auth:sanctum')->delete('/client/deleteall',[App\Http\Controllers\ClientController::class, 'deleteAll']);

/* ----------------------------------------------------------------------------------------------------------------------------------------- */

/* Users */
/* ----------------------------------------------------------------------------------------------------------------------------------------- */

/*  METODOS GET DE User */
Route::middleware('auth:sanctum')->get('/users',[App\Http\Controllers\UsersController::class, 'getAll']);
Route::middleware('auth:sanctum')->get('/users/rol/2', [App\Http\Controllers\UsersController::class, 'getAllStudents']);
Route::middleware('auth:sanctum')->get('/users/rol/1', [App\Http\Controllers\UsersController::class, 'getAllProfessor']);
Route::middleware('auth:sanctum')->get('/user/{id}', [App\Http\Controllers\UsersController::class, 'getUserByID']);
Route::middleware('auth:sanctum')->get('/userByCorreo/{correo}', [App\Http\Controllers\UsersController::class, 'getUserByCorreo']);
Route::middleware('auth:sanctum')->get('/userByDni/{DNI}', [App\Http\Controllers\UsersController::class, 'getUserByDni']);
Route::middleware('auth:sanctum')->get('/user/Student/{Name}', [App\Http\Controllers\UsersController::class, 'getUserByName']);
Route::middleware('auth:sanctum')->get('/users/course/{Course_year}', [App\Http\Controllers\UsersController::class, 'getUserByCourse']);
Route::middleware('auth:sanctum')->get('/users/cycle/{Cycle}', [App\Http\Controllers\UsersController::class, 'getUserByCycle']);

/*  METODOS POST DE User */
Route::middleware('auth:sanctum')->post('/user/addstudent',[App\Http\Controllers\UsersController::class, 'addStudent']);
Route::middleware('auth:sanctum')->post('/user/addprofessor',[App\Http\Controllers\UsersController::class, 'addProfessor']);
Route::middleware('auth:sanctum')->post('/user/addstudents',[App\Http\Controllers\UsersController::class, 'addAllStudent']);
Route::middleware('auth:sanctum')->post('/user/addprofessors',[App\Http\Controllers\UsersController::class, 'addAllProfessor']);

/*  METODOS PUT DE User */
Route::middleware('auth:sanctum')->put('/user/edit/{id}',[App\Http\Controllers\UsersController::class, 'editUser']);

/*  METODOS DELETE DE User */
Route::middleware('auth:sanctum')->delete('/user/delete/{dni}',[App\Http\Controllers\UsersController::class, 'deleteUser']);
Route::middleware('auth:sanctum')->delete('/user/delete/rol/{rol}',[App\Http\Controllers\UsersController::class, 'deleteByRol']);
Route::middleware('auth:sanctum')->delete('/user/deleteall/rol',[App\Http\Controllers\UsersController::class, 'deleteAllByRol']);
/* ----------------------------------------------------------------------------------------------------------------------------------------- */
