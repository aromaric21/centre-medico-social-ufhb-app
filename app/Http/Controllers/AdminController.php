<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    
    

    public function consultation(){
        return view('layouts.admin.consultation');
    }

    public function bilan(){
        return view('layouts.admin.bilan');
    }
    
}
