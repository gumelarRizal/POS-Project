<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DtPembelian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dt_pembelian',function(Blueprint $table){
            $table->increments('id');
            $table->string('id_dt_pembelian')->unique();
            $table->string('id_pembelian');
            $table->string('id_barang');
            $table->string('id_kategori_barang');
            $table->integer('subtotal');
            $table->integer('qty');
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
        Schema::dropIfExists('dt_pembelian');
    }
}
