<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::post("/login", function (Request $request) {
    try {
        $login = [
            "email" => $request->email,
            "password" => $request->password,
        ];
        if (Auth::attempt($login)) {
            $user = Auth::user();
            $data["name"] = $user->name;
            $data["id_rt_rw"] = $user->id_rt_rw;
            $data["level"] = $user->level;
            $data["token"] = $user->createToken("accessToken")->accessToken;
            return response()->json(
                [
                    "status" => "success",
                    "data" => $data,
                    "message" => "Login sukses!",
                ],
                200
            );
        } else {
            return response()->json(
                [
                    "status" => "Not found",
                    "message" => "Login Gagal!",
                ],
                400
            );
        }
    } catch (Exception $e) {
        return response()->json(
            [
                "status" => "Internal Server Error!",
                "message" => "error!",
            ],
            500
        );
    }
});

Route::group(["middleware" => "auth:api"], function () {
    Route::get("/logout", function (Request $request) {
        try {
            if (Auth::check()) {
                $user = Auth::user()->token();
                $user->revoke();
            }
            return response()->json(["status" => "OK", "message" => "Berhasil Logout!"], 200);
        } catch (Exception $e) {
            return response()->json(
                ["status" => "Internal Server Error", "message" => "Error!"],
                500
            );
        }
    });
});

/**
 * @OA\Post(
 *     path="/api/login",
 *     tags={"Auth"},
 *     summary="Login function",
 *     description="Login to app",
 *     operationId="greet",
 *     @OA\Parameter(
 *          name="email",
 *          description="Email",
 *          required=true,
 *          in="query",
 *          @OA\Schema(
 *              type="string"
 *          )
 *     ),
 *     @OA\Parameter(
 *          name="password",
 *          description="Password",
 *          required=true,
 *          in="query",
 *          @OA\Schema(
 *              type="string"
 *          )
 *     ),
 *     @OA\Response(
 *         response="default",
 *         description="successful operation"
 *     )
 * )
 *
 * @OA\Get(
 *     path="/api/logout",
 *     tags={"Auth"},
 *     summary="Logout from App",
 *     description="Logout from app",
 *     @OA\Parameter(
 *          name="id",
 *          description="id",
 *          required=true,
 *          in="query",
 *          @OA\Schema(
 *              type="string"
 *          )
 *     ),
 *     @OA\Response(
 *         response="default",
 *         description="successful operation"
 *     )
 * )
 *
 */

class Login extends Controller
{
}
