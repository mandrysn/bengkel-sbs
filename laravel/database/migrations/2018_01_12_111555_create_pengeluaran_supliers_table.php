<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengeluaranSupliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengeluaran_supliers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pengeluaran_id')->unsigned()->index();
            $table->integer('utang_id')->unsigned()->index();
            $table->integer('jumlah_bayar');
            $table->timestamps();

            $table->foreign('pengeluaran_id')
                  ->references('id')
                  ->on('pengeluarans')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('utang_id')
                  ->references('id')
                  ->on('utangs')
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
        Schema::dropIfExists('pengeluaran_supliers');
    }
}
