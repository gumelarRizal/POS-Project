<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LabaRugiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        return view('Report.LaporanLabaRugi');
    }
    public function read(){
        $yearMonth = date('Ym');
        $totalChck = DB::table('tr_checkout')
                    ->select(DB::raw('sum(total) Nominal'))
                    ->whereRaw('date_format(tgl_transaksi,"%Y%m") ='.$yearMonth.'')
                    ->first();
        $totalCustom = DB::table('tr_custompesanan')
                    ->select(DB::raw('sum(total) Nominal'))
                    ->whereRaw('date_format(tgl_transaksi,"%Y%m") ='.$yearMonth.'')
                    ->first();
        $totalPenjualan = $totalChck->Nominal + $totalCustom->Nominal;
        $totalRetur = DB::table('tr_retur')
                    ->select(DB::raw('sum(total) Nominal'))
                    ->whereRaw('date_format(tgl_transaksi,"%Y%m") ='.$yearMonth.'')
                    ->first();
        $totalPengeluaran = DB::table('tr_pengeluaranKas')
                    ->select(DB::raw('sum(total) Nominal'))
                    ->whereRaw('date_format(tgl_transaksi,"%Y%m") ='.$yearMonth.'')
                    ->first();
        $HPP = DB::table('dt_checkout')
                ->select(DB::raw('(sum(mt_barang.harga * dt_checkout.qty) + IFNULL((select sum(mb.harga * dc.qty) SubtotalHppCustom
                                from tr_custompesanan tc 
                                join dt_custompesanan dc 
                                    on tc.id_customPesanan = dc.id_customPesanan 
                                join mt_barang mb 
                                    on mb.id_barang = dc.id_barang 
                                where date_format(tc.tgl_transaksi,"%Y%m") = '.$yearMonth.'),0)) total'))
                ->join('tr_checkout','tr_checkout.id_checkout','=','dt_checkout.id_checkout')
                ->join('mt_barang','dt_checkout.id_barang','=','mt_barang.id_barang')
                ->first();
        $listPengeluaranKas = DB::select('
                    select tp.id_pengeluaranKas ,mc.nama_coa ,subtotal 
                    from tr_pengeluarankas tp 
                    join dt_pengeluarankas dp 
                        on tp.id_pengeluaranKas = dp.id_pengeluaranKas 
                    join mt_coa mc 
                        on dp.id_coa = mc.id_coa 
                    where date_format(tgl_transaksi,"%Y%m") = '.$yearMonth.'');
        return view('Report.LaporanLabaRugiRead',compact('totalPenjualan','totalRetur','totalPengeluaran','listPengeluaranKas','yearMonth','HPP'));

        
    }
}
