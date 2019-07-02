<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoPelanggansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('so_pelanggans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('asuransi_id')->nullable()->unsigned()->index();
            $table->string('no_claim', 150)->nullable();
            $table->string('nama_pelanggan', 150)->nullable();
            $table->text('alamat_pelanggan')->nullable();
            $table->string('no_telpon_pelanggan', 12)->nullable();
            $table->timestamps();
            
            $table->foreign('asuransi_id')
                  ->references('id')
                  ->on('asuransis')
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
        Schema::dropIfExists('so_pelanggans');
    }
}
