<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('login.login');

    }

    public function actionLogin(Request $request)
    // artinya Eh Laravel, 
    // ambil data Request dari browser, 
    // terus tolong masukin ke kotak bernama $request ya!

    {
        
         // 1. Satpam validasirequestan
        $credentials = $request->validate([
            
            'email'=> 'required|email',
            'password'=> 'required|min:8',
        ]);
    
        // 2. Cocokkan ke database phpMyAdmin
        if (Auth::attempt($credentials)) {
            // Perbarui kunci keamanan sesi digital
            $request->session()->regenerate();

            
            // Antarkan langsung masuk ke halaman dashboard
            return redirect()->intended('/admin/dashboard');
        }
        
        
        // 3. Jika salah password, tendang balik ke halaman login (Kurung kurawal sudah diperbaiki)
        return back()
            ->withErrors(['email' => 'Incorrect Email or password'])
            ->onlyInput('email');
    }
}