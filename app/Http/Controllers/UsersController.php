<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    /**
     * Display a listing of Users.
     *
     * @OA\Get(
     *     path="/api/users",
     *     tags={"Users"},
     *     summary="Shows all the users ",
     *       @OA\Response(
     *          response=200,
     *         description="List all the users of the database"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="An error has ocurred."
     *     )
     * )
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
     * Display a listing of students.
     *
     * @OA\Get(
     *     path="/api/users/rol/2",
     *     tags={"Users"},
     *     summary="Shows all the students ",
     * @OA\Response(
     *         response=200,
     *         description="List all the students of the database"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="An error has ocurred."
     *     )
     * )
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
     * Display a listing of Professors.
     *
     * @OA\Get(
     *     path="/api/users/rol/1",
     *     tags={"Users"},
     *     summary="Shows all the professors ",
     * @OA\Response(
     *          response=200,
     *         description="List all the professors of the database"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="An error has ocurred."
     *     )
     * )
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
     * Display a user based on their id.
     *
     * @OA\Get(
     *     path="/api/users/user/{id}",
     *     tags={"Users"},
     *     summary="Shows an user based on a id",
     * @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Get User By Id ",
     *         required=true,
     *      ),
     * @OA\Response(
     *          response=200,
     *         description="Shows all the information about of a user based that matches an id"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="An error has ocurred."
     *     )
     * )
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
     * Display a user based on their dni.
     *
     * @OA\Get(
     *     path="/api/userByDni/{DNI}",
     *     tags={"Users"},
     *     summary="Shows an user based on a dni",
     * @OA\Parameter(
     *         name="DNI",
     *         in="query",
     *         description="Get User By DNI ",
     *         required=true,
     *      ),
     * @OA\Response(
     *          response=200,
     *         description="Shows all the information about of a user based that matches an dni"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="An error has ocurred."
     *     )
     * )
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
    /**
     * Display a user based on their mail.
     *
     * @OA\Get(
     *     path="/api/userByCorreo/{correo}",
     *     tags={"Users"},
     *     summary="Shows an user based on a mail",
     * @OA\Parameter(
     *         name="mail",
     *         in="query",
     *         description="Get User By mail ",
     *         required=true,
     *      ),
     * @OA\Response(
     *          response=200,
     *         description="Shows all the information about of a user based that matches an mail"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="An error has ocurred."
     *     )
     * )
     */
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
     * Display a user based on their name.
     *
     * @OA\Get(
     *     path="/api/user/Student/{Name}",
     *     tags={"Users"},
     *     summary="Shows an user based on a name",
     * @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Get User By name ",
     *         required=true,
     *      ),
     * @OA\Response(
     *          response=200,
     *         description="Shows all the information about of a user based that matches an name"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="An error has ocurred."
     *     )
     * )
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

/**
     * Display a user based on their Course_year.
     *
     * @OA\Get(
     *     path="/api/users/course/{Course_year}",
     *     tags={"Users"},
     *     summary="Shows an user based on a Course_year",
     * @OA\Parameter(
     *         name="Course_year",
     *         in="query",
     *         description="Get User By Course_year ",
     *         required=true,
     *      ),
     * @OA\Response(
     *          response=200,
     *         description="Shows all the information about of a user based that matches an Course_year"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="An error has ocurred."
     *     )
     * )
     */
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

    /**
     * Display a user based on their cycle.
     *
     * @OA\Get(
     *     path="/api/users/cycle/{Cycle}",
     *     tags={"Users"},
     *     summary="Shows an user based on a cycle",
     * @OA\Parameter(
     *         name="cycle",
     *         in="query",
     *         description="Get User By cycle ",
     *         required=true,
     *      ),
     * @OA\Response(
     *          response=200,
     *         description="Shows all the information about of a user based that matches an cycle"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="An error has ocurred."
     *     )
     * )
     */
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

    /**
     * Adds a new student to the database.
     *
     * @OA\post(
     *     path="/api/user/addstudent",
     *     tags={"Users"},
     *     summary="Adds a new student ",
     * @OA\Response(
     *          response=200,
     *         description="Adds a new student to the database"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="An error has ocurred."
     *     )
     * )
     */
    public function addStudent(Request $request)
    {
        $user = new User();
        $user->DNI = $request->DNI;
        $user->Rol = 2;
        $user->Course_year = $request->Course_year;
        $user->Cycle = $request->Cycle;
        $user->Name = $request->Name;
        $user->Surname = $request->Surname;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->Others = $request->Others;
        $user->save();
    }

    /**
     * Adds a new professor to the database.
     *
     * @OA\post(
     *     path="/ap/user/addprofessor",
     *     tags={"Users"},
     *     summary="Adds a new professor ",
     * @OA\Response(
     *          response=200,
     *         description="Adds a new professor to the database"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="An error has ocurred."
     *     )
     * )
     */
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
    /**
     * Adds a all students to the database from a json file.
     *
     * @OA\post(
     *     path="/api/user/addstudents",
     *     tags={"Users"},
     *     summary="Adds an array of new students ",
     * @OA\Response(
     *          response=200,
     *         description="Adds all students to the database from a json file"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="An error has ocurred."
     *     )
     * )
     */

    public function addAllStudent()
    {
    }

    /**
     * Adds a all professor to the database from a json file.
     *
     * @OA\post(
     *     path="/api/user/addprofessors",
     *     tags={"Users"},
     *     summary="Adds an array of new professors ",
     * @OA\Response(
     *          response=200,
     *         description="Adds all professor to the database from a json file"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="An error has ocurred."
     *     )
     * )
     */
    public function addAllProfessor()
    {
    }


    /**
     * Updates an user based on their id
     *
     * @OA\put(
     *     path="/api/user/edit/{id}",
     *     tags={"Users"},
     *     summary="Updates an user based on their id",
     * @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Update user",
     *         required=true,
     *      ),
     * @OA\Response(
     *          response=200,
     *         description="Update an user using their id as reference"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="An error has ocurred."
     *     )
     * )
     */
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

    /**
     * Remove an user based on their id
     *
     * @OA\Delete(
     *     path="/api/user/delete/{id}",
     *     tags={"Users"},
     *     summary="Remove an user based on their id",
     * @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Delete user",
     *         required=true,
     *      ),
     * @OA\Response(
     *          response=200,
     *         description="Remove an user using their id as reference"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="An error has ocurred."
     *     )
     * )
     */
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


    /**
     * Remove an user based on their rol
     *
     * @OA\Delete(
     *     path="/api/user/delete/rol/{rol}",
     *     tags={"Users"},
     *     summary="Remove an user based on their irold",
     * @OA\Parameter(
     *         name="rol",
     *         in="query",
     *         description="Delete user",
     *         required=true,
     *      ),
     * @OA\Response(
     *          response=200,
     *         description="Remove an user using their rol as reference"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="An error has ocurred."
     *     )
     * )
     */
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
