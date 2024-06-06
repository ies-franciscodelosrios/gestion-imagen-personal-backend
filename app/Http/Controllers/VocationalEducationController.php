<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VocationalEducation;
use App\Http\Requests\VocationalEducationRequest;

class VocationalEducationController extends Controller
{
    /**
     * Retrieve all vocational educations.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Get(
     *     path="/vocational-educations",
     *     tags={"Vocational Education"},
     *     summary="Get all vocational educations",
     *     description="Retrieve all vocational educations.",
     *     produces={"application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *         @SWG\Schema(
     *             type="object",
     *             @SWG\Property(
     *                 property="status",
     *                 type="integer",
     *                 example=1
     *             ),
     *             @SWG\Property(
     *                 property="message",
     *                 type="string",
     *                 example="All Users"
     *             ),
     *             @SWG\Property(
     *                 property="data",
     *                 type="array",
     *                 @SWG\Items(ref="#/definitions/VocationalEducation")
     *             )
     *         )
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="No Users Found",
     *         @SWG\Schema(
     *             type="object",
     *             @SWG\Property(
     *                 property="status",
     *                 type="integer",
     *                 example=-1
     *             ),
     *             @SWG\Property(
     *                 property="message",
     *                 type="string",
     *                 example="No Users Found"
     *             )
     *         )
     *     )
     * )
     */
    public function getAll()
    {
        $vocationalEducation = VocationalEducation::all();
        if ($vocationalEducation) {
            return response()->json([
                'status' => 1,
                'message' => 'All Users',
                'data' => $vocationalEducation,
            ], 200);
        }
        return response()->json([
            'status' => -1,
            'message' => 'No Vocational Education Found',
        ], 400);
    }

    /**
     * Retrieve a vocational education record by its ID.
     *
     * @param int $id The ID of the vocational education record.
     * @return \App\Models\vocationalEducation|null The vocational education record, or null if not found.
     */
    public function getVocationalEducationById($id)
    {
        $vocationalEducation = VocationalEducation::where('id', $id)->with('users:id,cycle,name,surname,rol')->first();
        return $vocationalEducation;
    }

    /**
     * Add a new vocational education.
     *
     * @param  \app\Http\Requests\VocationalEducationRequest  $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Post(
     *     path="/api/vocational-education",
     *     summary="Add a new vocational education",
     *     tags={"Vocational Education"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="body",
     *         in="body",
     *         description="Vocational education data",
     *         required=true,
     *         @SWG\Schema(ref="#/definitions/VocationalEducationRequest")
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *         @SWG\Schema(
     *             type="object",
     *             @SWG\Property(property="status", type="integer", example=1),
     *             @SWG\Property(property="message", type="string", example="vocationalEducation added"),
     *             @SWG\Property(property="id", type="integer", example=1)
     *         )
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Bad Request",
     *         @SWG\Schema(
     *             type="object",
     *             @SWG\Property(property="status", type="integer", example=-1),
     *             @SWG\Property(property="message", type="string", example="VocationalEducation already exists or not added")
     *         )
     *     )
     * )
     */
    public function addVocationalEducation(VocationalEducationRequest $request)
    {
        $existingUser = VocationalEducation::where('id', $request->id)->orWhere('short_name', $request->short_name)->first();
        if ($existingUser) {
            return response()->json([
                'status' => -1,
                'message' => 'Vocational Education already exists',
            ], 400);
        }

        $vocationalEducation = new VocationalEducation();
        $vocationalEducation->short_name = $request->short_name;
        $vocationalEducation->long_name = $request->long_name;
        $vocationalEducation->description = $request->description;

        if ($vocationalEducation->save()) {
            return response()->json([
                'status' => 1,
                'message' => 'Vocational Education added',
                'id' => $vocationalEducation->id,
            ], 200);
        } elseif (!$vocationalEducation->save()) {
            return response()->json([
                'status' => -1,
                'message' => 'Vocational Education not added',
            ], 400);
        }
    }

