<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get("/login", function () {
    return view("login");
})->name("login");

Route::post("/login", function (Request $request) {
    $login = [
        "email" => $request->email,
        "password" => $request->password,
    ];

    $admin = \App\Models\Admin::where([
        "email" => $request->email,
    ])
        ->whereNull("admin.deleted_at")
        ->first();

    if (Auth::attempt($login)) {
        return redirect("dashboard");
    } else {
        return \Redirect::back()
            ->withErrors([
                "message" =>
                    "Login gagal!, periksa email dan password.",
            ])
            ->withInput();
    }
});

Route::get("/logout", function (Request $request) {
    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect("login");
})->middleware("auth");
