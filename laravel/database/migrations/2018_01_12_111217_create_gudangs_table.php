<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGudangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gudangs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('barang_id')->unsigned()->index();
            $table->integer('suplier_id')->unsigned()->index();
            $table->integer('jumlah');
            $table->integer('jumlah_sebelum');
            $table->timestamps();
            
            $table->foreign('barang_id')
                  ->references('id')
                  ->on('barangs')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('suplier_id')
                  ->references('id')
                  ->on('supliers')
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
        Schema::dropIfExists('gudangs');
    }
}
