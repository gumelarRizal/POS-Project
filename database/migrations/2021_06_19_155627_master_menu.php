<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mt_barang', function (Blueprint $table) {
            $table->id();
            $table->string('id_barang')->unique();
            $table->integer('id_kategori_barang');
            $table->string('nama_barang');
            $table->integer('harga');
            $table->integer('stok');
            $table->string('satuan');
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
        Schema::dropIfExists('mt_menu');
    }
}
