<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
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



 Route::controller(UsersController::class) -> group(function(){

    /**
    * GET
    */
    Route::get('/users','getAll');
    Route::get('/users/rol/2','getAllStudents');
    Route::get('/users/rol/1','getAllProfessor');
    Route::get('/user/{DNI}','getUserByDni');
    Route::get('/user/Student/{Name}','getUserByName');
    Route::get('/users/course/{Course_year}','getUserByCourse');
    Route::get('/users/cycle/{Cycle}','getUserByCycle');

    /**
     * POST
     */
    Route::post('/user/addstudent','addStudent');
    Route::post('/user/addprofessor','addProfessor');
    Route::post('/user/addstudents','addAllStudent');
    Route::post('/user/addprofessors','addAllProfessor');
    Route::post('/user/login','loginUser');

    /**
     * put
     */
    Route::put('/user/edit/{id}','editUser');
    /**
    * delete
    */

    Route::delete('/user/delete/{dni}','deleteUser');
    Route::delete('/user/delete/rol/{rol}','deleteByRol');
    Route::delete('/user/deleteall/rol','deleteAllByRol');
});





