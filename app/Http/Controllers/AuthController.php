<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Login
     *
     * @OA\Post(
     *     path="/api/login",
     *     tags={"Auth"},
     *     summary="Log-in with email and password.Generate token",
     *  @OA\Parameter(
     *         name="Request",
     *         in="query",
     *         description="Log-in with email and password.",
     *         required=true,
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Login successful and token generated."
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="ERROR"
     *     )
     * )
     */
    public function login(Request $request)
    {
        //$this->validateLogin($request);
        //dd("hola");

        Log::debug($request->only('email', 'password'));

        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'token' => $request->user()->createToken($request->device)->plainTextToken,
                'status' => 1,
                'message' => 'Login success',
                'id' => $request->user()->id,
            ], 200);
        }

        return response()->json([
            'status' => -1,
            'message' => 'Error at LogIn',
        ], 400);
    }

    public function validateLogin(Request $request)
    {
        return $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device' => 'required',
        ]);
    }

    /**
     * Logout
     *
     * @OA\Get(
     *     path="/api/logout",
     *     tags={"Auth"},
     *     summary="Logout of the application.",
     *  @OA\Parameter(
     *         name="Request",
     *         in="query",
     *         description="session started.",
     *         required=true,
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Logout successful."
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="ERROR"
     *     )
     * )
     */
    public function logout(Request $request)
    {
        if ($request->user()->currentAccessToken()->delete()) {
            return response()->json([
                'status' => 1,
                'message' => 'Logout success',
                'id' => $request->user()->id,
            ], 200);
        }

        return response()->json([
            'status' => -1,
            'message' => 'Logout error',
        ], 400);
    }
}
