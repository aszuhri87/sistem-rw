<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('login');
});

Route::post('/login', function (Request $request) {
    $login = [
        'email' => $request->email,
        'password' => $request->password,
    ];

    $admin = \App\Models\Admin::where([
            'email' => $request->email,
        ])->first();

    if (Auth::attempt($login)) {
        session()->put('admin', $admin);

        return redirect('dashboard');
    } else {
        return \Redirect::back()
            ->withErrors(['message' => 'Login gagal!, periksa email dan password.'])
            ->withInput();
    }

});

Route::get('/logout', function () {
    if (!session()->get('admin')) {
        return redirect('/login');
    }
    session()->flush();

    return redirect('login');
});
