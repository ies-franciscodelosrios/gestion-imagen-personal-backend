<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getClientAll()
    {
        $clients = Client::all();
        return $clients;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addClient(Request $request)
    {
        $client = new Client();
        $client -> DNI = $request -> DNI;
        $client -> Name = $request -> Name;
        $client -> Surname = $request -> Surname;
        $client -> Birth_Date = $request -> Birth_Date;
        $client -> Phone = $request -> Phone;
        $client -> Email = $request -> Email;
        $client -> More_Info = $request -> More_Info;
        $client -> Life_Style = $request -> Life_Style;
        $client -> Background_Health = $request -> Background_Health;
        $client -> Background_Aesthetic = $request -> Background_Aesthetic;
        $client -> Asthetic_Routine = $request -> Asthetic_Routine;
        $client -> Hairdressing_Routine = $request -> Hairdressing_Routine;

        $client -> save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function searchClient($query) {
        return Client::where('DNI', 'like', '%'.$query.'%')
          ->orWhere('Name', 'like', '%'.$query.'%')
          ->orWhere('Surname', 'like', '%'.$query.'%')
          ->get();
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
        $client -> DNI = $request -> DNI;
        $client -> Name = $request -> Name;
        $client -> Surname = $request -> Surname;
        $client -> Birth_Date = $request -> Birth_Date;
        $client -> Phone = $request -> Phone;
        $client -> Email = $request -> Email;
        $client -> More_Info = $request -> More_Info;
        $client -> Life_Style = $request -> Life_Style;
        $client -> Background_Health = $request -> Background_Health;
        $client -> Background_Aesthetic = $request -> Background_Aesthetic;
        $client -> Asthetic_Routine = $request -> Asthetic_Routine;
        $client -> Hairdressing_Routine = $request -> Hairdressing_Routine;

        $client -> save();
        return $client;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function deleteById($id)
    {
        $client = Client::destroy($id);
        return $client;
    }


    public function deleteAll(Request $request) {
        if ($request->isMethod('delete')) {
          Client::table('Client')->delete();
          return response()->json(['message' => 'Todos los registros de clientes han sido eliminados']);
        }
      }



}
