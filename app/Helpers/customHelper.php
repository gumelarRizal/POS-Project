<?php 
    function GenerateAutoIncrementCd($table,$id,$string){
        $query1 = DB::table($table,)
                            ->select(DB::raw('RIGHT('.$id.',3) as kode'))
                            ->orderByRaw(''.$id.' DESC')
                            ->limit(1)
                            ->first();
        $query2 = DB::table($table)->count();
        if($query2 <> 0){
            $kode = intval($query1->kode) + 1;
        }else{
            $kode = 1;
        }
        $prakode = str_pad($kode, 3, '0', STR_PAD_LEFT);
        $kodejadi = $string . '-' . $prakode;
        return $kodejadi;
    }
?>