<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_transaksis', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('suplier_id')->unsigned()->index();
            $table->string('po_transaksi');
            $table->enum('status_transaksi', ['1', '2', '3'])->default('1');
            $table->date('tanggal_masuk');
            $table->timestamps();

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
        Schema::dropIfExists('po_transaksis');
    }
}
