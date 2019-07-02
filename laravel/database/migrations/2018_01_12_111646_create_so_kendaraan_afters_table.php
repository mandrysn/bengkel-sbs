<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoKendaraanAftersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('so_kendaraan_afters', function (Blueprint $table) {
            $table->integer('so_transaksi_id')->unsigned()->primary('so_transaksi_id');
            $table->string('foto_depan')->nullable();
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
        Schema::dropIfExists('so_kendaraan_afters');
    }
}
