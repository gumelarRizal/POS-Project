<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TrPengeluaranKas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_pengeluaranKas',function(Blueprint $table){
            $table->increments('id');
            $table->string('id_pengeluaranKas')->unique();
            $table->integer('total');
            $table->datetime('tgl_transaksi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tr_pengeluaranKas');
    }
}
