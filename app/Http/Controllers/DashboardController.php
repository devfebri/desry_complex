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
        // @if($draft[0])
        // dd($draft->count());
        if($draft->count()!=0){

            $permintaan = db::select("select *,(select count(id) from draft_permintaan dp where dp.draft_id =".$draft[0]->id." and dp.permintaan_id=p.id)as cek from permintaans p");
        }else{

            $permintaan = Permintaan::all();
        }
                    //   dd($permintaan);
                    //   dd($draft[0]);
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
