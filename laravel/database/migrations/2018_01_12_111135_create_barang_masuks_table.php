<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangMasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_masuks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('po_transaksi_id')->unsigned()->index();
            $table->string('bbm_transaksi', 150);
            $table->date('tanggal_masuk');
            $table->timestamps();

            $table->foreign('po_transaksi_id')
                  ->references('id')
                  ->on('po_transaksis')
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
        Schema::dropIfExists('barang_masuks');
    }
}
