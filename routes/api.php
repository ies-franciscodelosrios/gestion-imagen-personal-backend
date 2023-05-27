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
Route::middleware('auth:sanctum')->get('/appointment/id',[App\Http\Controllers\AppointmentController::class, 'getAppointmentById']);
Route::middleware('auth:sanctum')->get('/appointment/dni/client',[App\Http\Controllers\AppointmentController::class, 'getAppointmentBydniClient']);
Route::middleware('auth:sanctum')->get('/appointment/dni/student',[App\Http\Controllers\AppointmentController::class, 'getClientBydniStudent']);
Route::middleware('auth:sanctum')->get('/appointments/paged', [App\Http\Controllers\AppointmentController::class, 'getAppointmentsByDniStudent']);


/*  METODOS POST DE Appointment */
Route::middleware('auth:sanctum')->post('/appointment',[App\Http\Controllers\AppointmentController::class, 'addAppointment']);

/*  METODOS PUT DE Appointment */
Route::middleware('auth:sanctum')->put('/appointment',[App\Http\Controllers\AppointmentController::class, 'editAppointment']);

/*  METODOS DELETE DE Appointment */
Route::middleware('auth:sanctum')->delete('/appointment/delete-all',[App\Http\Controllers\AppointmentController::class, 'deleteAll']);
Route::middleware('auth:sanctum')->delete('/appointment/id',[App\Http\Controllers\AppointmentController::class, 'DeleteAppointmenById']);

/* ----------------------------------------------------------------------------------------------------------------------------------------- */

/* Client */
/* ----------------------------------------------------------------------------------------------------------------------------------------- */

/*  METODOS GET DE Client */
Route::middleware('auth:sanctum')->get('/clients/paged',[App\Http\Controllers\ClientController::class, 'getClientPaged']); 
Route::middleware('auth:sanctum')->get('/clients',[App\Http\Controllers\ClientController::class, 'getClientAll']);
Route::middleware('auth:sanctum')->get('/client/data',[App\Http\Controllers\ClientController::class, 'searchClient']);
Route::middleware('auth:sanctum')->get('/client/id',[App\Http\Controllers\ClientController::class, 'searchClientByid']);
Route::middleware('auth:sanctum')->get('/client/stats',[App\Http\Controllers\ClientController::class, 'getStats']);

/*  METODOS POST DE Client */
Route::middleware('auth:sanctum')->post('/client',[App\Http\Controllers\ClientController::class, 'addClient']);

/*  METODOS PUT DE Client */
Route::middleware('auth:sanctum')->put('/client',[App\Http\Controllers\ClientController::class, 'editById']);

/*  METODOS DELETE DE Client */
Route::middleware('auth:sanctum')->delete('/client/id',[App\Http\Controllers\ClientController::class, 'deleteById']);
Route::middleware('auth:sanctum')->delete('/client/purge',[App\Http\Controllers\ClientController::class, 'deleteAll']);

/* ----------------------------------------------------------------------------------------------------------------------------------------- */

/* Users */
/* ----------------------------------------------------------------------------------------------------------------------------------------- */

/*  METODOS GET DE User */
Route::middleware('auth:sanctum')->get('/users',[App\Http\Controllers\UsersController::class, 'getAll']);
Route::middleware('auth:sanctum')->get('/users/rol/2', [App\Http\Controllers\UsersController::class, 'getAllStudents']);
Route::middleware('auth:sanctum')->get('/users/rol/1', [App\Http\Controllers\UsersController::class, 'getAllProfessor']);
Route::middleware('auth:sanctum')->get('/user/id', [App\Http\Controllers\UsersController::class, 'getUserByID']);
Route::middleware('auth:sanctum')->get('/userbyemail', [App\Http\Controllers\UsersController::class, 'getUserByCorreo']);
Route::middleware('auth:sanctum')->get('/userbydni', [App\Http\Controllers\UsersController::class, 'getUserBydni']);
Route::middleware('auth:sanctum')->get('/user/student/name', [App\Http\Controllers\UsersController::class, 'getUserByname']);
Route::middleware('auth:sanctum')->get('/users/course', [App\Http\Controllers\UsersController::class, 'getUserByCourse']);
Route::middleware('auth:sanctum')->get('/users/cycle', [App\Http\Controllers\UsersController::class, 'getUserBycycle']);

/*  METODOS POST DE User */
Route::middleware('auth:sanctum')->post('/user/addstudent',[App\Http\Controllers\UsersController::class, 'addStudent']);
Route::middleware('auth:sanctum')->post('/user/addprofessor',[App\Http\Controllers\UsersController::class, 'addProfessor']);
Route::middleware('auth:sanctum')->post('/user/addstudents',[App\Http\Controllers\UsersController::class, 'addAllStudent']);
Route::middleware('auth:sanctum')->post('/user/addprofessors',[App\Http\Controllers\UsersController::class, 'addAllProfessor']);

/*  METODOS PUT DE User */
Route::middleware('auth:sanctum')->put('/user',[App\Http\Controllers\UsersController::class, 'editUser']);

/*  METODOS DELETE DE User */
Route::middleware('auth:sanctum')->delete('/user/id',[App\Http\Controllers\UsersController::class, 'deleteUser']);
Route::middleware('auth:sanctum')->delete('/user/delete/rol',[App\Http\Controllers\UsersController::class, 'deleteByrol']);
Route::middleware('auth:sanctum')->delete('/delete-cloudinary',[App\Http\Controllers\UsersController::class, 'deleteImage']);
Route::middleware('auth:sanctum')->get('/get-cloudinary',[App\Http\Controllers\UsersController::class, 'getAllImages']);

/* Route::middleware('auth:sanctum')->delete('/user/deleteall/rol',[App\Http\Controllers\UsersController::class, 'deleteAllByrol']);
 */
/* ----------------------------------------------------------------------------------------------------------------------------------------- */
