<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRobotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_robot', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index()->unsigned();
            $table->integer('robot_id')->index()->unsigned();
            $table->timestamps();
        });

        Schema::table('user_robot', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('robot_id')->references('id')->on('robots');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_robot');
    }
}
