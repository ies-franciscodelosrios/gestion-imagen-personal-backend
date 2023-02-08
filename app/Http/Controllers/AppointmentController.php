<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /*  GET */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

        return $appointment;

    }

    /**
     * Display the specified resource.
     *
     * @param  string  $DNI
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  string  $DNI
     * @return \Illuminate\Http\Response
     */
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

        return $appointment;
    }
    /*___________________________________________________________________________________________________________________ */

    /*  POST */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
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

    /*  DELETE */
    /**
     * Remove the specified resource from storage.
     *
     *@param  int  $id
     * @return \Illuminate\Http\Response
     */
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

        return $appointment;
    }
}
