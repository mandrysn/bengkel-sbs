<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoTransaksiBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('so_transaksi_barangs', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('so_transaksi_id')->unsigned()->index();
            $table->integer('barang_id')->unsigned()->index();
            $table->enum('kategori_transaksi', ['1', '2', '3'])->default('2'); //1->Jasa, 2->Spare Part, 3->Material
            $table->integer('quantity');
            $table->integer('quantity_po');
            $table->integer('harga_transaksi');
            $table->string('keterangan_transaksi')->nullable();
            $table->timestamps();

            $table->foreign('so_transaksi_id')
                  ->references('id')
                  ->on('so_transaksis')
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
        Schema::dropIfExists('so_transaksi_barangs');
    }
}
