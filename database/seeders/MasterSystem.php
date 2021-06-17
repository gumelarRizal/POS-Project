<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MasterSystem extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listData = [
            'val1' => [
                'SYSTEM_CD'=>'MENU_ADMIN',
                'SYSTEM_VALUE'=>'MASTER DATA',
                'CHILD_VALUE' => 'COA'
            ],
            'VAL2' => [
                'SYSTEM_CD'=>'MENU_ADMIN',
                'SYSTEM_VALUE'=>'TRANSAKSI',
                'CHILD_VALUE' => 'Penggajian'
            ],
            'VAL3' => [
                'SYSTEM_CD'=>'MENU_ADMIN',
                'SYSTEM_VALUE'=>'LAPORAN',
                'CHILD_VALUE' => 'Jurnal Umum'
            ],
            'VAL4' => [
                'SYSTEM_CD'=>'MENU_ADMIN',
                'SYSTEM_VALUE'=>'MASTER DATA',
                'CHILD_VALUE' => 'Pegawai'
            ],
            'VAL5' => [
                'SYSTEM_CD'=>'MENU_ADMIN',
                'SYSTEM_VALUE'=>'MASTER DATA',
                'CHILD_VALUE' => 'Menu'
            ],
            'VAL6' => [
                'SYSTEM_CD'=>'MENU_ADMIN',
                'SYSTEM_VALUE'=>'TRANSAKSI',
                'CHILD_VALUE' => 'Check Out Pesanan'
            ],
            'VAL7' => [
                'SYSTEM_CD'=>'MENU_ADMIN',
                'SYSTEM_VALUE'=>'LAPORAN',
                'CHILD_VALUE' => 'Buku Besar'
            ],
            'VAL7' => [
                'SYSTEM_CD'=>'MENU_ADMIN',
                'SYSTEM_VALUE'=>'LAPORAN',
                'CHILD_VALUE' => 'Laporan Pesanan'
            ],
        ];
        foreach($listData as $list){
            DB::table('mt_system')->insert([
                'SYSTEM_CD' => $list['SYSTEM_CD'],
                'SYSTEM_VALUE' => $list['SYSTEM_VALUE'],
                'CHILD_VALUE' => $list['CHILD_VALUE'],
                'CREATED_BY' => 'RIZAL',
                'created_at' => date('Y-m-d h:i:s')
            ]);
        }
    }
}
