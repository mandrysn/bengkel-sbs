<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('modul_id')->unsigned()->index();
            $table->integer('group_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('group_id')
                    ->references('id')
                    ->on('groups')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->foreign('modul_id')
                    ->references('id')
                    ->on('moduls')
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
        Schema::dropIfExists('permissions');
    }
}
