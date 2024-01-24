<?php

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


/* Auth */
/* ----------------------------------------------------------------------------------------------------------------------------------------- */
Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
Route::middleware('auth:sanctum')
    ->get('logout', [App\Http\Controllers\AuthController::class, 'logout']);

/* ----------------------------------------------------------------------------------------------------------------------------------------- */

/* Appointment */
/* ----------------------------------------------------------------------------------------------------------------------------------------- */

/*  METODOS GET DE Appointment */
Route::middleware('auth:sanctum')->get('/appointments', [App\Http\Controllers\AppointmentController::class, 'getAll']);
Route::middleware('auth:sanctum')->get('/appointment/id', [App\Http\Controllers\AppointmentController::class, 'getAppointmentById']);
Route::middleware('auth:sanctum')->get('/appointment/dni/client', [App\Http\Controllers\AppointmentController::class, 'getAppointmentBydniClient']);
Route::middleware('auth:sanctum')->get('/appointment/dni/student', [App\Http\Controllers\AppointmentController::class, 'getClientBydniStudent']);
Route::middleware('auth:sanctum')->get('/appointments/paged', [App\Http\Controllers\AppointmentController::class, 'getAppointmentsByDniStudent']);
Route::middleware('auth:sanctum')->get('/appointment/get-photos', [App\Http\Controllers\AppointmentController::class, 'getPhotosUrl']);

/*  METODOS POST DE Appointment */
Route::middleware('auth:sanctum')->post('/appointment', [App\Http\Controllers\AppointmentController::class, 'addAppointment']);
Route::middleware('auth:sanctum')->post('/appointment/add-photo-url', [App\Http\Controllers\AppointmentController::class, 'storePhotoUrl']);

/*  METODOS PUT DE Appointment */
Route::middleware('auth:sanctum')->put('/appointment', [App\Http\Controllers\AppointmentController::class, 'editAppointment']);

/*  METODOS DELETE DE Appointment */
Route::middleware('auth:sanctum')->delete('/appointment/delete-all', [App\Http\Controllers\AppointmentController::class, 'deleteAll']);
Route::middleware('auth:sanctum')->delete('/appointment/id', [App\Http\Controllers\AppointmentController::class, 'DeleteAppointmenById']);
Route::middleware('auth:sanctum')->delete('/appointment/delete-photo-url', [App\Http\Controllers\AppointmentController::class, 'deletePhotoUrl']);

/* ----------------------------------------------------------------------------------------------------------------------------------------- */

/* Client */
/* ----------------------------------------------------------------------------------------------------------------------------------------- */

/*  METODOS GET DE Client */

Route::middleware('auth:sanctum')->get('/client/id', [App\Http\Controllers\ClientController::class, 'searchClientByid']);
Route::middleware('auth:sanctum')->get('/client/data', [App\Http\Controllers\ClientController::class, 'searchClient']);
Route::middleware('auth:sanctum')->get('/client/stats', [App\Http\Controllers\ClientController::class, 'getStats']);
Route::middleware('auth:sanctum')->get('/client/get-photos', [App\Http\Controllers\ClientController::class, 'getPhotosUrl']);
Route::middleware('auth:sanctum')->get('/clients', [App\Http\Controllers\ClientController::class, 'getClientAll']);
Route::middleware('auth:sanctum')->get('/clients/paged', [App\Http\Controllers\ClientController::class, 'getClientPaged']);

/*  METODOS POST DE Client */
Route::middleware('auth:sanctum')->post('/client', [App\Http\Controllers\ClientController::class, 'addClient']);
Route::middleware('auth:sanctum')->post('/client/add-photo-url', [App\Http\Controllers\ClientController::class, 'storePhotoUrl']);

/*  METODOS PUT DE Client */
Route::middleware('auth:sanctum')->put('/client', [App\Http\Controllers\ClientController::class, 'editById']);

/*  METODOS DELETE DE Client */
Route::middleware('auth:sanctum')->delete('/client/id', [App\Http\Controllers\ClientController::class, 'deleteById']);
Route::middleware('auth:sanctum')->delete('/client/purge', [App\Http\Controllers\ClientController::class, 'deleteAll']);
Route::middleware('auth:sanctum')->delete('/client/delete-photo-url', [App\Http\Controllers\ClientController::class, 'deletePhotoUrl']);

/* ----------------------------------------------------------------------------------------------------------------------------------------- */

/* Users */
/* ----------------------------------------------------------------------------------------------------------------------------------------- */

/*  METODOS GET DE User */

Route::middleware('auth:sanctum')->get('/user', [App\Http\Controllers\UserController::class, 'getUserLogged']);
Route::middleware('auth:sanctum')->get('/user/id/{id}', [App\Http\Controllers\UserController::class, 'getUserByID']);
Route::middleware('auth:sanctum')->get('/users', [App\Http\Controllers\UserController::class, 'getAll']);
Route::middleware('auth:sanctum')->get('/users/rol/{rol}', [App\Http\Controllers\UserController::class, 'getUsersByRol']);
Route::middleware('auth:sanctum')->get('/users/course/{course_year}', [App\Http\Controllers\UserController::class, 'getUsersByCourse']);
Route::middleware('auth:sanctum')->get('/users/cycle/{cycle}', [App\Http\Controllers\UserController::class, 'getUsersByCycle']);
Route::middleware('auth:sanctum')->get('/users/search/{search}', [App\Http\Controllers\UserController::class, 'getUsersBySearch']);
Route::middleware('auth:sanctum')->get('/user/get-photos', [App\Http\Controllers\UserController::class, 'getPhotosUrl']);

