<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomepageController extends Controller
{

//----------------------------------- for navbar  -------------------------------------
    public function showAbout()
    {
        return view('home'); 
    }
    
    public function showServices()
    {
        return view('home'); 
    }
    
    
    
}
