<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{

    public function getStats(){
        $clientCount = Client::count(); // Total number of data
        $appointmentCount = Appointment::count(); // Total number of appointments
        
        $teachersCount = User::where('rol', 1)->count(); // Number of normal data
        $studentsCount = User::where('rol', 2)->count(); // Number of super admins
        

        return response()->json([
            'status' => 1,
            'message' => 'REGISTRY FOUND',
            "data"=> [
                'clients' => $clientCount,
                'appointments' => $appointmentCount,
                'teachers' => $teachersCount,
                'students' => $studentsCount
                ]
        ], 200);
    }

    public function getClientPaged(Request $request){
        try {
            $perPage = $request->perpage;
            $searchText = $request->searchtext;
            $page = $request->page;
    
            $clients = Client::when($searchText, function ($query, $searchText) {
                return $query->where('name', 'like', "%".$searchText."%")->orWhere('dni', 'like', '%'.$searchText.'%')->orWhere('surname', 'like', '%'.$searchText.'%');
            })->paginate($perPage, ['*'], 'page');
    
            return response()->json([
                'status' => 1,
                'message' => 'REGISTRY FOUND',
                "data"=>$clients
            ], 200);
        } catch (\Throwable $th) {
            print($th);
            return response()->json([
                'status' => 0,
                'message' => 'NO CLIENTS FOUND '+$th,
            ], 404);
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
 *        response=404,
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
                "data"=>$clients
            ], 200);
        }

        return response()->json([
            'status' => 0,
            'message' => 'NO CLIENTS FOUND',
        ], 404);
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
 *        response=404,
 *        description="Client not found"
 *    )
 * )
 */

 public function searchClient(Request $request)
 {
     $searchtext = $request->searchtext;
     $client= Client::where('id', 'like', '%'.$searchtext.'%')->orWhere('dni', 'like', '%'.$searchtext.'%')
     ->orWhere('name', 'like', '%'.$searchtext.'%')
     ->orWhere('surname', 'like', '%'.$searchtext.'%')->first();
     if ($client) {
         return response()->json([
             'status' => 1,
             'message' => 'CLIENT FOUND',
             "data"=>$client
         ], 200);
     }

     return response()->json([
         'status' => 0,
         'message' => 'CLIENT NOT FOUND',
     ], 404);
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
 *        response=404,
 *        description="Client not found"
 *    )
 * )
 */

 public function searchClientByid(Request $request)
 {

     $id = $request->id;
     $client= Client::where('id', $id)->first();

     if ($client) {
         return response()->json([
             'status' => 1,
             'message' => 'GET USER BY ID '.$id,
             "data"=>$client
         ], 200);
     }

     return response()->json([
         'status' => -1,
         'message' => 'EMPTY',
     ], 404);
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

    public function addClient(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'dni' => 'required|unique:clients',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }

        $client = new Client;
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

        return response()->json(['message' => 'CLIENT CREATED SUCCESSFULLY'], 201);
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
 *        response=404,
 *        description="No client deleted"
 *    )
 * )
 */

    public function editById(Request $request)
    {
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

        $client->save();

        return $client;
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
 *        response=404,
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
                'message' => 'CLIENT WHITH ID '.$id . ' SUCCESSFULLY DELETED',
            ], 200);
        }

        return response()->json([
            'status' => -1,
            'message' => 'CLIENT NOT DELETED',
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
 *        response=404,
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
        ], 404);
    }
}
