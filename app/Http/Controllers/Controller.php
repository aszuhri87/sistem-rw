<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Annotations as OA;

/**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Sistem RW API Documentation",
     *      description="Sistem RW OpenApi description",
     *      @OA\Contact(
     *          email="achmad.zuhri@varx.id"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      ),
     * @OA\SecurityScheme(
     *     type="http",
     *     description="Login with email and password to get the authentication token",
     *     name="Token based Based",
     *     in="header",
     *     scheme="bearer",
     *     bearerFormat="JWT",
     *     securityScheme="apiAuth",
     * )
     *
     * )
     *
     *
     * @OA\Post(
     *     path="/api/login",
     *     tags={"Auth"},
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
     *
     * @OA\Get(
     *     path="/api/dashboard",
     *     tags={"Dashboard"},
     *     summary="Returns a Sample API response",
     *     description="Dashboard data Jimpitan ",
     *     security={{"passport": {}}},
     *
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     *
     * @OA\Get(
     *     path="/api/logout",
     *     tags={"Auth"},
     *     summary="Returns a Sample API response",
     *     description="A sample greeting to test out the API",
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

     * @OA\Post(
     *     path="/api/jimpitan/tampil",
     *     tags={"Jimpitan"},
     *     summary="Returns a Sample API response",
     *     description="A ",
     *     operationId="s",
     *     security={{"passport": {}}},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="dari",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="ke",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="cari",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="kategori",
     *                     type="string"
     *                 ),
     *                 example={"dari": "2022-12-01", "ke": "2022-12-30", "cari": "", "kategori": "harian"}
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     *
     * @OA\Post(
     *     path="/api/jimpitan/tambah",
     *     tags={"Jimpitan"},
     *     summary="Returns a Sample API response",
     *     description="A ",
     *     security={{"passport": {}}},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="no_kk",
     *                     type="number"
     *                 ),
     *                 @OA\Property(
     *                     property="nominal",
     *                     type="number"
     *                 ),
     *                 @OA\Property(
     *                     property="kategori",
     *                     type="string"
     *                 ),
     *                 example={"no_kk": 3471072108961377, "nominal": 500, "kategori": "harian"}
     *             )
     *         )
     *     ),
     *
     *
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     * @OA\Post(
     *     path="/api/jimpitan/ubah/{id}",
     *     tags={"Jimpitan"},
     *     summary="Returns a Sample API response",
     *     description="ubah data",
     *     security={{"passport": {}}},
     *
     *     @OA\Parameter(
     *         description="Parameter with mutliple examples",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string"),
     *     ),
     *
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="nominal",
     *                     type="number"
     *                 ),
     *                 @OA\Property(
     *                     property="kategori",
     *                     type="string"
     *                 ),
     *                 example={"nominal": 500, "kategori": "harian"}
     *             )
     *         )
     *     ),
     *
     *
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
     * @OA\Get(
     *     path="/api/jimpitan/hapus/{id}",
     *     tags={"Jimpitan"},
     *     summary="Returns a Sample API response",
     *     description="Hapus data Jimpitan ",
     *     security={{"passport": {}}},
     *
     *     @OA\Parameter(
     *         description="Parameter with mutliple examples",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string"),
     *     ),
     *
     *     @OA\Response(
     *         response="default",
     *         description="successful operation"
     *     )
     * )
    */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
