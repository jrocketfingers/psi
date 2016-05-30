<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('joins', function (Blueprint $table) {
            $table->integer('request_id')->unsigned();
            $table->primary('request_id');
            $table->foreign('request_id')->references('id')->on('requests')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('team_id')->unsigned;
            $table->foreign('team_id')->references('id')->on('team')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::drop('joins');
    }
}