    /**
     * Edit a vocational education record.
     *
     * @param  \App\Http\Requests\VocationalEducationRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function editVocationalEducation(VocationalEducationRequest $request, $id)
    {
        $vocationalEducation = VocationalEducation::find($id);
        if ($vocationalEducation) {
            $vocationalEducation->short_name = $request->short_name;
            $vocationalEducation->long_name = $request->long_name;
            $vocationalEducation->description = $request->description;
            if ($vocationalEducation->save()) {
                return response()->json([
                    'status' => 1,
                    'message' => 'vocationalEducation edited',
                ], 200);
            } elseif (!$vocationalEducation->save()) {
                return response()->json([
                    'status' => -1,
                    'message' => 'Vocational Education not edited',
                ], 400);
            }
        }
        return response()->json([
            'status' => -1,
            'message' => 'Vocational Education not found',
        ], 404);
    }

    /**
     * Delete a vocational education record.
     *
     * @param int $id The ID of the vocational education record to delete.
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Delete(
     *     path="/api/vocational-education/{id}",
     *     summary="Delete a vocational education record",
     *     tags={"Vocational Education"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the vocational education record to delete",
     *         required=true,
     *         type="integer",
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="vocationalEducation deleted",
     *         @SWG\Schema(
     *             type="object",
     *             @SWG\Property(
     *                 property="status",
     *                 type="integer",
     *                 example=1
     *             ),
     *             @SWG\Property(
     *                 property="message",
     *                 type="string",
     *                 example="vocationalEducation deleted"
     *             )
     *         )
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="vocationalEducation not deleted or not found",
     *         @SWG\Schema(
     *             type="object",
     *             @SWG\Property(
     *                 property="status",
     *                 type="integer",
     *                 example=-1
     *             ),
     *             @SWG\Property(
     *                 property="message",
     *                 type="string",
     *                 example="vocationalEducation not deleted or not found"
     *             )
     *         )
     *     )
     * )
     */
    public function deleteVocationalEducation($id)
    {
        $vocationalEducation = VocationalEducation::find($id);
        if ($vocationalEducation) {
            if ($vocationalEducation->delete()) {
                return response()->json([
                    'status' => 1,
                    'message' => 'Vocational Education deleted',
                ], 200);
            } elseif (!$vocationalEducation->delete()) {
                return response()->json([
                    'status' => -1,
                    'message' => 'Vocational Education not deleted',
                ], 400);
            }
        }
        return response()->json([
            'status' => -1,
            'message' => 'Vocational Education not found',
        ], 400);
    }

    /**
     * Delete all vocationalEducation records.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Delete(
     *     path="/vocational-education/delete-all",
     *     tags={"Vocational Education"},
     *     summary="Delete all vocationalEducation records",
     *     description="Deletes all the records from the vocationalEducation table.",
     *     produces={"application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="All vocationalEducation records deleted",
     *         @SWG\Schema(
     *             type="object",
     *             @SWG\Property(property="status", type="integer", example=1),
     *             @SWG\Property(property="message", type="string", example="All vocationalEducation deleted")
     *         )
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="vocationalEducation not deleted",
     *         @SWG\Schema(
     *             type="object",
     *             @SWG\Property(property="status", type="integer", example=-1),
     *             @SWG\Property(property="message", type="string", example="vocationalEducation not deleted")
     *         )
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="vocationalEducation not found",
     *         @SWG\Schema(
     *             type="object",
     *             @SWG\Property(property="status", type="integer", example=-1),
     *             @SWG\Property(property="message", type="string", example="vocationalEducation not found")
     *         )
     *     )
     * )
     */
    public function deleteAll()
    {
        $vocationalEducation = VocationalEducation::all();
        if ($vocationalEducation) {
            if (VocationalEducation::truncate()) {
                return response()->json([
                    'status' => 1,
                    'message' => 'All vocationalEducation deleted',
                ], 200);
            } elseif (!VocationalEducation::truncate()) {
                return response()->json([
                    'status' => -1,
                    'message' => 'Vocational Education not deleted',
                ], 400);
            }
        }
        return response()->json([
            'status' => -1,
            'message' => 'Vocational Education not found',
        ], 400);
    }
}
