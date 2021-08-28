<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterData\Menu;
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
        // dd(auth()->user()->hasRole('user'));
        $titleBreadcrump = 'Dashboard';
        $listBarang = Menu::all();
        $totalPendapatan = DB::table('tr_checkout')
                            ->select(DB::raw('(sum(total) + ifnull((select sum(total) from tr_custompesanan),0)) as Total_Pendapatan'))
                            ->first();
        $totalPengeluaran = DB::table('tr_pengeluaranKas')
                            ->select(DB::raw('sum(total) Total_pengeluaran'))
                            ->first();
        $totalStok = DB::table('mt_barang')
                    ->select(DB::raw('sum(stok) total_stok'))
                    ->first();
        return view('home', compact('titleBreadcrump','listBarang','totalPendapatan','totalPengeluaran','totalStok'));
    }
}
