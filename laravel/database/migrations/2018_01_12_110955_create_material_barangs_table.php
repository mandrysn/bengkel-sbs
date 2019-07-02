<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_barangs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('material_id')->unsigned()->index();
            $table->integer('ma_quantity');
            $table->integer('harga_transaksi');
            $table->double('diskon', 3, 1);
            $table->integer('barang_id')->unsigned()->index();
            $table->timestamps();
                  
            $table->foreign('material_id')
                  ->references('id')
                  ->on('materials')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('barang_id')
                  ->references('id')
                  ->on('barangs')
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
        Schema::dropIfExists('material_barangs');
    }
}
