<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('so_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('so_transaksi_id')->unsigned()->index();
            $table->string('keluhan', 150);
            $table->string('perbaikan', 150);
            $table->string('keterangan', 150)->nullable();
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
        Schema::dropIfExists('so_details');
    }
}
