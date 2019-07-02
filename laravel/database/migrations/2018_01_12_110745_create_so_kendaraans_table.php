<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoKendaraansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('so_kendaraans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('merek_id')->nullable()->unsigned()->index();
            $table->integer('so_pelanggan_id')->nullable()->unsigned()->index();
            $table->string('warna_kendaraan', 30)->nullable();
            $table->integer('tahun_kendaraan')->nullable();
            $table->string('no_polisi', 12)->nullable();
            $table->string('no_mesin', 100)->nullable();
            $table->string('no_rangka', 100)->nullable();
            $table->integer('km_kendaraan')->nullable();
            $table->string('foto_depan', 150)->nullable();
            $table->timestamps();

            $table->foreign('merek_id')
                  ->references('id')
                  ->on('mereks')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('so_pelanggan_id')
                  ->references('id')
                  ->on('so_pelanggans')
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
        Schema::dropIfExists('so_kendaraans');
    }
}
