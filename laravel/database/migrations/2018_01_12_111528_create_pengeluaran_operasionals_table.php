<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengeluaranOperasionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengeluaran_operasionals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pengeluaran_id')->unsigned()->index();
            $table->integer('operasional_id')->unsigned()->index();
            $table->integer('jumlah_bayar');
            $table->timestamps();

            $table->foreign('pengeluaran_id')
                  ->references('id')
                  ->on('pengeluarans')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('operasional_id')
                  ->references('id')
                  ->on('operasionals')
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
        Schema::dropIfExists('pengeluaran_operasionals');
    }
}
