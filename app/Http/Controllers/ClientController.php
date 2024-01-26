<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientAuthRequest;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\PhotoUrl;
use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function getStats()
    {
        $clientCount = Client::count(); // Total number of data
        $appointmentCount = Appointment::count(); // Total number of appointments

        $teachersCount = User::where('rol', 1)->count(); // Number of normal data
        $studentsCount = User::where('rol', 2)->count(); // Number of super admins

        return response()->json([
            'status' => 1,
            'message' => 'REGISTRY FOUND',
            'data'=> [
                'clients' => $clientCount,
                'appointments' => $appointmentCount,
                'teachers' => $teachersCount,
                'students' => $studentsCount,
            ],
        ], 200);
    }

    public function getClientPaged(Request $request)
    {
        try {
            // Obtener los parámetros de la solicitud
            $sort = $request->sort;
            $sortColumn = $request->sortcolumn;
            $page = $request->page;
            $perPage = $request->perpage;
            $searchText = $request->searchtext;

            // Construir la consulta para obtener los clientes
            $query = Client::query();

            // Aplicar el ordenamiento
            $query->orderBy($sortColumn, $sort);

            // Aplicar el filtrado por texto de búsqueda
            if (!empty($searchText)) {
                $query->where(function ($q) use ($searchText) {
                    $q->where('name', 'LIKE', '%'.$searchText.'%')
                        ->orWhere('surname', 'LIKE', '%'.$searchText.'%')
                        ->orWhere('birth_date', 'LIKE', '%'.$searchText.'%')
                        ->orWhere('dni', 'LIKE', '%'.$searchText.'%')
                        ->orWhere('email', 'LIKE', '%'.$searchText.'%')
                        ->orWhere('phone', 'LIKE', '%'.$searchText.'%');
                    // Añade más condiciones de búsqueda según los campos necesarios
                });
            }

            // Obtener los clientes paginados
            $clients = $query->paginate($perPage, ['*'], 'page', $page);

            return response()->json([
                'status' => 1,
                'message' => 'REGISTRY FOUND',
                'data'=>$clients,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 0,
                'message' => 'NO CLIENTS FOUND ' + $th,
            ], 400);
        }
    }

    /**
     * This function will alow you to show all clients records.
     *
     * @OA\Get(
     *     path="/api/client",
     *     tags={"Client"},
     *     summary="Showing the whole list of the clients",
     *    @OA\Response(
     *        response=200,
     *        description="Clients registry found"
     *    ),
     *    @OA\Response(
     *        response=400,
     *        description="No clients saved"
     *    )
     * )
     */
    public function getClientAll()
    {
        $clients = Client::all();

        if (count($clients) !== 0) {
            return response()->json([
                'status' => 1,
                'message' => 'REGISTRY FOUND',
                'data'=>$clients,
            ], 200);
        }

        return response()->json([
            'status' => 0,
            'message' => 'NO CLIENTS FOUND',
        ], 400);
    }

    /**
     * This function will alow you to search for an specific client by his/her id, dni or name and surname.
     *
     * @OA\Get(
     *     path="/api/client/{data}",
     *     tags={"Client"},
     *     summary="Searching a client",
     *    @OA\Parameter(
     *        name="query",
     *        in="query",
     *        description="The variable we need to share the information all over the function",
     *        required=true
     *    ),
     *    @OA\Response(
     *        response=200,
     *        description="Client found"
     *    ),
     *    @OA\Response(
     *        response=400,
     *        description="Client not found"
     *    )
     * )
     */
    public function searchClient(Request $request)
    {
        $searchtext = $request->searchtext;
        $client = Client::where('id', 'like', '%'.$searchtext.'%')->orWhere('dni', 'like', '%'.$searchtext.'%')
     ->orWhere('name', 'like', '%'.$searchtext.'%')
     ->orWhere('surname', 'like', '%'.$searchtext.'%')->first();
        if ($client) {
            return response()->json([
                'status' => 1,
                'message' => 'CLIENT FOUND',
                'data'=>$client,
            ], 200);
        }

        return response()->json([
            'status' => 0,
            'message' => 'CLIENT NOT FOUND',
        ], 400);
    }

    /**
     * This function will alow you to search for an specific client by his/her id, dni or name and surname.
     *
     * @OA\Get(
     *     path="/api/client/{id}",
     *     tags={"Client"},
     *     summary="Searching a client",
     *    @OA\Parameter(
     *        name="query",
     *        in="query",
     *        description="The variable we need to share the information all over the function",
     *        required=true
     *    ),
     *    @OA\Response(
     *        response=200,
     *        description="Client found"
     *    ),
     *    @OA\Response(
     *        response=400,
     *        description="Client not found"
     *    )
     * )
     */
    public function searchClientByid(Request $request)
    {
        $id = $request->id;
        $client = Client::where('id', $id)->first();

        if ($client) {
            return response()->json([
                'status' => 1,
                'message' => 'GET USER BY ID '.$id,
                'data'=>$client,
            ], 200);
        }

        return response()->json([
            'status' => -1,
            'message' => 'EMPTY',
        ], 400);
    }

    /**
     * This function will add a new client in the database knowing that dnis can't be the same and showing an error message in case of repetition.
     *
     * @OA\Post(
     *     path="/api/client/add",
     *     tags={"Client"},
     *     summary="Adding a new client",
     *    @OA\Parameter(
     *        name="request",
     *        in="query",
     *        description="It's used for making a request",
     *        required=true
     *    ),
     *    @OA\Response(
     *        response=400,
     *        description="The validation has fail"
     *    ),
     *    @OA\Response(
     *        response=201,
     *        description="Client created successfully"
     *    )
     * )
     */
    public function addClient(ClientAuthRequest $request){
    $existingClientDNI = Client::where('dni', $request->dni)->first();
    $existingClientPhone = Client::where('phone', $request->phone)->first();
    $existingClientEmail = Client::where('email', $request->email)->first();

    if ($existingClientDNI || $existingClientPhone || $existingClientEmail) {
        $errors = [];
        if ($existingClientDNI) {
            $errors[] = 'Client with the same DNI already exists';
        }    
        if ($existingClientPhone) {
            $errors[] = 'Client with the same phone number already exists';
        }
        if ($existingClientEmail) {
            $errors[] = 'Client with the same email already exists';
        }
        return response()->json([
            'status' => -1,
            'message' => 'Client cancelled',
            'errors' => $errors
        ], 400);
    }

    $client = new Client();
    $client->dni = $request->dni;
    $client->name = $request->name;
    $client->surname = $request->surname;
    $client->birth_date = $request->birth_date;
    $client->phone = $request->phone;
    $client->email = $request->email;
    $client->more_info = $request->more_info;
    $client->life_style = $request->life_style;
    $client->background_health = $request->background_health;
    $client->background_aesthetic = $request->background_aesthetic;
    $client->asthetic_routine = $request->asthetic_routine;
    $client->hairdressing_routine = $request->hairdressing_routine;

    $client->save();

    return response()->json([
        'message' => 'CLIENT CREATED SUCCESSFULLY',
        'client_id' => $client->id
    ], 201);
}


    /**
     * This function will alow you to edit an specific client by his/her id.
     *
     * @OA\Put(
     *     path="/api/client/edit/{id}",
     *     tags={"Client"},
     *     summary="Editing a client",
     *    @OA\Parameter(
     *        name="request",
     *        in="query",
     *        description="It's used for making a request",
     *        required=true
     *    ),
     *    @OA\Response(
     *        response=200,
     *        description="Client deleted"
     *    ),
     *    @OA\Response(
     *        response=400,
     *        description="No client deleted"
     *    )
     * )
     */
    public function editById(ClientAuthRequest $request)
    {
        try{
            $client = Client::findOrFail($request->id);
            $client->dni = $request->dni;
            $client->name = $request->name;
            $client->surname = $request->surname;
            $client->birth_date = $request->birth_date;
            $client->phone = $request->phone;
            $client->email = $request->email;
            $client->more_info = $request->more_info;
            $client->life_style = $request->life_style;
            $client->background_health = $request->background_health;
            $client->background_aesthetic = $request->background_aesthetic;
            $client->asthetic_routine = $request->asthetic_routine;
            $client->hairdressing_routine = $request->hairdressing_routine;
    
            if($client->save()){
                return response()->json([
                    'status' => 1,
                    'message' => 'Client edited',
                    'id' => $client->id,
                ], 200);
            }else if (!$client->save()){

                return response()->json([
                    'status' => -1,
                    'message' => 'User ot added',
                ],400);
            }
            return $client;
        } catch (\Illuminate\Database\QueryException $exception) {
            $errorCode = $exception->errorInfo[1];
            if ($errorCode == 1062) {
                return response()->json([
                    'status' => -1,
                    'message' => 'DNI or email already exists in the database',
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
     * This function will alow you to delete an specific client by his/her id.
     *
     * @OA\Delete(
     *     path="/api/client/delete/{id}",
     *     tags={"Client"},
     *     summary="Deleting a client",
     *    @OA\Parameter(
     *        name="id",
     *        in="query",
     *        description="The variable we need to identify each client",
     *        required=true
     *    ),
     *    @OA\Response(
     *        response=200,
     *        description="Client deleted"
     *    ),
     *    @OA\Response(
     *        response=400,
     *        description="No client deleted"
     *    )
     * )
     */
    public function deleteById(Request $request)
    {
        $id = $request->id;
        $client = Client::destroy($id);
        if ($client) {
            return response()->json([
                'status' => 1,
                'message' => 'CLIENT WHITH ID '.$id.' SUCCESSFULLY DELETED',
            ], 200);
        }

        return response()->json([
            'status' => -1,
            'message' => 'YOU MUST PROVIDE AN ID TO DELETE A CLIENT',
        ], 404);

    }

    /**
     * This function will alow you to destroy all client records.
     *
     * @OA\Delete(
     *     path="/api/client/delete/all",
     *     tags={"Client"},
     *     summary="Deleting all the clients",
     *    @OA\Parameter(
     *        name="request",
     *        in="query",
     *        description="It's used for making a request",
     *        required=true
     *    ),
     *    @OA\Response(
     *        response=200,
     *        description="Clients deleted"
     *    ),
     *    @OA\Response(
     *        response=400,
     *        description="No clients deleted"
     *    )
     * )
     */
    public function deleteAll(Request $request)
    {
        if ($request->isMethod('delete')) {
            Client::table('Client')->delete();

            return response()->json([
                'status' => 1,
                'message' => 'ALL RECORDS HAVE BEEN DELETED',
            ], 200);
        }

        return response()->json([
            'status' => -1,
            'message' => 'ERROR',
        ], 400);
    }

    public function getPhotosUrl(Request $request)
    {
        try {
            $client = Client::findOrFail($request->id);

            $images = $client->photoUrls;

            return response()->json(['images' => $images], 200);
        } catch (\Exception $e) {
            // Error al eliminar la imagen
            return response()->json(['error' => 'Error al traer imagenes'], 500);
        }
    }

    public function storePhotoUrl(Request $request)
    {
        try {
            // Validar la solicitud y asegurarse de que se haya enviado una imagen
            $client = Client::findOrFail($request->id);

            // Guardar la imagen en un almacenamiento, por ejemplo, utilizando el almacenamiento local de Laravel o servicios en la nube como AWS S3

            $photoUrl = new PhotoUrl([
                'url' => $request->url,
            ]);

            $client->photoUrls()->save($photoUrl);

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
        try {
            $client = Client::findOrFail($request->id);

            try {
                // Buscar la imagen en Cloudinary
                $search = 'folder:iestablero public_id:'.$request->public_id;
                $images = Cloudinary::search()->expression($search)->execute();

                // Verificar si se encontró la imagen
                if (!$images['resources']) {
                    return response()->json(['message' => 'La imagen no se encontró en Cloudinary'], 400);
                }

                // Eliminar la imagen de Cloudinary
                $result = Cloudinary::destroy('iestablero/'.$request->public_id, [
                    'invalidate' => true,
                    'folder' => 'iestablero',
                ]);
            } catch (\Exception $e) {
                // Error al eliminar la imagen
                return response()->json(['error' => $e], 500);
            }

            // Verificar que la imagen exista para el usuario
            $photoUrl = $client->photoUrls()->findOrFail($request->photo_id);

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
