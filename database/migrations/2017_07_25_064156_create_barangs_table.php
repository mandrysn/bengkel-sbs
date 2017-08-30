<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('merek_id')->unsigned()->index();
            $table->integer('satuan_id')->unsigned()->index();
            $table->string('kode_barang', 9);
            $table->string('no_part_barang', 15);
            $table->string('nama_barang');
            $table->enum('kategori_barang', ['1', '2'])->default('1'); //1->Material, 2->Spare Part
            $table->string('harga_barang', 9);
            $table->longtext('keterangan')->nullable();
            $table->timestamps();
            
            //untuk relation table
            $table->foreign('merek_id')
                  ->references('id')
                  ->on('mereks')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            
            $table->foreign('satuan_id')
                  ->references('id')
                  ->on('satuans')
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
        //
        Schema::dropIfExists('barangs');
    }
}
