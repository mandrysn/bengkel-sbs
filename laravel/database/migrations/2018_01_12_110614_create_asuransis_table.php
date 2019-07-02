<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsuransisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asuransis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_asuransi', 50);
            $table->string('nama_asuransi', 150);
            $table->text('alamat_asuransi');
            $table->string('no_telpon_asuransi', 12);
            $table->string('no_hp_asuransi', 12)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asuransis');
    }
}
