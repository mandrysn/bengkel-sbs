<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 250);
            $table->string('email')->unique();
            $table->string('password', 250);
            $table->string('level',250);
            $table->integer('group_id')->unsigned()->index();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('group_id')
                    ->references('id')
                    ->on('groups')
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
        Schema::dropIfExists('users');
    }
}
