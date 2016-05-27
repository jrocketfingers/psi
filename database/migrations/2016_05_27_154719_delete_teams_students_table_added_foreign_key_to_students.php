<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteTeamsStudentsTableAddedForeignKeyToStudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('teams_students');
        Schema::table('students', function (Blueprint $table) {
            $table->integer('team_id')->unsigned()->nullable();
            $table->boolean('is_leader')->nullable();

            $table->foreign('team_id')->references('id')->on('teams');
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
