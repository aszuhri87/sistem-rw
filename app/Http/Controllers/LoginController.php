<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
* @OA\Post(
*     path="/api/login",
*     tags={"Login"},
*     summary="Returns a Sample API response",
*     description="A sample greeting to test out the API",
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
*/


class LoginController extends Controller
{

/**
* @OA\Get(
*     path="/api/logout",
*     tags={"Logout"},
*     summary="Returns a Sample API response",
*     description="A ",
*     operationId="s",
*     security={{"apiAuth": {}}},
*
*     @OA\Response(
*         response="default",
*         description="successful operation"
*     )
* )
*/
}
