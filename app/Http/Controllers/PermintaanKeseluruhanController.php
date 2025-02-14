<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Draft; 
use App\Models\DraftPermintaan; 

class PermintaanKeseluruhanController extends Controller
{
    public function index()
    {
         $drafts = Draft::all(); // Fetch all drafts
        return view('permintaankeseluruhan',compact('drafts'));
    }
    public function detail($id)
    {
         $data = Draft::find($id); // Fetch all drafts
         $drafts=DraftPermintaan::where('draft_id',$id)->get();
        return view('permintaankeseluruhan_detail',compact('data','drafts'));
    }
    public function submit(Request $request)
    {
        // dd($request->all());
        $data=Draft::find($request->draft_id);
        if(auth()->user()->role=='managerit'){
            $data->approval_manager_it='selesai';
        }else if(auth()->user()->role=='managerseniorit'){
            $data->approval_senior_manager_it='selesai';
        }
        $data->save();
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'app-m-it-') === 0 || strpos($key, 'app-s-it-') === 0) {
                $id = str_replace(['app-m-it-', 'app-s-it-'], '', $key);
                $draftPermintaan = DraftPermintaan::find($id);
                if ($draftPermintaan) {
                    if(auth()->user()->role == 'managerit'){
                        if($value=='disetujui'){
                            $draftPermintaan->approval_manager_it = 'disetujui';
                            if($draftPermintaan->approval_senior_manager_it!='proses'){
                                $draftPermintaan->status = 'disetujui';
                            }
                        }else if($value=='tidak disetujui'){
                            $draftPermintaan->approval_manager_it = 'tidak disetujui';
                            if($draftPermintaan->approval_senior_manager_it=='tidak disetujui'){
                                $draftPermintaan->status = 'tidak disetujui';
                            }else{
                                $draftPermintaan->status = 'disetujui';
                            }
                        } 
                        
                    }else if(auth()->user()->role == 'managerseniorit'){
                        // dd($draftPermintaan);
                        if($value=='disetujui'){
                            $draftPermintaan->approval_senior_manager_it = 'disetujui';
                            if($draftPermintaan->approval_manager_it!='proses'){
                                $draftPermintaan->status = 'disetujui';
                            }
                        }else if($value=='tidak disetujui'){
                            $draftPermintaan->approval_senior_manager_it = 'tidak disetujui';
                            if($draftPermintaan->approval_manager_it=='tidak disetujui'){
                                $draftPermintaan->status = 'tidak disetujui';
                            }else{
                                $draftPermintaan->status = 'disetujui';
                            }
                        } 
                    }
                    $draftPermintaan->save();
                    $ss =Draft::find($request->draft_id);
                    if($ss->approval_manager_it != 'proses'&&$ss->approval_senior_manager_it != 'proses' ){
                        $ss->status = 'selesai';
                        $ss->save();
                    }
                    
                }
            }
        }
        return redirect()->back()->with('success', 'Approval status updated successfully.');
    }

}
