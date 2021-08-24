<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BiodataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $titleBreadcrump = 'Profile';
        return view('Profile', compact('titleBreadcrump'));
    }
}
