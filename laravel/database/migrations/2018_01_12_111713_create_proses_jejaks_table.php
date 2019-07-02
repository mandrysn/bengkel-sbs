<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProsesJejaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proses_jejaks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('so_transaksi_id')->unsigned()->index();
            $table->string('foto_proses')->nullable();
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
        Schema::dropIfExists('proses_jejaks');
    }
}
