<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    
    public function login()
    {
        return view('auth.login');
    }
    public function proses_login(Request $request)
    {
        // Ensure that cookies for username and password are not saved
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
           
            if(Auth::user()->role=='user'){
                return redirect(route(auth()->user()->role.'_dashboard'))->with('success', 'Login successful!')->with('pesan','Selamat datang kembali "'.auth()->user()->name.'"');

            }
            else if(Auth::user()->role=='manager' || Auth::user()->role=='managersenior'||Auth::user()->role=='admin'){ 
                return redirect(route(auth()->user()->role.'_draft'))->with('success', 'Login successful!')->with('pesan','Selamat datang kembali "'.auth()->user()->name.'"');
            }
            else if(Auth::user()->role=='managerit' || Auth::user()->role=='managerseniorit'){ 
                return redirect(route(auth()->user()->role.'_permintaankeseluruhan'))->with('success', 'Login successful!')->with('pesan','Selamat datang kembali "'.auth()->user()->name.'"');
            }
            
        } else {
            return redirect('/')->with('error', 'Invalid username or password.')->with('gagal','Periksa Username dan Password anda');
        }

        return redirect()->back();
    }

    public function register()
    {
        return view('auth.register');
    }
    public function proses_register(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required'
        ]);
        User::create([
            'name' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => 'user'
        ]);
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            if(Auth::user()->role=='manager'){
                return redirect(route(auth()->user()->role.'_draft'))->with('success', 'Registration successful!')->with('pesan','Selamat datang kembali "'.auth()->user()->name.'"');

            }else{

                return redirect(route(auth()->user()->role.'_dashboard'))->with('success', 'Registration successful!')->with('pesan','Selamat datang kembali "'.auth()->user()->name.'"');
            }

        } else {
            return redirect('/')->with('error', 'Registration failed.')->with('gagal','Periksa Username dan Password anda');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Logout successful!');
    }
}
