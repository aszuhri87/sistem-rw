<?php
namespace App\Http\Controllers;

use OpenApi\Annotations as OA;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


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
    */
class Api extends Controller{}

include base_path("routes/api/login.php");

Route::group(["middleware" => "auth:api"], function () {
    include base_path("routes/api/jimpitan.php");
    include base_path("routes/api/dashboard.php");
});
