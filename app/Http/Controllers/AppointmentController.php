<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Client;
use App\Models\PhotoUrl;
use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function getAppointmentsByDniStudent(Request $request)
    {
        $query = Appointment::query();
    
        if ($request->has('dni_student') && strlen($request->dni_student) >= 1) {
            $query->where('dni_student', $request->dni_student);
        }
    
        if ($request->has('dni_client') && strlen($request->dni_client) >= 1) {
            $query->where('dni_client', $request->dni_client);
        }
    
        // Cargar relaciones de usuario y cliente
        $query->with('student', 'client');

        // Agregar filtro de búsqueda si se proporciona un texto de búsqueda
        if ($request->has('searchtext')) {
            $searchText = $request->input('searchtext');
            $query->where(function ($q) use ($searchText) {
                $q->where('treatment', 'like', '%' . $searchText . '%')
                    ->orWhere('protocol', 'like', '%' . $searchText . '%')
                    ->orWhere('consultancy', 'like', '%' . $searchText . '%')
                    ->orWhere('tracking', 'like', '%' . $searchText . '%')
                    ->orWhere('date', 'like', '%' . $searchText . '%')
                    ->orWhere('survey', 'like', '%' . $searchText . '%')
                    ->orWhereHas('student', function ($q) use ($searchText) {
                        $q->where('name', 'like', '%' . $searchText . '%')
                            ->orWhere('surname', 'like', '%' . $searchText . '%');
                    })
                    ->orWhereHas('client', function ($q) use ($searchText) {
                        $q->where('name', 'like', '%' . $searchText . '%');
                    });
            });
        }

        // Paginar los resultados
        $perPage = $request->input('perpage', 10);
        $appointments = $query->paginate($perPage, ['*'], 'page', $request->input('page', 1));
    
        return response()->json($appointments);
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
        $appointment->start_time = $request->start_time;
        $appointment->end_time = $request->end_time;
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
        $appointment->start_time = $request->start_time;
        $appointment->end_time = $request->end_time;
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


    public function getPhotosUrl(Request $request)
    {
        try{
            $appointment = Appointment::findOrFail($request->id);

            $images = $appointment->photoUrls;

            return response()->json(['images' => $images], 200);
        } catch (\Exception $e) {
            // Error al eliminar la imagen
            return response()->json(['error' => 'Error al traer imagenes'], 500);
        }    
    }

    public function storePhotoUrl(Request $request)
    {
        try{
            // Validar la solicitud y asegurarse de que se haya enviado una imagen
            $appointment = Appointment::findOrFail($request->id);

            // Guardar la imagen en un almacenamiento, por ejemplo, utilizando el almacenamiento local de Laravel o servicios en la nube como AWS S3

            $photoUrl = new PhotoUrl([
                'url' => $request->url
            ]);

            $appointment->photoUrls()->save($photoUrl);

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
        try{
            $appointment = Appointment::findOrFail($request->id);

            try {
                // Buscar la imagen en Cloudinary
                $search = 'folder:iestablero public_id:' . $request->public_id;
                $images = Cloudinary::search()->expression($search)->execute();
    
                // Verificar si se encontró la imagen
                if (!$images['resources']) {
                    return response()->json(['message' => 'La imagen no se encontró en Cloudinary'], 404);
                }
    
                // Eliminar la imagen de Cloudinary
                Cloudinary::destroy('iestablero/'.$request->public_id, [
                    'invalidate' => true,
                    'folder' => 'iestablero'
                ]);
                
            } catch (\Exception $e) {
                // Error al eliminar la imagen
                return response()->json(['error' => 'Error Cloudinary: ' . $e->getMessage()], 500);
            }
            
            // Verificar que la imagen exista para el usuario
            $photoUrl = $appointment->photoUrls()->findOrFail($request->photo_id);

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
