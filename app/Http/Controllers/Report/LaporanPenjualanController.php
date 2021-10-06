<?php

namespace App\Http\Controllers\Report;

use App\Models\User;
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
        $cashier = DB::table('users')->select('id','name')->get();
        return view('Report.LapPenj',compact('titleBreadcrump','cashier'));
    }
    public function CheckoutPesanan(Request $request){
        $yearMonth = str_replace('-','',$request->tanggalCust);
        $where = '1=1';

        if($request->tanggalCust != null){
            $where = '1=1 and date_format(tr_checkout.tgl_transaksi,"%Y%m") = '.$yearMonth.'';
        }
        if($request->nama_kategori_barang != null){
            $where = '1=1 and tr_checkout.id_checkout like '.$request->nama_kategori_barang.'';
        }
        if($request->nama_kategori_barang != null && $request->tanggalCust != null){
            $where = '1=1 and tr_checkout.id_checkout like '.$request->nama_kategori_barang.' and date_format(tr_checkout.tgl_transaksi,"%Y%m") = '.$yearMonth.'';
        }

        $listDataHeader = DB::table('tr_checkout')
                            ->select(DB::raw('tr_checkout.id_checkout , tr_checkout.total, users.name ,tr_checkout.tgl_transaksi'))
                            ->join('users','tr_checkout.id_user', '=', 'users.id')
                            ->whereRaw($where)
                            ->orderByRaw('tr_checkout.tgl_transaksi DESC')
                            ->get();
        $html = view('Report.LapCheck',compact('listDataHeader'));
        return $html;
    }
    public function CustomPesanan(Request $request){
        $yearMonth = str_replace('-','',$request->tanggalCust);
        $where = '1=1';

        if($request->tanggalCust != null){
            $where = '1=1 and date_format(tr_custompesanan.tgl_transaksi,"%Y%m") = '.$yearMonth.'';
        }
        if($request->nama_kategori_barang != null){
            $where = '1=1 and tr_custompesanan.id_customPesanan like '.$request->nama_kategori_barang.'';
        }
        if($request->nama_kategori_barang != null && $request->tanggalCust != null){
            $where = '1=1 and tr_custompesanan.id_customPesanan = '.$request->nama_kategori_barang.' and date_format(tr_custompesanan.tgl_transaksi,"%Y%m") = '.$yearMonth.'';
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
                            ->whereRaw($where)
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
