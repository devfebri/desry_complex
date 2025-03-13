<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Draft; // Add this line to import the Draft model
use Carbon\Carbon;
class DraftController extends Controller
{
    public function index()
    {
        $drafts = Draft::all(); // Fetch all drafts
        if (auth()->user()->role == 'user') {
            $drafts = Draft::where('user_id', auth()->user()->id)->orderBy('status','desc')->get(); // Fetch all drafts
        } else if(auth()->user()->role == 'admin'||auth()->user()->role=='managerit') {
            $drafts = Draft::where('tanggal_submit','!=','null')->orderBy('status', 'desc')->get(); // Fetch all drafts
        } else if (auth()->user()->role == 'managerseniorit' ) {
            $drafts = Draft::where('approval_teknisi', 'disetujui')->where('approval_manager_it','disetujui')->orderBy('status', 'desc')->get();
        } else if(auth()->user()->role == 'manager'||auth()->user()->role=='manager_senior') {
            $drafts = Draft::orderBy('status','desc')->get();
        } 
        return view('draft', compact('drafts')); // Pass drafts to the view
    }
    public function disetujui($id)
    {
        // dd($id);
        $draft = Draft::findOrFail($id); // Find the draft by ID
        if(auth()->user()->role == 'manager'){
            $draft->approval_manager='disetujui';
            if($draft->approval_senior_manager == 'disetujui'){
                $draft->status='disetujui';
            }
        }else if(auth()->user()->role == 'managersenior'){
            $draft->approval_senior_manager='disetujui';
            if($draft->approval_manager == 'disetujui'){
                $draft->status='disetujui';
            }
        }
        $draft->save(); // Save the changes

        return redirect()->route(auth()->user()->role.'_draft')->with('success', 'Draft berhasil disetujui.'); // Redirect back to the draft page
    }
    public function tidakdisetujui($id)
    {
        $draft = Draft::findOrFail($id); // Find the draft by ID
         if(auth()->user()->role == 'manager'){
            $draft->approval_manager='tidak disetujui';
        }else if(auth()->user()->role == 'managersenior'){
            $draft->approval_senior_manager='tidak disetujui';
        }
        $draft->status='tidak disetujui';
        $draft->save(); // Save the changes

        return redirect()->route(auth()->user()->role.'_draft')->with('success', 'Draft tidak disetujui.'); // Redirect back to the draft page
    }

    public function prosesit($id)
    {
        $draft = Draft::findOrFail($id); // Find the draft by ID
        $draft->tanggal_submit=Carbon::now();
        $draft->save(); // Save the changes

        return redirect()->route(auth()->user()->role.'_draft')->with('success', 'Draft berhasil diproses.'); // Redirect back to the draft page
    }

    public function draft_disetujui($id){
        $draft = Draft::findOrFail($id); // Find the draft by ID
        $draft->status = 'selesai';
        $draft->tanggal_diambil = Carbon::now();
        $draft->save(); // Save the changes
        return redirect()->route(auth()->user()->role . '_draft')->with('success', 'Draft berhasil diselesaikan.'); // Redirect back to the draft page

    }
}
