<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CSVController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\vocationalEducationController;

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


/* Auth */
/* ----------------------------------------------------------------------------------------------------------------------------------------- */
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::middleware('auth:sanctum')
    ->get('logout', [AuthController::class, 'logout']);

Route::middleware(['auth:sanctum'])->group(function(){
    /* ----------------------------------------------------------------------------------------------------------------------------------------- */

    /* Appointment */
    /* ----------------------------------------------------------------------------------------------------------------------------------------- */

    /*  METODOS GET DE Appointment */
    Route::get('/appointments', [AppointmentController::class, 'getAll']);
    Route::get('/appointment/id', [AppointmentController::class, 'getAppointmentById']);
    Route::get('/appointment/dni/client', [AppointmentController::class, 'getAppointmentBydniClient']);
    Route::get('/appointment/dni/student', [AppointmentController::class, 'getClientBydniStudent']);
    Route::get('/appointments/paged', [AppointmentController::class, 'getAppointmentsByDniStudent']);
    Route::get('/appointment/get-photos', [AppointmentController::class, 'getPhotosUrl']);

    /*  METODOS POST DE Appointment */
    Route::post('/appointment', [AppointmentController::class, 'addAppointment']);
    Route::post('/appointment/add-photo-url', [AppointmentController::class, 'storePhotoUrl']);

    /*  METODOS PUT DE Appointment */
    Route::put('/appointment', [AppointmentController::class, 'editAppointment']);

    /*  METODOS DELETE DE Appointment */
    Route::delete('/appointment/delete-all', [AppointmentController::class, 'deleteAll']);
    Route::delete('/appointment/id', [AppointmentController::class, 'DeleteAppointmenById']);
    Route::delete('/appointment/delete-photo-url', [AppointmentController::class, 'deletePhotoUrl']);

    /* ----------------------------------------------------------------------------------------------------------------------------------------- */

    /* Client */
    /* ----------------------------------------------------------------------------------------------------------------------------------------- */

    /*  METODOS GET DE Client */

    Route::get('/client/id', [ClientController::class, 'searchClientByid']);
    Route::get('/client/data', [ClientController::class, 'searchClient']);
    Route::get('/client/stats', [ClientController::class, 'getStats']);
    Route::get('/client/get-photos', [ClientController::class, 'getPhotosUrl']);
    Route::get('/clients', [ClientController::class, 'getClientAll']);
    Route::get('/clients/paged', [ClientController::class, 'getClientPaged']);

    /*  METODOS POST DE Client */
    Route::post('/client', [ClientController::class, 'addClient']);
    Route::post('/client/add-photo-url', [ClientController::class, 'storePhotoUrl']);

    /*  METODOS PUT DE Client */
    Route::put('/client', [ClientController::class, 'editById']);

    /*  METODOS DELETE DE Client */
    Route::delete('/client/id', [ClientController::class, 'deleteById']);
    Route::delete('/client/purge', [ClientController::class, 'deleteAll']);
    Route::delete('/client/delete-photo-url', [ClientController::class, 'deletePhotoUrl']);

    /* ----------------------------------------------------------------------------------------------------------------------------------------- */

    /* Users */
    /* ----------------------------------------------------------------------------------------------------------------------------------------- */

    /*  METODOS GET DE User */

    Route::get('/user', [UserController::class, 'getUserLogged']);
    Route::get('/user/id/{id}', [UserController::class, 'getUserByID']);
    Route::get('/users', [UserController::class, 'getAll']);
    Route::get('/users/rol/{rol}', [UserController::class, 'getUsersByRol']);
    Route::get('/users/course/{course_year}', [UserController::class, 'getUsersByCourse']);
    Route::get('/users/cycle/{cycle}', [UserController::class, 'getUsersByCycle']);
    Route::get('/users/search/{search}', [UserController::class, 'getUsersBySearch']);
    Route::get('/user/get-photos', [UserController::class, 'getPhotosUrl']);

    /*  METODOS POST DE User */
    Route::post('/user/add/{type}', [UserController::class, 'addUser']);
    Route::post('/user/addstudents', [UserController::class, 'addAllStudent']);
    Route::post('/user/addprofessors', [UserController::class, 'addAllProfessor']);
    Route::post('/user/add-photo-url', [UserController::class, 'storePhotoUrl']);

    /*  METODOS PUT DE User */
    Route::put('/user/editUser/{id}', [UserController::class, 'editUser']);

    /*  METODOS DELETE DE User */
    Route::delete('/user/delete/{id}', [UserController::class, 'deleteUser']);
    Route::delete('/user/delete/rol', [UserController::class, 'deleteByrol']);
    Route::delete('/delete-cloudinary', [UserController::class, 'deleteImage']);
    Route::delete('/user/delete-photo-url', [UserController::class, 'deletePhotoUrl']);
    Route::get('/get-cloudinary', [UserController::class, 'getAllImages']);
    //Route::middleware('auth:sanctum')->delete('/user/deleteall/rol',[App\Http\Controllers\UserController::class, 'deleteAllByrol']);


    /* ----------------------------------------------------------------------------------------------------------------------------------------- */

    /* VocationalEducation */
    /* ----------------------------------------------------------------------------------------------------------------------------------------- */

    /* ----------------------------------------------------------------------------------------------------------------------------------------- */

    /*  METODOS GET DE VocationalEducation */
    Route::get('/vocationalEducation', [vocationalEducationController::class, 'getAll']);


    /*  METODOS GET DE VocationalEducation */
    Route::get('/vocationalEducation/{id}', [VocationalEducationController::class, 'getVocationalEducationById']);

    /*  METODOS POST DE VocationalEducation */
    Route::post('/vocationalEducation/add', [VocationalEducationController::class, 'addVocationalEducation']);

    /*  METODOS PUT DE VocationalEducation */
    Route::put('/vocationalEducation/edit/{id}', [VocationalEducationController::class, 'editVocationalEducation']);

    /*  METODOS DELETE DE VocationalEducation */
    Route::delete('/vocationalEducation/delete/{id}', [VocationalEducationController::class, 'deleteVocationalEducation']);

    Route::delete('/vocationalEducation/delete-all', [VocationalEducationController::class, 'deleteAll']);

    /* METODOS CSV */
    Route::post('/csv/import', [CSVController::class, 'import']);
    /* ----------------------------------------------------------------------------------------------------------------------------------------- */
});

