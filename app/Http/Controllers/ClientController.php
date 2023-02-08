<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{

    public function getClientAll()
    {
        $clients = Client::all();

        if (count($clients) !== 0) {
            return response()->json([
                'status' => 1,
                'message' => 'ALL CLIENTS',
                "users"=>$clients
            ], 200);
        }

        return response()->json([
            'status' => -1,
            'message' => 'NO CUSTOMERS SAVED',
        ], 404);
    }


    public function addClient(Request $request)
    {

    // Validación de datos de entrada
        $validator = Validator::make($request->all(), [
            'DNI' => 'required|unique:clients',
            // Agrega las demás reglas de validación que necesites
        ]);

        // Si la validación falla, regresa una respuesta con el error
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Crea un nuevo objeto de cliente
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
        // Asigna las demás propiedades al objeto de cliente

        // Guarda el cliente en la base de datos
        $client->save();

        // Regresa una respuesta de éxito
        return response()->json(['message' => 'Cliente creado con éxito'], 201);
    }


    public function searchClient($query)
    {
        $client= Client::where('id', 'like', '%'.$query.'%')->orWhere('DNI', 'like', '%'.$query.'%')
        ->orWhere('Name', 'like', '%'.$query.'%')
        ->orWhere('Surname', 'like', '%'.$query.'%')->first();
        if ($client) {
            return response()->json([
                'status' => 1,
                'message' => 'FOUND CUSTOMER ',
                "users"=>$client
            ], 200);
        }

        return response()->json([
            'status' => -1,
            'message' => 'THE DATA ENTERED IS NOT CORRECT',
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
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


    public function deleteById($id)
    {
        $client = Client::destroy($id);
        if ($client) {
            return response()->json([
                'status' => 1,
                'message' => 'USER DELETE WHITH ID IS '.$id,
            ], 200);
        }

        return response()->json([
            'status' => -1,
            'message' => 'ERROR',
        ], 401);
    }

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
}
