<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoTransaksiBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_transaksi_barangs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('so_transaksi_barang_id')->unsigned()->index();
            $table->integer('po_transaksi_id')->unsigned()->index();
            $table->integer('po_quantity');
            $table->double('diskon', 3, 1);
            $table->integer('barang_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('po_transaksi_id')
                  ->references('id')
                  ->on('po_transaksis')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('so_transaksi_barang_id')
                  ->references('id')
                  ->on('so_transaksi_barangs')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
                  
            $table->foreign('barang_id')
                  ->references('id')
                  ->on('barangs')
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
        Schema::dropIfExists('po_transaksi_barangs');
    }
}
