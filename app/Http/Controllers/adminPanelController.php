<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminPanelController extends Controller
{
    //
    public function index(){
        return view('adminPanel');
    }
}
