<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TrCustomPesanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_customPesanan',function(Blueprint $table){
            $table->increments('id');
            $table->string('id_customPesanan')->unique();
            $table->integer('jumlahByr');
            $table->integer('total');
            $table->integer('id_user');
            $table->char('status',1);
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
        Schema::dropIfExists('tr_customPesanan');
    }
}
