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
    public function getAll(){
        $appointment = Appointment::all();
        return $appointment;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function getAppointmentById($id){
        $appointment = Appointment::find($id);
        return $appointment;
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $DNI
     * @return \Illuminate\Http\Response
     */
    public function getAppointmentByDNIClient($DNI){
        $appointment = Appointment::where('DNI_client', $DNI)->first();
        return $appointment;
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $DNI
     * @return \Illuminate\Http\Response
     */
    public function getClientByDniStudent($DNI){
        $appointment = Appointment::where('DNI_Student', $DNI)->first();
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
        $appointment -> Date = $request -> Date;
        $appointment -> DNI_client = $request -> DNI_client;
        $appointment -> DNI_Student = $request -> DNI_Student;
        $appointment -> Treatment = $request -> Treatment;

        $appointment -> Protocol = $request -> Protocol;
        $appointment -> Consultancy = $request -> Consultancy;
        $appointment -> Tracking = $request -> Tracking;
        $appointment -> Survey = $request -> Survey;


        $appointment -> save();

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
    public function editAppointment(Request $request){
        $appointment = Appointment::findOrFail($request->id);
        $appointment -> Date = $request -> Date;
        $appointment -> DNI_client = $request -> DNI_client;
        $appointment -> DNI_Student = $request -> DNI_Student;
        $appointment -> Treatment = $request -> Treatment;

        $appointment -> Protocol = $request -> Protocol;
        $appointment -> Consultancy = $request -> Consultancy;
        $appointment -> Tracking = $request -> Tracking;
        $appointment -> Survey = $request -> Survey;

        $appointment -> save();
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
    public function DeleteAppointmenById($id){
        $appointment = Appointment::destroy($id);
        return $appointment;
    }

}
