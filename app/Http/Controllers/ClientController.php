<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{

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
                "users"=>$clients
            ], 200);
        }

        return response()->json([
            'status' => 0,
            'message' => 'NO CLIENTS FOUND',
        ], 404);
    }

    /**
 * This function will alow you to search for an specific client by his/her id, DNI or name and surname.
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

 public function searchClient($query)
 {
     $client= Client::where('id', 'like', '%'.$query.'%')->orWhere('DNI', 'like', '%'.$query.'%')
     ->orWhere('Name', 'like', '%'.$query.'%')
     ->orWhere('Surname', 'like', '%'.$query.'%')->first();
     if ($client) {
         return response()->json([
             'status' => 1,
             'message' => 'CLIENT FOUND',
             "users"=>$client
         ], 200);
     }

     return response()->json([
         'status' => 0,
         'message' => 'CLIENT NOT FOUND',
     ], 404);
 }

     /**
 * This function will alow you to search for an specific client by his/her id, DNI or name and surname.
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

 public function searchClientByid($ID)
 {

     $client= Client::where('id', $ID)->first();

     if ($client) {
         return response()->json([
             'status' => 1,
             'message' => 'GET USER BY ID '.$ID,
             "users"=>$client
         ], 200);
     }

     return response()->json([
         'status' => -1,
         'message' => 'EMPTY',
     ], 404);
 }
/**
 * This function will add a new client in the database knowing that DNIs can't be the same and showing an error message in case of repetition.
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
            'DNI' => 'required|unique:clients',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }

        $client = new Client;
        $client->DNI = $request->DNI;
        $client->Name = $request->Name;
        $client->Surname = $request->Surname;
        $client->Birth_Date = $request->Birth_Date;
        $client->Phone = $request->Phone;
        $client->Email = $request->Email;
        $client->More_Info = $request->More_Info;
        $client->Life_Style = $request->Life_Style;
        $client->Background_Health = $request->Background_Health;
        $client->Background_Aesthetic = $request->Background_Aesthetic;
        $client->Asthetic_Routine = $request->Asthetic_Routine;
        $client->Hairdressing_Routine = $request->Hairdressing_Routine;

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
        $client->DNI = $request->DNI;
        $client->Name = $request->Name;
        $client->Surname = $request->Surname;
        $client->Birth_Date = $request->Birth_Date;
        $client->Phone = $request->Phone;
        $client->Email = $request->Email;
        $client->More_Info = $request->More_Info;
        $client->Life_Style = $request->Life_Style;
        $client->Background_Health = $request->Background_Health;
        $client->Background_Aesthetic = $request->Background_Aesthetic;
        $client->Asthetic_Routine = $request->Asthetic_Routine;
        $client->Hairdressing_Routine = $request->Hairdressing_Routine;

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

    public function deleteById($id)
    {
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
