<?php

use Illuminate\Support\Facades\Route;

include base_path("routes/api/login.php");

Route::group(["middleware" => "auth:api"], function () {
    include base_path("routes/api/jimpitan.php");
    include base_path("routes/api/dashboard.php");
});
