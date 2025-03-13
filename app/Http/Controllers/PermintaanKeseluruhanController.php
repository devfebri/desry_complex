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
        // dd($request->all());
        $role=auth()->user()->role;
        if($role=='manager'||$role=='managersenior'){
            $draft = Draft::findOrFail($request->draft_id); // Find the draft by ID
            if ($role == 'manager') {
                $draft->approval_manager = $request->setingtable;
                $draft->ket_manager=$request->ket;
                $draft->tanggal_approval_manager=Carbon::now();
            } else if ($role == 'managersenior') {
                $draft->approval_senior_manager = $request->setingtable;
                $draft->ket_sm = $request->ket;
                $draft->tanggal_approval_sm = Carbon::now();
            }
            if ($request->setingtable == 'tidak disetujui') {
                $draft->status = 'tidak disetujui';
            }
            $draft->save(); // Save the changes
        }else{

            $draftpermintaan=DraftPermintaan::where('draft_id',$request->draft_id)->get();
            foreach($draftpermintaan as $row){
                if($request->setingtable!='parsial'){
    
                    $request['app-m-it-'.$row->id]=$request->setingtable;
                }
            }
            // dd($request->all());
            $draft = Draft::find($request->draft_id);
            if(auth()->user()->role=='managerit'){
                if ($request->setingtable == 'disetujui'){
                    $draft->approval_manager_it = 'diproses';
                } else if ($request->setingtable == 'tidak disetujui') {
                    $draft->approval_manager_it = 'tidak disetujui';
                    $draft->status='tidak disetujui';
                }else{
                    $draft->approval_manager_it = 'disetujui';
                }
                $draft->ket_manager_it = $request->ket;
                $draft->tanggal_approval_manager_it = Carbon::now();
                
            }else if(auth()->user()->role=='admin'){
                if ($request->setingtable == 'disetujui'){
                    $draft->approval_teknisi = 'diproses';
                } else if ($request->setingtable == 'tidak disetujui') {
                    $draft->approval_teknisi = 'tidak disetujui';
                    $draft->status='tidak disetujui';
                }else{
                    $draft->approval_teknisi = 'disetujui';
                }
                $draft->ket_teknisi = $request->ket;
                $draft->tanggal_approval_teknisi = Carbon::now();
            }else if(auth()->user()->role=='managerseniorit'){
                $draft->ket_sm_it = $request->ket;
                $draft->tanggal_approval_sm_it = Carbon::now();
                // create add 2 days kecuali hari sabtu dan minggu
                $currentDate = Carbon::now();
                $nextTwoDays = $currentDate->addDay(2);
                while ($nextTwoDays->isWeekend()) {
                    $nextTwoDays->addDay();
                }
                //end
                $draft->approval_senior_manager_it =  $request->setingtable;
                if($request->setingtable=='disetujui'){
                    $draft->status = 'disetujui';
                    $draft->waktu_pengambilan = $nextTwoDays;
                }else{
                    $draft->status = 'tidak disetujui';
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
        }
        
        return redirect()->back()->with('success', 'Approval status updated successfully.');
    }


}
