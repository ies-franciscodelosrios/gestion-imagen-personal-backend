<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAuth1Request;
use App\Models\PhotoUrl;
use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display logged user.
     *
     * @OA\Get(
     *     path="/api/user",
     *     tags={"Users"},
     *     summary="Shows logged user",
     *     @OA\Response(
     *         response=200,
     *         description="Display logged user."
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="An error has ocurred."
     *     )
     * )
     */
    public function getUserLogged(Request $request)
    {
        //Log::debug($request->user('api'));
        return $request->user();
    }

    /**
     * Display all users.
     *
     * @OA\Get(
     *     path="/api/users",
     *     tags={"Users"},
     *     summary="Display all users.",
     *     @OA\Response(
     *         response=200,
     *         description="List all users"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="An error has ocurred."
     *     )
     * )
     */
    public function getAll(Request $request)
    {
        $users = User::all();
        if ($users) {
            return response()->json([
                'status' => 1,
                'message' => 'All Users',
                'data' => $users,
            ], 200);
        }
        return response()->json([
            'status' => -1,
            'message' => 'No Users Found',
        ], 400);
    }

    /**
     * Display a user based on their id.
     *
     * @OA\Get(
     *     path="/api/users/user/id/{id}",
     *     tags={"Users"},
     *     summary="Shows an user based on a id",
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Get User By Id ",
     *         required=true,
     *     ),
     *     @OA\Response(
     *          response=200,
     *         description="Shows all the information about of a user based that matches an id"
     *     ),
     *     @OA\Response(
     *         response=401,
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
                'message' => 'Get user by ID ' . $id,
                'data' => $users,
            ], 200);
        }
        return response()->json([
            'status' => -1,
            'message' => 'No User Found',
        ], 400);
    }

    /**
     * Display a listing of students or professors depending by the rol.
     *
     * @OA\Get(
     *     path="/api/users/rol/1",
     *     tags={"Users"},
     *     summary="Shows all the professors ",
     * @OA\Response(
     *         response=200,
     *         description="List all the students of the database"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="An error has ocurred."
     *     )
     * )
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
     *         response=400,
     *         description="An error has ocurred."
     *     )
     * )
     */
    public function getUsersByRol(Request $request)
    {
        $rol = $request->rol;
        $users = User::where('rol', $rol)->get();
        $count = count($users);
        if ($request->rol == '1') {
            if ($users) {
                return response()->json([
                    'status' => 1,
                    'message' => 'All professors',
                    'count' => $count,
                    'data' => $users,
                ], 200);
            }
            return response()->json([
                'status' => -1,
                'message' => 'No professors Found',
            ], 400);
        } else if ($request->rol == '2') {
            if ($users) {
                return response()->json([
                    'status' => 1,
                    'message' => 'All Students',
                    'count' => $count,
                    'data' => $users,
                ], 200);
            }
            return response()->json([
                'status' => -1,
                'message' => 'No Students Found',
            ], 400);
        }
    }

    public function getUsersBySearch(Request $request)
    {
        $search = $request->search;
        $users = User::where('name', 'LIKE', "%{$search}%")
            ->orWhere('surname', 'LIKE', "%{$search}%")
            ->orWhere('course_year', 'LIKE', "%{$search}%")
            ->orWhere('cycle', 'LIKE', "%{$search}%")
            ->orWhere('rol', 'LIKE', "%{$search}%")
            ->get();
        if ($users) {
            return response()->json([
                'status' => 1,
                'message' => 'Users found by ' . $search,
                'data' => $users,
            ], 200);
        }
        return response()->json([
            'status' => -1,
            'message' => 'No Users Found',
        ], 400);
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
     *         response=400,
     *         description="An error has ocurred."
     *     )
     * )
     */
    public function getUsersByCourse(Request $request)
    {
        $course_year = $request->course_year;
        $users = User::where('course_year', $course_year)->get();
        if (count($users) !== 0) {
            return response()->json([
                'status' => 1,
                'message' => 'Get user by course year ' . $course_year,
                'data' => $users,
            ], 200);
        }
        return response()->json([
            'status' => 1,
            'message' => 'No User Found',
        ], 400);
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
     *         response=400,
     *         description="An error has ocurred."
     *     )
     * )
     */
    public function getUsersByCycle(Request $request)
    {
        $cycle = $request->cycle;
        $users = User::where('cycle', $cycle)->get();
        if (count($users) !== 0) {
            return response()->json([
                'status' => 1,
                'message' => 'Get user by cycle ' . $cycle,
                'data' => $users,
            ], 200);
        }
        return response()->json([
            'status' => -1,
            'message' => 'No User Found',
        ], 400);
    }

    /**
     * Adds a user to the database.
     *
     * @OA\Post(
     *     path="/api/user/adduser",
     *     tags={"Users"},
     *     summary="Adds a user to the database",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UserAuth1Request")
     *     ),
     *     @OA\Response(
     *          response=200,
     *         description="User added to the database",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=1),
     *             @OA\Property(property="message", type="string", example="User added"),
     *             @OA\Property(property="id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="An error has occurred."
     *     )
     * )
     */
    public function addUser(UserAuth1Request $request)
    {
        $existingUser = User::where('dni', $request->dni)->orWhere('email', $request->email)->first();
        if ($existingUser) {
            return response()->json([
                'status' => -1,
                'message' => 'User already exists',
            ], 400);
        }

        $user = new User();
        $user->dni = $request->dni;
        if ($request->type == 'professor') {
            $user->rol = 1;
        } else if ($request->type == 'student') {
            $user->rol = 2;
        } else {
            return response()->json([
                'status' => -1,
                'message' => 'No type found',
            ], 404);
        }
        $user->course_year = $request->course_year;
        $user->cycle = $request->cycle;
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->password = Hash::make($user->password);
        $user->others = $request->others;

        if ($user->save()) {
            return response()->json([
                'status' => 1,
                'message' => 'User added',
                'id' => $user->id,
            ], 200);
        } else if (!$user->save()) {
            return response()->json([
                'status' => -1,
                'message' => 'User not added',
            ], 400);
        }
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
     *         response=400,
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
     *         response=400,
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
     *         response=400,
     *         description="An error has ocurred."
     *     )
     * )
     */
    public function editUser(UserAuth1Request $request)
    {
        try {
            $user = User::findOrFail($request->id);
            $user->dni = $request->dni;
            $user->course_year = $request->course_year;
            $user->cycle = $request->cycle;
            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->others = $request->others;

            if ($user->save()) {
                return response()->json([
                    'status' => 1,
                    'message' => 'User updated',
                    'id' => $user->id,
                ], 200);
            } else if (!$user->save()) {
                return response()->json([
                    'status' => -1,
                    'message' => 'User not updated',
                ], 400);
            }
            return $user;
        } catch (\Illuminate\Database\QueryException $exception) {
            $errorCode = $exception->errorInfo[1];
            if ($errorCode == 1062) {
                return response()->json([
                    'status' => -1,
                    'message' => 'DNI, Phone or email are already in use',
                ], 400);
            } else {
                return response()->json([
                    'status' => -1,
                    'message' => 'An error has occurred',
                ], 500);
            }
        }
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
     *         response=400,
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
                'message' => 'Delete user by ID ' . $id,
            ], 200);
        }

        return response()->json([
            'status' => -1,
            'message' => 'No User Found',
        ], 400);

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
     *         response=400,
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
                    'message' => 'Delete user by rol ' + $rol,
                ], 200);
            }
            return response()->json([
                'status' => -1,
                'message' => 'No User Found',
            ], 400);
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
                return response()->json(['message' => 'Image not found in Cloudinary'], 400);
            }

            // Eliminar la imagen de Cloudinary
            $result = Cloudinary::destroy('iestablero/' . $request->public_id, [
                'invalidate' => true,
                'folder' => 'iestablero',
            ]);

            // Verificar si la eliminación fue exitosa
            if ($result['result'] === 'ok') {
                return response()->json(['message' => 'Image deleted succesfully'], 200);
            } else {
                return response()->json(['message' => $result], 400);
            }
        } catch (\Exception $e) {
            // Error al eliminar la imagen
            return response()->json(['error' => $e], 400);
        }
    }

    public function getAllImages()
    {
        try {
            // Obtener todas las imágenes de Cloudinary
            $images = Cloudinary::search()->expression('folder:iestablero')->execute();

            // Verificar si se obtuvieron imágenes
            if (!$images) {
                return response()->json(['message' => 'Images not found in Cloudinary'], 400);
            }

            // Recorrer las imágenes y obtener las URLs
            $imageUrls = [];
            foreach ($images['resources'] as $image) {
                $imageUrls[] = $image['url'];
            }

            return response()->json(['images' => $imageUrls], 200);
        } catch (\Exception $e) {
            // Error al eliminar la imagen
            return response()->json(['error' => 'Error taking images'], 400);
        }
    }

    public function getPhotosUrl(Request $request)
    {
        try {
            $user = User::findOrFail($request->id);

            $images = $user->photoUrls;

            return response()->json(['images' => $images], 200);
        } catch (\Exception $e) {
            // Error al eliminar la imagen
            return response()->json(['error' => 'Error taking images'], 400);
        }
    }

    public function storePhotoUrl(Request $request)
    {
        try {
            // Validar la solicitud y asegurarse de que se haya enviado una imagen
            $user = User::findOrFail($request->id);

            // Guardar la imagen en un almacenamiento, por ejemplo, utilizando el almacenamiento local de Laravel o servicios en la nube como AWS S3

            $photoUrl = new PhotoUrl([
                'url' => $request->url,
            ]);

            $user->photoUrls()->save($photoUrl);

            return response()->json([
                'status' => 1,
                'message' => 'Photo saved',
            ], 200);
        } catch (\Exception $e) {
            // Error al eliminar la imagen
            return response()->json(['error' => 'Error saving images'], 400);
        }
    }

    public function deletePhotoUrl(Request $request)
    {
        try {
            $user = User::findOrFail($request->id);

            try {
                // Buscar la imagen en Cloudinary
                $search = 'folder:iestablero public_id:' . $request->public_id;
                $images = Cloudinary::search()->expression($search)->execute();

                // Verificar si se encontró la imagen
                if (!$images['resources']) {
                    return response()->json(['message' => 'Image not found in Cloudinary'], 400);
                }

                // Eliminar la imagen de Cloudinary
                $result = Cloudinary::destroy('iestablero/' . $request->public_id, [
                    'invalidate' => true,
                    'folder' => 'iestablero',
                ]);
            } catch (\Exception $e) {
                // Error al eliminar la imagen
                return response()->json(['error' => $e], 400);
            }

            // Verificar que la imagen exista para el usuario
            $photoUrl = $user->photoUrls()->findOrFail($request->photo_id);

            // Eliminar la imagen de tu almacenamiento, por ejemplo, utilizando el almacenamiento local de Laravel o servicios en la nube como AWS S3

            $photoUrl->delete();

            return response()->json([
                'status' => 1,
                'message' => 'Photo deleted',
            ], 200);
        } catch (\Exception $e) {
            // Error al eliminar la imagen
            return response()->json(['error' => 'Error deleting image'], 400);
        }
    }
}
