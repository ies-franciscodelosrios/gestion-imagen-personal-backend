<?php

namespace App\Http\Controllers;
use App\Models\Photo;



use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use CloudinaryLabs\CloudinaryLaravel\MediaAlly;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function getAll()
    {
        $images = Photo::all();
        return response()->json($images);
    }

    public function getById($id)
    {
        $image = Photo::findOrFail($id);
        return response()->json($image);
    }

    public function getByAppointment($id_appointment)
    {
        $images = Photo::where('id_appointment', $id_appointment)->get();
        return response()->json($images);
    }

    public function addPhoto(Request $request)
    {

        $photo = new Photo();

        $file = request()->file('imagen');
        $obj = Cloudinary::upload($file->getRealPath(), ['folder' => 'Appointment']);
        $public_id = MediaAlly::getPublicId($obj);
        $url = Cloudinary::getUrl($public_id);

        $photo->title = $request->title;
        $photo->public_id = $public_id;
        $photo->url = $url;
        $photo->id_appintment = $request->id_appintment;

        $photo->save();


    }

    public function updatePhoto(Request $request, $id)
    {
        $image = Photo::findOrFail($id);

        if ($request->hasFile('image')) {
            // Eliminar la imagen anterior de Cloudinary
            Cloudinary::destroy($image->public_id);

            // Subir la nueva imagen a Cloudinary
            $uploadedFile = Cloudinary::upload($request->file('image')->getRealPath());
            $public_id = MediaAlly::getPublicId($uploadedFile);
       
            $image->public_id = $public_id;
        }

        $image->title = $request->input('title');
        $image->id_appointment = $request->input('id_appointment');
        $image->save();

        return response()->json($image);
    }

    public function destroy($id)
    {
        $image = Photo::findOrFail($id);

        // Eliminar la imagen de Cloudinary
        Cloudinary::destroy($image->public_id);

        // Eliminar el registro de la base de datos
        $image->delete();

        return response()->json(null, 204);
    }
}
