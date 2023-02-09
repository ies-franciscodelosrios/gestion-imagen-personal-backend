<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    /**
     * obtener todos los usuarios
     */
    public function getAll()
    {
        $users = User::all();

        if ($users) {
            return response()->json([
                'status' => 1,
                'message' => 'ALL USERS',
                "users"=>$users
            ], 200);
        }

        return response()->json([
            'status' => -1,
            'message' => 'VACIO',
        ], 404);
    }

    /**
     * obtener todos los usuarios con rol 2
     */
    public function getAllStudents()
    {
        $users = User::where('Rol', 2)->get();
        $count = count($users);
        if ($users) {
            return response()->json([
                'status' => 1,
                'message' => 'ALL STUDENTS',
                'count'=> $count,
                "users"=>$users
            ], 200);
        }

        return response()->json([
            'status' => -1,
            'message' => 'EMPTY',
        ], 404);
    }

    /**
     * Obtener todos los usuarios con rol 1
     */
    public function getAllProfessor()
    {
        $users = User::where('Rol', 1)->get();
        $count = count($users);
        if ($users) {
            return response()->json([
                'status' => 1,
                'message' => 'ALL PROFESSORS',
                'count'=> $count,
                "users"=>$users
            ], 200);
        }

        return response()->json([
            'status' => -1,
            'message' => 'EMPTY',
        ], 404);
    }

     /**
     * Obtener usuario por dni
     */
    public function getUserByID($ID){

        $users= User::where('id', $ID)->first();

        if ($users) {
            return response()->json([
                'status' => 1,
                'message' => 'GET USER BY ID '.$ID,
                "users"=>$users
            ], 200);
        }

        return response()->json([
            'status' => -1,
            'message' => 'EMPTY',
        ], 404);

    }
    /**
     * Obtener usuario por dni
     */
    public function getUserByDni($DNI)
    {

       $users= User::where('DNI', $DNI)->first();
       if ($users) {
           return response()->json([
               'status' => 1,
               'message' => 'GET USER BY DNI '.$DNI,
               "users"=>$users
           ], 200);
       }

       return response()->json([
           'status' => -1,
           'message' => 'EMPTY',
       ], 404);

    }
       public function getUserByCorreo($Correo){
        $users= User::where('Email', $Correo)->first();
        if ($users) {
            return response()->json([
                'status' => 1,
                'message' => 'GET USER BY CORREO '.$Correo,
                "users"=>$users
            ], 200);
        }

        return response()->json([
            'status' => -1,
            'message' => 'EMPTY',
        ], 404);
    }

    /**
     * obtener todos los usuarios por nombre
     */
    public function getUserByName($Name)
    {
        $users = User::where('Name', $Name)->get();
        if ($users) {
            return response()->json([
                'status' => 1,
                'message' => 'GET USER BY NAME '.$Name,
                "users"=>$users
            ], 200);
        }

        return response()->json([
            'status' => -1,
            'message' => 'EMPTY',
        ], 404);
    }


    public function getUserByCourse($Course_year)
    {
        $users = User::where('Course_year', $Course_year)->get();
        if (count($users) !== 0) {
            return response()->json([
                'status' => 1,
                'message' => 'GET USER BY COURSE YEAR '.$Course_year,
                "users"=>$users
            ], 200);
        }

        return response()->json([
            'status' => 1,
            'message' => 'EMPTY',
        ], 404);
    }


    public function getUserByCycle($Cycle)
    {
        $users = User::where('Cycle', $Cycle)->get();
        if (count($users) !== 0) {
            return response()->json([
                'status' => 1,
                'message' => 'GET USER BY CYCLE '.$Cycle,
                "users"=>$users
            ], 200);
        }

        return response()->json([
            'status' => -1,
            'message' => 'EMPTY',
        ], 404);
    }


    public function addStudent(Request $request)
    {
        $user = new User();
        $user->DNI = $request->DNI;
        $user->Rol = 2;
        $user->Course_year = $request->Course_year;
        $user->Cycle = $request->Cycle;
        $user->Name = $request->Name;
        $user->Surname = $request->Surname;
        $user->Email = $request->Email;
        $user->Password = $request->Password;
        $user->Others = $request->Others;
        $user->save();
    }


    public function addProfessor(Request $request)
    {
        $user = new User();
        $user->DNI = $request->DNI;
        $user->Rol = 1;
        $user->Course_year = $request->Course_year;
        $user->Cycle = $request->Cycle;
        $user->Name = $request->Name;
        $user->Surname = $request->Surname;
        $user->Email = $request->Email;
        $user->Password = $request->Password;
        $user->Others = $request->Others;

        $user->save();
    }


    public function addAllStudent()
    {
    }


    public function addAllProfessor()
    {
    }

    public function editUser(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->Course_year = $request->Course_year;
        $user->Cycle = $request->Cycle;
        $user->Name = $request->Name;
        $user->Surname = $request->Surname;
        $user->Email = $request->Email;
        $user->Password = $request->Password;
        $user->Others = $request->Others;

        $user->save();

        return $user;
    }


    public function deleteUser($id)
    {
        $users = User::destroy($id);
        if ($users) {
            return response()->json([
                'status' => 1,
                'message' => 'USER DELETE WHITH ID IS '.$id,
            ], 200);
        }

        return response()->json([
            'status' => -1,
            'message' => 'EMPTY',
        ], 404);
    }


    public function deleteByRol($rol)
    {
        if ($rol !== 0) {
            $users = User::where('Rol', $rol)->delete();
            if ($users) {
                return response()->json([
                    'status' => 1,
                    'message' => 'USER DELETE WHITH ROL IS '+$rol,
                ], 200);
            }

            return response()->json([
                'status' => -1,
                'message' => 'EMPTY',
            ], 404);
        }
    }

   /*  public function deleteAllByRol()
    {
        $rol = [1, 2];

        foreach ($rol as $key => $value) {
            $users = User::where('Rol', $value)->delete();
        }

        return $users;
    } */
}
