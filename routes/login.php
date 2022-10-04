<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/login', function () { 

    return view('login');
});

Route::post('/login', function (Request $request) {

    
        $admin = \App\Models\Admin::where([
            'email' => $request->email,
            'password' => $request->password,
        ])->first();
    
        if ($admin) {
            session()->put('admin', $admin);
            return redirect('dashboard');
        }else{
            return \Redirect::back()
                ->withErrors(['message' => 'Login gagal!, periksa email dan password.'])
                ->withInput();
        }
    

  
});

Route::get('/logout', function () { 
    if(!session()->get('admin')){
        return redirect('/login');
    }
    session()->flush();
    return redirect('login');
});