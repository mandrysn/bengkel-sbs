<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChangePartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('change_parts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('so_transaksi_id')->unsigned()->primary('so_transaksi_id');
            $table->string('keterangan_ganti');
            $table->string('montir')->nullable();
            $table->enum('layanan', ['1', '2', '3', '4'])->nullable(); // 1 bongkar pasang, 2 las ketok, 3 dempul, 4 poles
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
        Schema::dropIfExists('change_parts');
    }
}
