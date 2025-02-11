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
}
