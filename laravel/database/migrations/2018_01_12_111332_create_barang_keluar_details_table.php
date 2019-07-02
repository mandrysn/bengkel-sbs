<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangKeluarDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_keluar_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('barang_keluar_id')->unsigned()->index();
            $table->integer('bk_quantity');
            $table->integer('harga_transaksi');
            $table->double('diskon', 3, 1);
            $table->string('keterangan_transaksi')->nullable();
            $table->integer('barang_id')->unsigned()->index();
            $table->integer('suplier_id')->unsigned()->index();
            $table->integer('barang_masuk_detail_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('barang_keluar_id')
                  ->references('id')
                  ->on('barang_keluars')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('barang_masuk_detail_id')
                  ->references('id')
                  ->on('barang_masuk_details')
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
        Schema::dropIfExists('barang_keluar_details');
    }
}
