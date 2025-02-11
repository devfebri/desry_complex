<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    
    public function login()
    {
        // MessageCreated::dispatch('Mntulll');
        // event(new MessageCreated);
        return view('auth.login');
    }
    public function proses_login(Request $request)
    {
        if($request->remember===null){
            setcookie('username',$request->username,100);
            setcookie('password',$request->password,100);
        }else{
            // dd('ok');
            setcookie('username',$request->username,time()+60*60*24*100);
            setcookie('password',$request->password,time()+60*60*24*100);
        }
        // dd($request->all());


        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
        //    dd('ok');
           
            if(Auth::user()->role=='manager'){
                return redirect(route(auth()->user()->role.'_draft'))->with('pesan','Selamat datang kembali "'.auth()->user()->name.'"');

            }else{

                return redirect(route(auth()->user()->role.'_dashboard'))->with('pesan','Selamat datang kembali "'.auth()->user()->name.'"');
            }
        } else {
            return redirect('/')->with('gagal','Periksa Username dan Password anda');
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
        //    dd('ok');
            if(Auth::user()->role=='manager'){
                return redirect(route(auth()->user()->role.'_draft'))->with('pesan','Selamat datang kembali "'.auth()->user()->name.'"');

            }else{

                return redirect(route(auth()->user()->role.'_dashboard'))->with('pesan','Selamat datang kembali "'.auth()->user()->name.'"');
            }

        } else {
            return redirect('/')->with('gagal','Periksa Username dan Password anda');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
