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
     * Show all appointments saved in the database
     *
     * @OA\Get(
     *     path="/api/appointments",
     *     tags={"Appointments"},
     *     summary="Show all appointments saved",
     *     @OA\Response(
     *         response=200,
     *         description="ALL APPOINTMENTS"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="ERROR"
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
                'message' => 'ALL APPOINTMENTS',
                'count' => $count,
                "users" => $appointment
            ], 200);
        }

        return response()->json([
            'status' => 0,
            'message' => 'EMPTY REGISTRY',
        ], 404);

    }

    /**
     * Find appointment by id.
     *
     * @OA\Get(
     *     path="/api/appointment/{id}",
     *     tags={"Appointments"},
     *     summary="Get Appointment By ID",
     *  @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Get Appointment By Id ",
     *         required=true,
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Get Appointment By Id"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="ERROR"
     *     )
     * )
     */
    public function getAppointmentById($id)
    {
        $appointment = Appointment::find($id);
        if ($appointment) {
            return response()->json([
                'status' => 1,
                'message' => 'FOUND ID: ' . $id,
                "users" => $appointment
            ], 200);
        }

        return response()->json([
            'status' => 0,
            'message' => 'EMPTY REGISTRY',
        ], 404);



    }

/**
     * Find appointment by DNI_Client
     *
     * @OA\Get(
     *     path="/api/appointment/dni/client/{DNI_Client}",
     *     tags={"Appointments"},
     *     summary="Get Appointment By DNI_Client",
     *  @OA\Parameter(
     *         name="DNI_Client",
     *         in="query",
     *         description="Get Appointment By DNI_Client",
     *         required=true,
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Get Appointment By DNI_Client"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="ERROR"
     *     )
     * )
     */
    public function getAppointmentByDNIClient($DNI)
    {
        $appointment = Appointment::where('DNI_client', $DNI)->first();
        if ($appointment) {
            return response()->json([
                'status' => 1,
                'message' => 'FOUND CLIENT DNI: ' . $DNI,
                "users" => $appointment
            ], 200);
        }

        return response()->json([
            'status' => 0,
            'message' => 'CLIENT DNI NOT FOUND',
        ], 404);


    }

/**
     * Find appointment by DNI_Student
     *
     * @OA\Get(
     *     path="/api/appointment/dni/student/{DNI_Student}",
     *     tags={"Appointments"},
     *     summary="Get Appointment By DNI_Student",
     *  @OA\Parameter(
     *         name="DNI_Student",
     *         in="query",
     *         description="Get Appointment By DNI_Student",
     *         required=true,
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Get Appointment By DNI_Student"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="ERROR"
     *     )
     * )
     */
    public function getClientByDniStudent($DNI)
    {
        $appointment = Appointment::where('DNI_Student', $DNI)->first();
        if ($appointment) {
            return response()->json([
                'status' => 1,
                'message' => 'FOUND STUDENT DNI: ' . $DNI,
                "users" => $appointment
            ], 200);
        }

        return response()->json([
            'status' => 0,
            'message' => 'STUDENT DNI NOT FOUND',
        ], 404);


    }
    /*___________________________________________________________________________________________________________________ */

    /*  POST */

/**
     * Add appointment
     *
     * @OA\Post(
     *     path="/api/appointment/add",
     *     tags={"Appointments"},
     *     summary="Add appointment",
     *     @OA\Response(
     *         response=200,
     *         description="Quote added"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="ERROR"
     *     )
     * )
     */
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

/**
     * Edit appointment by id
     *
     * @OA\Put(
     *     path="/api/appointment/edit/{id}",
     *     tags={"Appointments"},
     *     summary="Edit appointment by id",
     *  @OA\Parameter(
     *         name="appointment",
     *         in="query",
     *         description="Edit appointment by id",
     *         required=true,
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Edited quote"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="ERROR"
     *     )
     * )
     */
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

/**
     * Delete appointment by id
     *
     * @OA\Delete(
     *     path="/api/appointment/edit/{id}",
     *     tags={"Appointments"},
     *     summary="Delete appointment by id",
     *  @OA\Parameter(
     *         name="appointment",
     *         in="query",
     *         description="Delete appointment by id",
     *         required=true,
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Deleted date"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="ERROR"
     *     )
     * )
     */
    public function DeleteAppointmenById($id)
    {
        $appointment = Appointment::destroy($id);
        if ($appointment) {
            return response()->json([
                'status' => 1,
                'message' => 'REGISTRY WITH ID: ' . $id . ' DELETED',
                "users" => $appointment
            ], 200);
        }

        return response()->json([
            'status' => 0,
            'message' => 'REGISTRY NOT FOUND',
        ], 404);


    }
}
