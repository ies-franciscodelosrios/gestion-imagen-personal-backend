<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class UsersController extends Controller
{
    //
    /**
     * obtener todos los usuarios
     */
    public function getAll()
	{
        $users= User::all();
        return $users;
	}

    /**
     * obtener todos los usuarios con rol 2
     */
    public function getAllStudents(){
        $users= User::where('Rol', 2)->get();
        return $users;
        }


    /**
     * Obtener todos los usuarios con rol 1
     */
    public function getAllProfessor(){
        $users= User::where('Rol', 1)->get();
        return $users;
    }

    /**
     * Obtener usuario por dni
     */
    public function getUserByDni($DNI){

        $users= User::where('DNI', $DNI)->first();
        return $users;

    }
    /**
     * obtener todos los usuarios por nombre
     */
     public function getUserByName($Name){

        $users= User::where('Name', $Name)->get();
        return $users;

    }

    /**
     * Obtener todos los usuarios de un curso
     */
    public function getUserByCourse($Course_year){
        $users= User::where('Course_year', $Course_year)->get();
        return $users;

    }

    /**
     * Obtener todos los usuarios de un ciclo
     */
    public function getUserByCycle($Cycle){
        $users= User::where('Cycle', $Cycle)->get();
        return $users;


    }

    /**
     * Añadir alumno
     */
    public function addStudent( Request $request){
        $user= new User();
        $user->DNI=$request-> DNI ;
        $user->Rol=2;
        $user->Course_year= $request->Course_year;
        $user->Cycle= $request->Cycle;
        $user->Name= $request->Name;
        $user->Surname= $request->Surname;
        $user->Email= $request->Email;
        $user->Password= $request->Password;
        $user->Others= $request->Others;
        $user->save();

    }

    /**
     * Añadir profesor
     */
    public function addProfessor( Request $request){
        $user= new User();
        $user->DNI= $request->DNI;
        $user->Rol=1;
        $user->Course_year= $request->Course_year;
        $user->Cycle= $request->Cycle;
        $user->Name= $request->Name;
        $user->Surname= $request->Surname;
        $user->Email= $request->Email;
        $user->Password= $request->Password;
        $user->Others= $request->Others;

        $user->save();

    }

    /**
     * Añadir los estudiantes con el json
     */
    public function addAllStudent(){

    }

    /**
     * Añadir los profesores con el json
     */
    public function addAllProfessor(){

    }

    /**
     * login de usuario
     */
    public function loginUser(){

    }

    /**
     * editar usuario
     */
    public function editUser( Request $request)
	{
        $user = User::findOrFail($request->id);
        $user->Course_year= $request->Course_year;
        $user->Cycle= $request->Cycle;
        $user->Name= $request->Name;
        $user->Surname= $request->Surname;
        $user->Email= $request->Email;
        $user->Password= $request->Password;
        $user->Others= $request->Others;

       $user->save();
       return $user;
	}

    /**
     * borrar usuario segun dni
     */
    public function deleteUser($DNI){
        $users= User::destroy($DNI);
        return $users;

    }


    /**
     * borrar usuario segun rol
     */
    public function deleteByRol($rol){
        if($rol!==0){
            $users= User::where('Rol', $rol)->delete();
            return $users;
        }


    }



    public function deleteAllByRol(){
        $rol=array(1,2);

    foreach ($rol as $key => $value) {
        $users= User::where('Rol', $value)->delete();

    }
    return $users;


    }


}
