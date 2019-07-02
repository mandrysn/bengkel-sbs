<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuktiKeluarDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bukti_keluar_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bukti_keluar_id')->unsigned()->index();
            $table->integer('bk_quantity');
            $table->integer('harga_transaksi');
            $table->double('diskon', 3, 1);
            $table->string('keterangan_transaksi')->nullable();
            $table->integer('barang_id')->unsigned()->index();
            $table->integer('suplier_id')->unsigned()->index();
            $table->integer('bukti_material_detail_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('bukti_keluar_id')
                  ->references('id')
                  ->on('bukti_keluars')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('bukti_material_detail_id')
                  ->references('id')
                  ->on('bukti_material_details')
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
        Schema::dropIfExists('bukti_keluar_details');
    }
}
