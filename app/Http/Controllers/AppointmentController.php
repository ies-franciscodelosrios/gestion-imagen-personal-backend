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
                "data" => $appointment
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
    public function getAppointmentById(Request $request)
    {
        $id = $request->id;
        $appointment = Appointment::find($id);
        if ($appointment) {
            return response()->json([
                'status' => 1,
                'message' => 'FOUND ID: ' . $id,
                "data" => $appointment
            ], 200);
        }

        return response()->json([
            'status' => 0,
            'message' => 'EMPTY REGISTRY',
        ], 404);



    }

/**
     * Find appointment by dni_client
     *
     * @OA\Get(
     *     path="/api/appointment/dni/client/{dni_client}",
     *     tags={"Appointments"},
     *     summary="Get Appointment By dni_client",
     *  @OA\Parameter(
     *         name="dni_client",
     *         in="query",
     *         description="Get Appointment By dni_client",
     *         required=true,
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Get Appointment By dni_client"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="ERROR"
     *     )
     * )
     */
    public function getAppointmentBydniClient(Request $request)
    {
        $dni = $request->dni;
        $appointment = Appointment::where('dni_client', $dni)->first();
        if ($appointment) {
            return response()->json([
                'status' => 1,
                'message' => 'FOUND CLIENT dni: ' . $dni,
                "data" => $appointment
            ], 200);
        }

        return response()->json([
            'status' => 0,
            'message' => 'CLIENT dni NOT FOUND',
        ], 404);


    }

/**
     * Find appointment by dni_student
     *
     * @OA\Get(
     *     path="/api/appointment/dni/student/{dni_student}",
     *     tags={"Appointments"},
     *     summary="Get Appointment By dni_student",
     *  @OA\Parameter(
     *         name="dni_student",
     *         in="query",
     *         description="Get Appointment By dni_student",
     *         required=true,
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Get Appointment By dni_student"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="ERROR"
     *     )
     * )
     */
    public function getClientBydniStudent(Request $request)
    {
        $dni = $request->dni;
        $appointment = Appointment::where('dni_student', $dni)->first();
        if ($appointment) {
            return response()->json([
                'status' => 1,
                'message' => 'FOUND STUDENT dni: ' . $dni,
                "data" => $appointment
            ], 200);
        }

        return response()->json([
            'status' => 0,
            'message' => 'STUDENT dni NOT FOUND',
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
        $appointment->date = $request->date;
        $appointment->dni_client = $request->dni_client;
        $appointment->dni_student = $request->dni_student;
        $appointment->treatment = $request->treatment;

        $appointment->protocol = $request->protocol;
        $appointment->consultancy = $request->consultancy;
        $appointment->tracking = $request->tracking;
        $appointment->survey = $request->survey;

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
        $appointment->date = $request->date;
        $appointment->dni_client = $request->dni_client;
        $appointment->dni_student = $request->dni_student;
        $appointment->treatment = $request->treatment;

        $appointment->protocol = $request->protocol;
        $appointment->consultancy = $request->consultancy;
        $appointment->tracking = $request->tracking;
        $appointment->survey = $request->survey;

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
    public function DeleteAppointmenById(Request $request)
    {
        $id = $request->id;
        $appointment = Appointment::destroy($id);
        if ($appointment) {
            return response()->json([
                'status' => 1,
                'message' => 'REGISTRY WITH ID: ' . $id . ' DELETED',
                "data" => $appointment
            ], 200);
        }

        return response()->json([
            'status' => 0,
            'message' => 'REGISTRY NOT FOUND',
        ], 404);


    }
}
