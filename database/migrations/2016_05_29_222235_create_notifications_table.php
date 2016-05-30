<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text');
            $table->boolean('can_show');
            $table->timestamps();

            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('user_id')->on('students')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('request_id')->unsigned();
            $table->foreign('request_id')->references('id')->on('requests')->onUpdate('cascade')->onDelet('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
