<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permintaan;
use App\Models\Draft;
use App\Models\DraftPermintaan;
use Illuminate\Support\Facades\DB;
use PDF;


class DashboardController extends Controller
{
    public function index()
    {
        $draft = Draft::where('user_id', auth()->user()->id)
                      ->where('status', 'proses')
                      ->orWhere('status', 'disetujui')
                      ->get();
        if($draft->count()!=0){

            $permintaan = db::select("select *,(select count(id) from draft_permintaan dp where dp.draft_id =".$draft[0]->id." and dp.permintaan_id=p.id)as cek from permintaans p");
        }else{

            $permintaan = Permintaan::all();
        }
        return view('dashboard', compact('permintaan','draft'));
    }
    public function store(Request $request)
    {
        $draft = new Draft();
        $draft->user_id = auth()->user()->id;
        $draft->nama_pemohon = $request->input('nama_pemohon');
        $draft->kontak_pemohon = $request->input('kontak_pemohon');
        $draft->devisi = $request->input('devisi');
        $draft->sub_devisi = $request->input('sub_devisi');
        $draft->save();
        foreach($request->data as $row){
            $permintaan = new DraftPermintaan();
            $permintaan->draft_id = $draft->id;
            $permintaan->permintaan_id = $row['permintaan_id'];
            $permintaan->nama = $row['nama'];
            $permintaan->npp = $row['npp'];
            $permintaan->keterangan = $row['keterangan'];
            $permintaan->save();
        }

        return back()->with('success', 'Draft saved successfully!');
    }
    
    public function previewPdf($id)
    {
        // dd($id);
        $data = Draft::find($id);
        $dp=DraftPermintaan::where('draft_id',$data->id)->get();
        $pdf = PDF::loadView('pdf.draftpreview', compact('data','dp'));
        // $pdf->setPaper('A4', 'landscape');
        $pdf->render();
        return $pdf->stream();
    }

}
