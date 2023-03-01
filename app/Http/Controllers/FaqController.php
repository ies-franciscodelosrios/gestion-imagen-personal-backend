<?php

namespace App\Http\Controllers;

use App\Models\FAQ;

class FaqController extends Controller
{
        /**
     * Display a listing of faq question.
     */
    public function getAll()
    {

        $questions = Faq::all();

        if ($questions) {
            return response()->json([
                'status' => 1,
                'message' => 'ALL questions',
                "questions"=>$questions
            ], 200);
        }

        return response()->json([
            'status' => -1,
            'message' => 'Not Found',
        ], 404);
    }
}
