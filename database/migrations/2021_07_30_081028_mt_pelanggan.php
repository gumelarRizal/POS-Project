<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MtPelanggan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mt_pelanggan',function(Blueprint $table){
            $table->increments('id');
            $table->string('id_pelanggan',10)->unique();
            $table->string('nama_pelanggan',30);
            $table->string('alamat',200);
            $table->integer('no_telp',14);
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
        Schema::dropIfExists('mt_pelanggan');
    }
}
