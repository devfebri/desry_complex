<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Draft; // Add this line to import the Draft model

class DraftController extends Controller
{
    public function index()
    {
        $drafts = Draft::all(); // Fetch all drafts
       
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
        $draft->status='proses IT';
        $draft->save(); // Save the changes

        return redirect()->route(auth()->user()->role.'_draft')->with('success', 'Draft berhasil diproses.'); // Redirect back to the draft page
    }
}
