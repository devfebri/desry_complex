<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Draft; 
use App\Models\DraftPermintaan;
use Carbon\Carbon;

class PermintaanKeseluruhanController extends Controller
{
    public function index()
    {
        if(auth()->user()->role=='user'){
            $drafts = Draft::where('user_id',auth()->user()->id)->get(); // Fetch all drafts
        }else{
            $drafts = Draft::where('status','proses IT')->orWhere('status','selesai')->orWhere('status','proses SM IT')->orWhere('status','permintaan diproses')->get(); // Fetch all drafts
        }
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
        $role=auth()->user()->role;
       $draftpermintaan=DraftPermintaan::where('draft_id',$request->draft_id)->get();
       foreach($draftpermintaan as $row){
            if($request->setingtable!='parsial'){

                $request['app-m-it-'.$row->id]=$request->setingtable;
            }
        }
        // dd($request->all());
        $draft = Draft::find($request->draft_id);
        if(auth()->user()->role=='managerit'){
            $draft->approval_manager_it = 'selesai';
        }else if(auth()->user()->role=='admin'){
            $draft->approval_teknisi = 'selesai';
        }else if(auth()->user()->role=='managerseniorit'){
            // create add 2 days kecuali hari sabtu dan minggu
            $currentDate = Carbon::now();
            $nextTwoDays = $currentDate->addDay(2);
            while ($nextTwoDays->isWeekend()) {
                $nextTwoDays->addDay();
            }
            //end
            $draft->approval_senior_manager_it =  $request->setingtable;
            $draft->status = 'permintaan diproses';
            if($request->setingtable=='disetujui'){
                $draft->waktu_pengambilan = $nextTwoDays;
            }
        }
        $draft->save();
        
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'app-m-it-') === 0 || strpos($key, 'app-s-it-') === 0) {
                $id = str_replace(['app-m-it-', 'app-s-it-'], '', $key);
                $draftPermintaan = DraftPermintaan::find($id);
                if ($draftPermintaan) {
                    if(auth()->user()->role == 'managerit'){
                        if($value=='disetujui'){
                            $draftPermintaan->approval_manager_it = 'disetujui';
                            
                        }else if($value=='tidak disetujui'){
                            $draftPermintaan->approval_manager_it = 'tidak disetujui';
                            $draftPermintaan->status = 'tidak disetujui';
                        } 
                        if($draftPermintaan->approval_teknisi=='disetujui'){
                            $draft1 = Draft::find($request->draft_id);
                            $draftPermintaan->status = 'disetujui';
                            $draft1->status = 'proses SM IT';
                            $draft1->save();
                        }
                        
                    }else if(auth()->user()->role == 'admin'){
                        if($value=='disetujui'){
                            // dd('ok');
                            $draftPermintaan->approval_teknisi = 'disetujui';
                        }else if($value=='tidak disetujui'){
                            $draftPermintaan->approval_teknisi = 'tidak disetujui';
                            $draftPermintaan->status = 'tidak disetujui';
                        } 
                        if($draftPermintaan->approval_manager_it=='disetujui'){
                            $draft1 = Draft::find($request->draft_id);
                            $draftPermintaan->status = 'disetujui';
                            $draft1->status = 'proses SM IT';
                            $draft1->save();
                        }
                    }
                    // dd($draftPermintaan);
                    $draftPermintaan->save();
                   
                }
                if($draftPermintaan->approval_manager_it != 'proses'&&$draftPermintaan->approval_teknisi != 'proses' ){
                    $draftPermintaan->status = 'disetujui';
                }
                
            }
        }
        
        return redirect()->back()->with('success', 'Approval status updated successfully.');
    }


}
