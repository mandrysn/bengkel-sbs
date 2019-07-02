<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('so_transaksis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('so_kendaraan_id')->unsigned()->index();
            $table->string('no_transaksi', 100);
            $table->enum('status', ['1', '2'])->default('1'); // 1 Pre SO, 2 SO
            $table->date('tanggal_pre')->nullable();
            $table->date('tanggal_so')->nullable();
            $table->date('tanggal_invoice')->nullable();
            $table->timestamps();

            $table->foreign('so_kendaraan_id')
                  ->references('id')
                  ->on('so_kendaraans')
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
        Schema::dropIfExists('so_transaksis');
    }
}
