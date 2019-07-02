<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagihansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tagihans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_tagihan');
            $table->date('tanggal_masuk');
            $table->integer('so_transaksi_id')->unsigned()->index();
            $table->double('diskon', 3, 1);
            $table->integer('tagihan');
            $table->integer('pajak');
            $table->integer('jumlah_or');
            $table->text('keterangan_tagihan')->nullable();
            $table->enum('status_pekerjaan', ['1', '2'])->default('1'); //1->Proses, 2->Selesai
            $table->enum('status_tagihan', ['1', '2'])->default('1'); //1->Proses, 2->Selesai
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
        Schema::dropIfExists('tagihans');
    }
}
