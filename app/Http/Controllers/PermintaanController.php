<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permintaan;

class PermintaanController extends Controller
{
    public function index()
    {
        $permintaans = Permintaan::orderBy('id','desc')->get();
        return view('permintaan.index', compact('permintaans'));
    }

    public function create()
    {
        return view('permintaan.create');
    }

    public function store(Request $request)
    {
        $permintaan = new Permintaan();
        $permintaan->nama = $request->nama;
        $permintaan->save();

        return redirect()->route(auth()->user()->role.'_permintaan.index')->with('success', 'Data permintaan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $permintaan = Permintaan::findOrFail($id);
        return view('permintaan.show', compact('permintaan'));
    }

    public function edit($id)
    {
        $permintaan = Permintaan::findOrFail($id);
        return view('permintaan.edit', compact('permintaan'));
    }

    public function update(Request $request, $id)
    {
        $permintaan = Permintaan::findOrFail($id);
        $permintaan->nama = $request->nama;
        $permintaan->save();

        return redirect()->route(auth()->user()->role.'_permintaan.index')->with('success', 'Data permintaan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $permintaan = Permintaan::findOrFail($id);
        $permintaan->delete();

        return redirect()->route(auth()->user()->role.'_permintaan.index')->with('success', 'Data permintaan berhasil dihapus.');
    }

    
}