/*  METODOS POST DE User */
Route::middleware('auth:sanctum')->post('/user/add/{type}', [App\Http\Controllers\UserController::class, 'addUser']);
Route::middleware('auth:sanctum')->post('/user/addstudents', [App\Http\Controllers\UserController::class, 'addAllStudent']);
Route::middleware('auth:sanctum')->post('/user/addprofessors', [App\Http\Controllers\UserController::class, 'addAllProfessor']);
Route::middleware('auth:sanctum')->post('/user/add-photo-url', [App\Http\Controllers\UserController::class, 'storePhotoUrl']);

/*  METODOS PUT DE User */
Route::middleware('auth:sanctum')->put('/user/editUser/{id}', [App\Http\Controllers\UserController::class, 'editUser']);

/*  METODOS DELETE DE User */
Route::middleware('auth:sanctum')->delete('/user/delete/{id}', [App\Http\Controllers\UserController::class, 'deleteUser']);
Route::middleware('auth:sanctum')->delete('/user/delete/rol', [App\Http\Controllers\UserController::class, 'deleteByrol']);
Route::middleware('auth:sanctum')->delete('/delete-cloudinary', [App\Http\Controllers\UserController::class, 'deleteImage']);
Route::middleware('auth:sanctum')->delete('/user/delete-photo-url', [App\Http\Controllers\UserController::class, 'deletePhotoUrl']);
Route::middleware('auth:sanctum')->get('/get-cloudinary', [App\Http\Controllers\UserController::class, 'getAllImages']);
//Route::middleware('auth:sanctum')->delete('/user/deleteall/rol',[App\Http\Controllers\UserController::class, 'deleteAllByrol']);


/* ----------------------------------------------------------------------------------------------------------------------------------------- */

/* VocationalEducation */
/* ----------------------------------------------------------------------------------------------------------------------------------------- */

/* ----------------------------------------------------------------------------------------------------------------------------------------- */

/*  METODOS GET DE VocationalEducation */
/**
 * @OA\Get(
 *     path="/vocationalEducation",
 *     summary="Get all vocational educations",
 *     tags={"Vocational Education"},
 *     security={{"sanctum":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/VocationalEducation")
 *     )
 * )
 */
Route::middleware('auth:sanctum')->get('/vocationalEducation', [App\Http\Controllers\VocationalEducationController::class, 'getAll']);


/*  METODOS GET DE VocationalEducation */
/**
 * @OA\Get(
 *     path="/vocationalEducation/{id}",
 *     summary="Get a vocational education by ID",
 *     tags={"Vocational Education"},
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the vocational education",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/VocationalEducation")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Vocational education not found"
 *     )
 * )
 */
Route::middleware('auth:sanctum')->get('/vocationalEducation/{id}', [App\Http\Controllers\VocationalEducationController::class, 'getVocationalEducationById']);

/*  METODOS POST DE VocationalEducation */
/**
 * @OA\Post(
 *     path="/vocationalEducation/add",
 *     summary="Add a new vocational education",
 *     tags={"Vocational Education"},
 *     security={{"sanctum":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/VocationalEducationRequest")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Vocational education added successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="integer", example=1),
 *             @OA\Property(property="message", type="string", example="vocationalEducation added"),
 *             @OA\Property(property="id", type="integer", example=123)
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad request",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="integer", example=-1),
 *             @OA\Property(property="message", type="string", example="VocationalEducation already exists")
 *         )
 *     )
 * )
 */
Route::middleware('auth:sanctum')->post('/vocationalEducation/add', [App\Http\Controllers\VocationalEducationController::class, 'addVocationalEducation']);

/*  METODOS PUT DE VocationalEducation */
/**
 * @OA\Put(
 *     path="/vocationalEducation/edit/{id}",
 *     summary="Edit a vocational education",
 *     tags={"Vocational Education"},
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the vocational education",
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/VocationalEducation")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Vocational education edited successfully",
 *         @OA\JsonContent(ref="#/components/schemas/VocationalEducation")
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Vocational education not edited"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Vocational education not found"
 *     )
 * )
 */
Route::middleware('auth:sanctum')->put('/vocationalEducation/edit/{id}', [App\Http\Controllers\VocationalEducationController::class, 'editVocationalEducation']);

/*  METODOS DELETE DE VocationalEducation */
/**
 * @OA\Delete(
 *     path="/vocationalEducation/delete/{id}",
 *     summary="Delete a vocational education",
 *     tags={"Vocational Education"},
 *     security={{"sanctum":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the vocational education",
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="Vocational education deleted successfully"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Vocational education not found"
 *     )
 * )
 */
Route::middleware('auth:sanctum')->delete('/vocationalEducation/delete/{id}', [App\Http\Controllers\VocationalEducationController::class, 'deleteVocationalEducation']);

/**
 * @OA\Delete(
 *     path="/vocationalEducation/delete-all",
 *     summary="Delete all vocational educations",
 *     tags={"Vocational Education"},
 *     security={{"sanctum":{}}},
 *     @OA\Response(
 *         response=204,
 *         description="All vocational educations deleted successfully"
 *     )
 * )
 */
Route::middleware('auth:sanctum')->delete('/vocationalEducation/delete-all', [App\Http\Controllers\VocationalEducationController::class, 'deleteAll']);

/* METODOS CSV */
Route::middleware('auth:sanctum')->post('/csv/import', [App\Http\Controllers\CsvController::class, 'import']);
/* ----------------------------------------------------------------------------------------------------------------------------------------- */
