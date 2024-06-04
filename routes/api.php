<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CSVController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VocationalEducationController;

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
Route::middleware('auth:sanctum')->get('logout', [AuthController::class, 'logout']);

/* Group for middleware */
/* ----------------------------------------------------------------------------------------------------------------------------------------- */
Route::middleware(['auth:sanctum'])->group(function () {

    /* Vocational Educations */
    /* ----------------------------------------------------------------------------------------------------------------------------------------- */
    Route::get('/vocationaleducation', [VocationalEducationController::class, 'getAll']);
    Route::get('/vocationaleducation/id/{id}', [VocationalEducationController::class, 'getVocationalEducationById']);
    Route::post('/vocationaleducation/add', [VocationalEducationController::class, 'addVocationalEducation']);
    Route::put('/vocationaleducation/edit/{id}', [VocationalEducationController::class, 'editVocationalEducation']);
    Route::delete('/vocationaleducation/delete/{id}', [VocationalEducationController::class, 'deleteVocationalEducation']);
    Route::delete('/vocationaleducation/delete-all', [VocationalEducationController::class, 'deleteAll']);


    /* Users */
    /* ----------------------------------------------------------------------------------------------------------------------------------------- */
    Route::get('/user', [UserController::class, 'getUserLogged']);
    Route::get('/user/id/{id}', [UserController::class, 'getUserByID']);
    Route::get('/users', [UserController::class, 'getAll']);
    Route::get('/users/rol/{rol}', [UserController::class, 'getUsersByRol']);
    Route::get('/users/course/{course_year}', [UserController::class, 'getUsersByCourse']);
    Route::get('/users/cycle/{cycle}', [UserController::class, 'getUsersByCycle']);
    Route::get('/users/search/{search}', [UserController::class, 'getUsersBySearch']);
    Route::get('/user/get-photos', [UserController::class, 'getPhotosUrl']);
    Route::get('/get-cloudinary', [UserController::class, 'getAllImages']);
    Route::post('/user/add/{type}', [UserController::class, 'addUser']);
    Route::post('/user/addstudents', [UserController::class, 'addAllStudent']);
    Route::post('/user/addprofessors', [UserController::class, 'addAllProfessor']);
    Route::post('/user/add-photo-url', [UserController::class, 'storePhotoUrl']);
    Route::put('/user/edit/{id}', [UserController::class, 'editUser']);
    Route::delete('/user/delete/{id}', [UserController::class, 'deleteUser']);
    Route::delete('/user/delete/rol', [UserController::class, 'deleteByrol']);
    Route::delete('/delete-cloudinary', [UserController::class, 'deleteImage']);
    Route::delete('/user/delete-photo-url', [UserController::class, 'deletePhotoUrl']);
    Route::post('/user/addAvatar', [UserController::class, 'addAvatar']);
    Route::delete('/user/deleteAvatar', [UserController::class, 'deleteAvatar']);

    /* Clients */
    /* ----------------------------------------------------------------------------------------------------------------------------------------- */
    Route::get('/client/id', [ClientController::class, 'searchClientByid']);
    Route::get('/client/data', [ClientController::class, 'searchClient']);
    Route::get('/client/stats', [ClientController::class, 'getStats']);
    Route::get('/client/get-photos', [ClientController::class, 'getPhotosUrl']);
    Route::get('/clients', [ClientController::class, 'getClientAll']);
    Route::get('/clients/paged', [ClientController::class, 'getClientPaged']);
    Route::post('/client/add', [ClientController::class, 'addClient']);
    Route::post('/client/add-photo-url', [ClientController::class, 'storePhotoUrl']);
    Route::put('/client/edit', [ClientController::class, 'editById']);
    Route::delete('/client/id', [ClientController::class, 'deleteById']);
    Route::delete('/client/purge', [ClientController::class, 'deleteAll']);
    Route::delete('/client/delete-photo-url', [ClientController::class, 'deletePhotoUrl']);

    /* Appointments */
    /* ----------------------------------------------------------------------------------------------------------------------------------------- */
    Route::get('/appointments', [AppointmentController::class, 'getAll']);
    Route::get('/appointment/id', [AppointmentController::class, 'getAppointmentById']);
    Route::get('/appointment/dni/client', [AppointmentController::class, 'getAppointmentBydniClient']);
    Route::get('/appointment/dni/student', [AppointmentController::class, 'getClientBydniStudent']);
    Route::get('/appointments/paged', [AppointmentController::class, 'getAppointmentsByDniStudent']);
    Route::get('/appointments/byClientId', [AppointmentController::class, 'getAppointmentsByClientId']);
    Route::get('/appointment/get-photos', [AppointmentController::class, 'getPhotosUrl']);
    Route::post('/appointment', [AppointmentController::class, 'addAppointment']);
    Route::post('/appointment/add-photo-url', [AppointmentController::class, 'storePhotoUrl']);
    Route::put('/appointment', [AppointmentController::class, 'editAppointment']);
    Route::delete('/appointment/delete-all', [AppointmentController::class, 'deleteAll']);
    Route::delete('/appointment/id', [AppointmentController::class, 'DeleteAppointmenById']);
    Route::delete('/appointment/delete-photo-url', [AppointmentController::class, 'deletePhotoUrl']);

    /* Import/Export CSV */
    /* ----------------------------------------------------------------------------------------------------------------------------------------- */
    Route::post('/csv/import', [CSVController::class, 'import']);
});
