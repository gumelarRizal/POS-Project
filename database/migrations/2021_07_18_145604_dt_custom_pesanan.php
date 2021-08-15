<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DtCustomPesanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dt_customPesanan',function(Blueprint $table){
            $table->increments('id');
            $table->string('id_dt_customPesanan',20)->unique();
            $table->string('id_checkout',20);
            $table->string('id_barang',20);
            $table->string('id_jasa',20);
            $table->string('id_kategori_barang',20);
            $table->string('deskripsi',200);
            $table->integer('harga_barang');
            $table->integer('harga_jasa');
            $table->integer('subtotal');
            $table->integer('discount');
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
        Schema::dropIfExists('dt_customPesanan');
    }
}
