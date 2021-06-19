<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ulData = DB::table('mt_system')
                    ->select('SYSTEM_VALUE')
                    ->distinct()
                    ->where('SYSTEM_CD','like','MENU%')
                    ->get();
        return view('home');
    }
}
