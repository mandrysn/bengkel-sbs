<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUtangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utangs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('suplier_id')->unsigned()->index();
            $table->integer('jumlah');
            $table->integer('sisa');
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
        Schema::dropIfExists('utangs');
    }
}
