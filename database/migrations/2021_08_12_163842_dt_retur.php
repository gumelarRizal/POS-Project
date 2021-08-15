<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DtRetur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dt_retur',function(Blueprint $table){
            $table->increments('id');
            $table->string('id_dt_retur',20)->unique();
            $table->string('id_retur',20);
            $table->string('id_barang',20);
            $table->integer('harga_barang');
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
        Schema::dropIfExists('dt_retur');
    }
}
