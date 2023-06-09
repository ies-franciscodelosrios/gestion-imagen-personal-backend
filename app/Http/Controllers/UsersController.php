<?php

namespace App\Http\Controllers;

use App\Models\PhotoUrl;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
                "data" => $users
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
        $users = User::where('rol', 2)->get();
        $count = count($users);
        if ($users) {
            return response()->json([
                'status' => 1,
                'message' => 'ALL STUDENTS',
                'count' => $count,
                "data" => $users
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
        $users = User::where('rol', 1)->get();
        $count = count($users);
        if ($users) {
            return response()->json([
                'status' => 1,
                'message' => 'ALL PROFESSORS',
                'count' => $count,
                "data" => $users
            ], 200);
        }

        return response()->json([
            'status' => -1,
            'message' => 'EMPTY',
        ], 404);
    }

    public function getUserPaged(Request $request){
        try {
            // Obtener los parámetros de la solicitud
            $sort = $request->sort;
            $sortColumn = $request->sortcolumn;
            $page = $request->page;
            $perPage = $request->perpage;
            $searchText = $request->searchtext;
            $rol = $request->rol;
            $cycle = $request->cycle;

            // Construir la consulta para obtener los clientes
            $query = User::query();

            // Aplicar el ordenamiento
            $query->orderBy($sortColumn, $sort);
            if($rol){
                $query->where('rol', 'LIKE', $rol );
            }
            if($cycle){
                $query->where('cycle', 'LIKE', $cycle );
            }

            // Aplicar el filtrado por texto de búsqueda
            if (!empty($searchText)) {
                $query->where(function ($q) use ($searchText) {
                    $q->where('name', 'LIKE', '%' . $searchText . '%')
                        ->orWhere('surname', 'LIKE', '%' . $searchText . '%')
                        ->orWhere('dni', 'LIKE', '%' . $searchText . '%')
                        ->orWhere('email', 'LIKE', '%' . $searchText . '%');
                    // Añade más condiciones de búsqueda según los campos necesarios
                });
            }

            // Obtener los clientes paginados
            $users = $query->paginate($perPage, ['*'], 'page', $page);

            return response()->json([
                'status' => 1,
                'message' => 'REGISTRY FOUND',
                "data"=>$users
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => 0,
                'message' => 'NO CLIENTS FOUND '+$th,
            ], 404);
        }

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
    public function getUserByID(Request $request)
    {

        $id = $request->id;
        $users = User::where('id', $id)->first();

        if ($users) {
            return response()->json([
                'status' => 1,
                'message' => 'GET USER BY ID ' . $id,
                "data" => $users
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
     *     path="/api/userBydni/{dni}",
     *     tags={"Users"},
     *     summary="Shows an user based on a dni",
     * @OA\Parameter(
     *         name="dni",
     *         in="query",
     *         description="Get User By dni ",
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
    public function getUserBydni(Request $request)
    {
        $dni = $request->dni;
        $users = User::where('dni', $dni)->first();
        if ($users) {
            return response()->json([
                'status' => 1,
                'message' => 'GET USER BY dni ' . $dni,
                "data" => $users
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
    public function getUserByCorreo(Request $request)
    {
        $email = $request->email;
        $users = User::where('email', $email)->first();
        if ($users) {
            return response()->json([
                'status' => 1,
                'message' => 'GET USER BY CORREO ' . $email,
                "data" => $users
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
     *     path="/api/user/Student/{name}",
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
    public function getUserByName(Request $request)
    {
        $name = $request->name;
        $users = User::where('name', $name)->get();
        if ($users) {
            return response()->json([
                'status' => 1,
                'message' => 'GET USER BY NAME ' . $name,
                "data" => $users
            ], 200);
        }

        return response()->json([
            'status' => -1,
            'message' => 'EMPTY',
        ], 404);
    }

    /**
     * Display a user based on their course_year.
     *
     * @OA\Get(
     *     path="/api/users/course/{course_year}",
     *     tags={"Users"},
     *     summary="Shows an user based on a course_year",
     * @OA\Parameter(
     *         name="course_year",
     *         in="query",
     *         description="Get User By course_year ",
     *         required=true,
     *      ),
     * @OA\Response(
     *          response=200,
     *         description="Shows all the information about of a user based that matches an course_year"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="An error has ocurred."
     *     )
     * )
     */
    public function getUserByCourse(Request $request)
    {
        $course_year = $request->course_year;
        $users = User::where('course_year', $course_year)->get();
        if (count($users) !== 0) {
            return response()->json([
                'status' => 1,
                'message' => 'GET USER BY COURSE YEAR ' . $course_year,
                "data" => $users
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
     *     path="/api/users/cycle/{cycle}",
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
    public function getUserBycycle(Request $request)
    {
        $cycle = $request->cycle;
        $users = User::where('cycle', $cycle)->get();
        if (count($users) !== 0) {
            return response()->json([
                'status' => 1,
                'message' => 'GET USER BY cycle ' . $cycle,
                "data" => $users
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
        $user->dni = $request->dni;
        $user->rol = 2;
        $user->course_year = $request->course_year;
        $user->cycle = $request->cycle;
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->password = Hash::make('root');
        $user->others = $request->others;
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
        $user->dni = $request->dni;
        $user->rol = 1;
        $user->course_year = $request->course_year;
        $user->cycle = $request->cycle;
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->password = Hash::make('root');
        $user->others = $request->others;

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
        $user->dni = $request->dni;
        $user->course_year = $request->course_year;
        $user->cycle = $request->cycle;
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        if (strlen($request->password) > 8) {
            $user->password = Hash::make($request->password);
        } else if (strlen($request->password) >= 1) {
            return response()->json([
                'status' => -1,
                'message' => 'La contraseña debe ser de 8 caracteres al menos.',
            ], 404);
        }
        $user->others = $request->others;

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
    public function deleteUser(Request $request)
    {
        $id = $request->id;
        $users = User::destroy($id);
        if ($users) {
            return response()->json([
                'status' => 1,
                'message' => 'USER DELETE WHITH ID IS ' . $id,
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
    public function deleteByrol(Request $request)
    {
        $rol = $request->rol;
        if ($rol !== 0) {
            $users = User::where('rol', $rol)->delete();
            if ($users) {
                return response()->json([
                    'status' => 1,
                    'message' => 'USER DELETE WHITH rol IS ' + $rol,
                ], 200);
            }

            return response()->json([
                'status' => -1,
                'message' => 'EMPTY',
            ], 404);
        }
    }

    /*  public function deleteAllByrol()
    {
        $rol = [1, 2];

        foreach ($rol as $key => $value) {
            $users = User::where('rol', $value)->delete();
        }

        return $users;
    } */

    public function deleteImage(Request $request)
    {
        try {
            // Buscar la imagen en Cloudinary
            $search = 'folder:iestablero public_id:' . $request->public_id;
            $images = Cloudinary::search()->expression($search)->execute();

            // Verificar si se encontró la imagen
            if (!$images['resources']) {
                return response()->json(['message' => 'La imagen no se encontró en Cloudinary'], 404);
            }

            // Eliminar la imagen de Cloudinary
            $result = Cloudinary::destroy('iestablero/'.$request->public_id, [
                'invalidate' => true,
                'folder' => 'iestablero'
            ]);
            
            // Verificar si la eliminación fue exitosa
            if ($result['result'] === 'ok') {
                return response()->json(['message' => 'La imagen se eliminó correctamente'], 200);
            } else {
                return response()->json(['message' => $result], 500);
            }
        } catch (\Exception $e) {
            // Error al eliminar la imagen
            return response()->json(['error' => $e], 500);
        }
    }

    public function getAllImages()
    {
        try{
            // Obtener todas las imágenes de Cloudinary
            $images = Cloudinary::search()->expression('folder:iestablero')->execute();

            // Verificar si se obtuvieron imágenes
            if (!$images) {
                return response()->json(['message' => 'No se encontraron imágenes en Cloudinary'], 404);
            }

            // Recorrer las imágenes y obtener las URLs
            $imageUrls = [];
            foreach ($images['resources'] as $image) {
                $imageUrls[] = $image['url'];
            }

            return response()->json(['images' => $imageUrls], 200);
        } catch (\Exception $e) {
            // Error al eliminar la imagen
            return response()->json(['error' => 'Error al traer imagenes'], 500);
        }
    }

    public function getPhotosUrl(Request $request)
    {
        try{
            $user = User::findOrFail($request->id);

            $images = $user->photoUrls;

            return response()->json(['images' => $images], 200);
        } catch (\Exception $e) {
            // Error al eliminar la imagen
            return response()->json(['error' => 'Error al traer imagenes'], 500);
        }    
    }

    public function storePhotoUrl(Request $request)
    {
        try{
            // Validar la solicitud y asegurarse de que se haya enviado una imagen
            $user = User::findOrFail($request->id);

            // Guardar la imagen en un almacenamiento, por ejemplo, utilizando el almacenamiento local de Laravel o servicios en la nube como AWS S3

            $photoUrl = new PhotoUrl([
                'url' => $request->url
            ]);

            $user->photoUrls()->save($photoUrl);

            return response()->json([
                'status' => 1,
                'message' => 'Foto guardada',
            ], 200);
        } catch (\Exception $e) {
            // Error al eliminar la imagen
            return response()->json(['error' => 'Error al guardar imagenes'], 500);
        }
    }

    public function deletePhotoUrl(Request $request)
    {
        try{
            $user = User::findOrFail($request->id);

            try {
                // Buscar la imagen en Cloudinary
                $search = 'folder:iestablero public_id:' . $request->public_id;
                $images = Cloudinary::search()->expression($search)->execute();
    
                // Verificar si se encontró la imagen
                if (!$images['resources']) {
                    return response()->json(['message' => 'La imagen no se encontró en Cloudinary'], 404);
                }
    
                // Eliminar la imagen de Cloudinary
                $result = Cloudinary::destroy('iestablero/'.$request->public_id, [
                    'invalidate' => true,
                    'folder' => 'iestablero'
                ]);
                
            } catch (\Exception $e) {
                // Error al eliminar la imagen
                return response()->json(['error' => $e], 500);
            }
            
            // Verificar que la imagen exista para el usuario
            $photoUrl = $user->photoUrls()->findOrFail($request->photo_id);

            // Eliminar la imagen de tu almacenamiento, por ejemplo, utilizando el almacenamiento local de Laravel o servicios en la nube como AWS S3

            $photoUrl->delete();

            return response()->json([
                'status' => 1,
                'message' => 'Foto eliminada',
            ], 200);
        } catch (\Exception $e) {
            // Error al eliminar la imagen
            return response()->json(['error' => 'Error al eliminar imagen'], 500);
        }
    }

}
