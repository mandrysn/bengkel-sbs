<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoTransaksiJasasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('so_transaksi_jasas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('so_transaksi_id')->unsigned()->index();
            $table->enum('kategori_transaksi', ['1'])->default('1'); //1->Jasa
            $table->string('kegiatan', 100);
            $table->integer('quantity');
            $table->double('diskon', 3, 1);
            $table->integer('harga_transaksi');
            $table->string('keterangan_transaksi', 100)->nullable();
            $table->timestamps();

            $table->foreign('so_transaksi_id')
                  ->references('id')
                  ->on('so_transaksis')
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
        Schema::dropIfExists('so_transaksi_jasas');
    }
}
