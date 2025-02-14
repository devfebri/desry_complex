<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permintaan;
use App\Models\Draft;
use App\Models\DraftPermintaan;

class DashboardController extends Controller
{
    public function index()
    {
        $draft = Draft::where('user_id', auth()->user()->id)
                      ->where('status', 'proses')
                      ->orWhere('status', 'disetujui')
                      ->get();
                    //   dd($draft[0]);
        // dd($draft);
        $permintaan = Permintaan::all();
        return view('dashboard', compact('permintaan','draft'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $draft = new Draft();
        $draft->user_id = auth()->user()->id;
        $draft->npp = $request->input('npp');
        $draft->nama = $request->input('nama');
        $draft->devisi = $request->input('devisi');
        $draft->sub_devisi = $request->input('sub_devisi');
        $draft->keterangan = $request->input('keterangan');
        $draft->save();
        foreach($request->input('permintaan') as $row){
            $permintaan = new DraftPermintaan();
            $permintaan->draft_id = $draft->id;
            $permintaan->permintaan_id = $row;
            $permintaan->save();
        }

        return back()->with('success', 'Draft saved successfully!');
    }
}
