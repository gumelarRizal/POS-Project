<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LaporanPenjualanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $titleBreadcrump = 'Laporan Penjualan';
        return view('Report.LapPenj',compact('titleBreadcrump'));
    }
    public function CheckoutPesanan(){

    }
    public function CustomPesanan(Request $request){
        $year = date('Y');
        $month = date('m');
        if($request->tanggal){
            $year = substr($request->tanggal,0,4);
            $month = substr($request->tanggal,5,2);
        }
        $listDataHeader = DB::table('tr_custompesanan')
                            ->select(DB::raw('tr_custompesanan.id_customPesanan , 
                                            mt_pelanggan.nama_pelanggan , 
                                            tr_custompesanan.jumlahByr ,
                                            tr_custompesanan.total ,
                                            tr_custompesanan.tgl_transaksi ,
                                            if(tr_custompesanan.status = 0,"Lunas","Belum Lunas") Status,
                                            users.name as Cashier'))
                            ->join('mt_pelanggan','tr_custompesanan.id_pelanggan', '=', 'mt_pelanggan.id_pelanggan')
                            ->join('users','tr_custompesanan.id_user', '=', 'users.id')
                            ->whereRaw('date_format(tr_custompesanan.tgl_transaksi,"%m") = '.$month.' and date_format(tr_custompesanan.tgl_transaksi,"%Y") = '.$year.'')
                            ->orderByRaw('tr_custompesanan.tgl_transaksi DESC')
                            ->get();
        $html = view('Report.LapCust',compact('listDataHeader'));
        return $html;
    }

    public function detailCustomPesanan(){
        $listDataDetailHeader = DB::table('tr_custompesanan')
                            ->select(DB::raw('tr_custompesanan.id_customPesanan , 
                                            tr_custompesanan.jumlahByr , 
                                            tr_custompesanan.total , 
                                            tr_custompesanan.status,
                                            mt_pelanggan.nama_pelanggan , 
                                            mt_pelanggan.alamat , 
                                            mt_pelanggan.email '))
                            ->join('mt_pelanggan','tr_custompesanan.id_pelanggan','=','mt_pelanggan.id_pelanggan')
                            ->where('tr_custompesanan.id_customPesanan',function($query){
                                $query->select(DB::raw('id_customPesanan from tr_custompesanan order by id DESC Limit 1'));
                            })->first();
        return $listDataDetailHeader;
    }
    public function labaRugi(){
        return view('Report.LaporanLabaRugi');
    }
}
