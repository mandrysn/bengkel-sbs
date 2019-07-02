<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangMasukDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_masuk_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('po_transaksi_barang_id')->unsigned()->index();
            $table->integer('barang_masuk_id')->unsigned()->index();
            $table->integer('bm_quantity');
            $table->integer('quantity');
            $table->integer('harga_transaksi');
            $table->double('diskon', 3, 1);
            $table->string('keterangan_transaksi')->nullable();
            $table->integer('barang_id')->unsigned()->index();
            $table->integer('suplier_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('barang_masuk_id')
                  ->references('id')
                  ->on('barang_masuks')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('po_transaksi_barang_id')
                  ->references('id')
                  ->on('po_transaksi_barangs')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('barang_id')
                  ->references('id')
                  ->on('barangs')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('suplier_id')
                  ->references('id')
                  ->on('supliers')
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
        Schema::dropIfExists('barang_masuk_details');
    }
}
