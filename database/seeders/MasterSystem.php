<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'SYSTEM_CD' => 'MENU_ADMIN',
                'SYSTEM_VALUE' => 'MASTER DATA',
                'CHILD_VALUE' => 'COA',
                'CHILD_TEXT' => 'COA.index'
            ],
            'VAL2' => [
                'SYSTEM_CD' => 'MENU_ADMIN',
                'SYSTEM_VALUE' => 'TRANSAKSI',
                'CHILD_VALUE' => 'Penggajian',
                'CHILD_TEXT' => 'COA.index'
            ],
            'VAL3' => [
                'SYSTEM_CD' => 'MENU_ADMIN',
                'SYSTEM_VALUE' => 'LAPORAN',
                'CHILD_VALUE' => 'Jurnal Umum',
                'CHILD_TEXT' => 'COA.index'
            ],
            'VAL4' => [
                'SYSTEM_CD' => 'MENU_ADMIN',
                'SYSTEM_VALUE' => 'MASTER DATA',
                'CHILD_VALUE' => 'Pegawai',
                'CHILD_TEXT' => 'Pegawai.index'
            ],
            'VAL5' => [
                'SYSTEM_CD' => 'MENU_ADMIN',
                'SYSTEM_VALUE' => 'MASTER DATA',
                'CHILD_VALUE' => 'Menu',
                'CHILD_TEXT' => 'Menu.index'
            ],
            'VAL6' => [
                'SYSTEM_CD' => 'MENU_ADMIN',
                'SYSTEM_VALUE' => 'TRANSAKSI',
                'CHILD_VALUE' => 'Check Out Pesanan',
                'CHILD_TEXT' => 'Checkout.index'
            ],
            'VAL7' => [
                'SYSTEM_CD' => 'MENU_ADMIN',
                'SYSTEM_VALUE' => 'LAPORAN',
                'CHILD_VALUE' => 'Buku Besar',
                'CHILD_TEXT' => 'COA.index'
            ],
            'VAL7' => [
                'SYSTEM_CD' => 'MENU_ADMIN',
                'SYSTEM_VALUE' => 'LAPORAN',
                'CHILD_VALUE' => 'Laporan Pesanan',
                'CHILD_TEXT' => 'COA.index'
            ],
        ];

        foreach ($listData as $list) {
            // dd($list);
            DB::table('mt_system')->insert([
                'SYSTEM_CD' => $list['SYSTEM_CD'],
                'SYSTEM_VALUE' => $list['SYSTEM_VALUE'],
                'CHILD_VALUE' => $list['CHILD_VALUE'],
                'CHILD_TEXT' => $list['CHILD_TEXT'],
                'CREATED_BY' => 'RIZAL',
                'created_at' => date('Y-m-d h:i:s')
            ]);
        }
    }
}
