<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
/**
* @OA\Info(title="API PERICLES", version="1.0")
*
* @OA\Server(url="http://swagger.local")
*/
class AppointmentController extends Controller
{
    /*  GET */

/**
 * Display a listing of the resource.
 * Mostramos el listado de los regitros solicitados.
 *
 * @OA\Get(
 *     path="/api/appointments",
 *     tags={"appointments"},
 *     summary="Mostar listado de todas las citas",
 *     @OA\Response(
 *         response=200,
 *         description="Mostar listado de todas las citas"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Ha ocurrido un error."
 *     )
 * )
 */
    public function getAll()
    {
        $appointment = Appointment::all();

        $count = count($appointment);
        if ($appointment) {
            return response()->json([
                'status' => 1,
                'message' => 'REGISTRY FOUND',
                'count'=> $count,
                "users"=>$appointment
            ], 200);
        }

        return response()->json([
            'status' => 0,
            'message' => 'EMPTY REGISTRY',
        ], 404);

    }


    public function getAppointmentById($id)
    {
        $appointment = Appointment::find($id);
        if ($appointment) {
            return response()->json([
                'status' => 1,
                'message' => 'FOUND ID: '.$id,
                "users"=>$appointment
            ], 200);
        }

        return response()->json([
            'status' => 0,
            'message' => 'EMPTY REGISTRY',
        ], 404);



    }


    public function getAppointmentByDNIClient($DNI)
    {
        $appointment = Appointment::where('DNI_client', $DNI)->first();
        if ($appointment) {
            return response()->json([
                'status' => 1,
                'message' => 'FOUND CLIENT DNI: '.$DNI,
                "users"=>$appointment
            ], 200);
        }

        return response()->json([
            'status' => 0,
            'message' => 'CLIENT DNI NOT FOUND',
        ], 404);


    }


    public function getClientByDniStudent($DNI)
    {
        $appointment = Appointment::where('DNI_Student', $DNI)->first();
        if ($appointment) {
            return response()->json([
                'status' => 1,
                'message' => 'FOUND STUDENT DNI: '.$DNI,
                "users"=>$appointment
            ], 200);
        }

        return response()->json([
            'status' => 0,
            'message' => 'STUDENT DNI NOT FOUND',
        ], 404);


    }
    /*___________________________________________________________________________________________________________________ */

    /*  POST */


    public function addAppointment(Request $request)
    {
        $appointment = new Appointment();
        $appointment->Date = $request->Date;
        $appointment->DNI_client = $request->DNI_client;
        $appointment->DNI_Student = $request->DNI_Student;
        $appointment->Treatment = $request->Treatment;

        $appointment->Protocol = $request->Protocol;
        $appointment->Consultancy = $request->Consultancy;
        $appointment->Tracking = $request->Tracking;
        $appointment->Survey = $request->Survey;

        $appointment->save();

    }

    /*___________________________________________________________________________________________________________________ */

    /*  PUT */


    public function editAppointment(Request $request)
    {
        $appointment = Appointment::findOrFail($request->id);
        $appointment->Date = $request->Date;
        $appointment->DNI_client = $request->DNI_client;
        $appointment->DNI_Student = $request->DNI_Student;
        $appointment->Treatment = $request->Treatment;

        $appointment->Protocol = $request->Protocol;
        $appointment->Consultancy = $request->Consultancy;
        $appointment->Tracking = $request->Tracking;
        $appointment->Survey = $request->Survey;

        $appointment->save();

        return $appointment;
    }

    /*___________________________________________________________________________________________________________________ */


    public function DeleteAppointmenById($id)
    {
        $appointment = Appointment::destroy($id);
        if ($appointment) {
            return response()->json([
                'status' => 1,
                'message' => 'REGISTRY WITH ID: '.$id.' DELETED',
                "users"=>$appointment
            ], 200);
        }

        return response()->json([
            'status' => 0,
            'message' => 'REGISTRY NOT FOUND',
        ], 404);


    }
}
