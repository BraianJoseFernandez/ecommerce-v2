<?php

namespace App\Http\Controllers;

use App\Models\Family;
use Illuminate\Http\Request;
use App\Models\Option;

class FamilyController extends Controller
{
    public function show(Family $family)
    {
        
        return view('families.show', compact('family'));
    }
}
