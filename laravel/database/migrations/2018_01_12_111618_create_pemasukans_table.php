<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePemasukansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemasukans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tagihan_id')->unsigned()->index();
            $table->string('no_transaksi');
            $table->string('keterangan')->nullable();
            $table->integer('jumlah_bayar');
            $table->date('tanggal_masuk');
            $table->timestamps();


            $table->foreign('tagihan_id')
                  ->references('id')
                  ->on('tagihans')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemasukans');
    }
}
