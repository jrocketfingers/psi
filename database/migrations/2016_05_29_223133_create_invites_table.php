<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invites', function (Blueprint $table) {
            $table->integer('request_id')->unsigned();
            $table->primary('request_id');
            $table->foreign('request_id')->references('id')->on('requests')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('user_id')->on('students')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::drop('invites');
    }
}
