<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
        // dd($request->all());
        User::create($request->all());
        return redirect()->route(auth()->user()->role.'_user.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $manager=User::where('role','manager')->get();
        $senior=User::where('role','managersenior')->get();
        return view('user.edit', compact('user','manager','senior'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            // 'email' => 'required|email|unique:users,email,' . $user->email,
            'password' => 'nullable',
        ]);
        // dd($request->all());
        
        $user->update($request->all());
        return redirect()->route(auth()->user()->role.'_user.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route(auth()->user()->role.'_user.index')->with('success', 'User deleted successfully.');
    }
}
