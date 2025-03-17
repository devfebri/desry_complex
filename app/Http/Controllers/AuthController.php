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
    // public function username()
    // {
    //     return 'username';
    // }
    public function proses_login(Request $request){
        
        $credentials = [
            'uid' => $request->username,
            'password' => $request->password,
            'fallback' => [
                'username' => $request->username,
                'password' => $request->password,
            ],
        ];
        // return 'username';
        if (Auth::attempt($credentials)) {
            // dd('ok');
            return redirect('/home')->with('gagal', 'Periksa Username dan Password anda');
        
            // return redirect(route(auth()->user()->role . '_permohonan'))->with('pesan', 'Selamat datang kembali "' . auth()->user()->name . '"');
        } else {
            return redirect('/')->with('gagal', 'Periksa Username dan Password anda');
        }
        return redirect()->back();
    }

    public function proses_logins(Request $request)
    {
       
        $credentialsDefault = [
            'username' => $request->username,
            'password' => $request->password,
        ];
        
        $defaultss = $this->loginDefault($credentialsDefault);
       if ($defaultss == 'ok') {
            if (Auth::user()->role == 'user') {
                return redirect(route(auth()->user()->role . '_dashboard'))->with('pesan', 'Selamat datang kembali "' . auth()->user()->name . '"');
            } else if (Auth::user()->role == 'manager' || Auth::user()->role == 'managersenior' || Auth::user()->role == 'admin'|| Auth::user()->role == 'managerit' || Auth::user()->role == 'managerseniorit') {
                return redirect(route(auth()->user()->role . '_draft'))->with('pesan', 'Selamat datang kembali "' . auth()->user()->name . '"');
            
            }
        } else  {
            $credentialsLdap = [
                'uid' => $request->username,
                'password' => $request->password,
            ];
            $ldap = $this->loginLdap($credentialsLdap);
            // dd($ldap);
            if($ldap=='ok'){

                $groups = $this->getGroups(auth()->user()->username);
                if (Auth::user()->role == 'user') {
                    return redirect(route(auth()->user()->role . '_dashboard'))->with('pesan', 'Selamat datang kembali "' . auth()->user()->name . '"');
                } else if (Auth::user()->role == 'manager' || Auth::user()->role == 'managersenior' || Auth::user()->role == 'admin'|| Auth::user()->role == 'managerit' || Auth::user()->role == 'managerseniorit') {
                    return redirect(route(auth()->user()->role . '_draft'))->with('pesan', 'Selamat datang kembali "' . auth()->user()->name . '"');
                
                } else if (Auth::user()->role == null) {
                    DB::table('users')
                        ->where('username', auth()->user()->username)
                        ->update(['role' => $groups]);
                    if ($groups == 'admin' || $groups == 'manager' || $groups == 'managersenior') {
                        $url = Route($groups . '_draft');
                    } else if ($groups == 'managerseniorit' || $groups == 'managerit') {
                        $url = Route($groups . '_permintaankeseluruhan');
                    } else {
                        $url = Route($groups . '_dashboard');
                    }
                    return redirect($url)->with('pesan', 'Selamat datang kembali "' . auth()->user()->name . '"');
                }
            }else{
                return redirect()->back()->with('error', 'Login failed.');
            }
        } 
    }

    private function loginLdap($credentialsLdap)
    {
        //sementara belum fix kalau dia diluar kantor
        return ('false');
        //end


        Auth::shouldUse('usersldap');
        if (Auth::attempt($credentialsLdap)) {
            return ('ok');
        } else {
            return ('false');
        }

        // Auth::shouldUse('usersldap');
        // try {
        //     if (Auth::attempt($credentialsLdap)) {
        //         return ('ok');
        //     } else {
        //         return ('false');
        //     }
        // } catch (\Exception $e) {
        //     // Log the error or handle it as needed
        //     return ('error');
        // }
    }
    private function loginDefault($credentialsDefault)
    {
        Auth::shouldUse('usersdefault');
        if (Auth::attempt($credentialsDefault)) {
            return ('ok');
        } else {
            return ('false');
        }
    }
    private function getGroups($username)
    {
        $connectionAdmin = new Connection([
            'hosts' => [env('LDAP_HOST')],
            'port' => env('LDAP_PORT'),
            'base_dn' => 'cn=Domain Admins,cn=groups,dc=pamjaya,dc=co,dc=id',
            'username' => env('LDAP_USERNAME'),
            'password' => env('LDAP_PASSWORD'),
        ]);

        $connectionManagerSeniorIT = new Connection([
            'hosts' => [env('LDAP_HOST')],
            'port' => env('LDAP_PORT'),
            'base_dn' => 'cn=Manager Senior IT,cn=groups,dc=pamjaya,dc=co,dc=id',
            'username' => env('LDAP_USERNAME'),
            'password' => env('LDAP_PASSWORD'),
        ]);
        $connectionManagerIT = new Connection([
            'hosts' => [env('LDAP_HOST')],
            'port' => env('LDAP_PORT'),
            'base_dn' => 'cn=Manager IT,cn=groups,dc=pamjaya,dc=co,dc=id',
            'username' => env('LDAP_USERNAME'),
            'password' => env('LDAP_PASSWORD'),
        ]);
        $connectionManagerSenior = new Connection([
            'hosts' => [env('LDAP_HOST')],
            'port' => env('LDAP_PORT'),
            'base_dn' => 'cn=groups,dc=pamjaya,dc=co,dc=id',
            'username' => env('LDAP_USERNAME'),
            'password' => env('LDAP_PASSWORD'),
        ]);
        $connectionManager = new Connection([
            'hosts' => [env('LDAP_HOST')],
            'port' => env('LDAP_PORT'),
            'base_dn' => 'cn=Manager,cn=groups,dc=pamjaya,dc=co,dc=id',
            'username' => env('LDAP_USERNAME'),
            'password' => env('LDAP_PASSWORD'),
        ]);
        $connectionUser = new Connection([
            'hosts' => [env('LDAP_HOST')],
            'port' => env('LDAP_PORT'),
            'base_dn' => 'cn=Domain Users,cn=groups,dc=pamjaya,dc=co,dc=id',
            'username' => env('LDAP_USERNAME'),
            'password' => env('LDAP_PASSWORD'),
        ]);
        $admin = $connectionAdmin->query()->where('memberUid', '=', $username)
            ->first();
        $managerit = $connectionManagerIT->query()
            ->where('memberUid', '=', $username)
            ->first();
        $managerseniorit = $connectionManagerSeniorIT->query()
            ->where('memberUid', '=', $username)
            ->first();
        $managersenior = $connectionManagerSenior->query()
            ->where('memberUid', '=', $username)
            ->whereIn('cn', [
                'Senior',
                'SM Bina Program',
                'SM INVESTASI',
                'SM TEKNIK DAN PELAYANAN',
                'SM ADMINISTRASI UMUM',
                'SM KEUANGAN DAN AKUTANSI',
                'SM PENGAWAS SATUAN INTERN',
                'ITPAM'
            ])
            ->get();
        $manager = $connectionManager->query()
            ->where('memberUid', '=', $username)
            ->first();
        $user = $connectionUser->query()
            ->where('memberUid', '=', $username)
            ->first();
        // dd($managersenior);
        if ($admin) {
            return 'admin';
        } else if ($managerseniorit) {
            return 'managerseniorit';
        } else if ($managerit) {
            return 'managerit';
        } else if ($managersenior) {
            return 'managersenior';
        } else if ($manager) {
            return 'manager';
        } else if ($user) {
            return 'user';
        }
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
