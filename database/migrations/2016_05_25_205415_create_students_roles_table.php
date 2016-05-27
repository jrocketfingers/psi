<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned();
            $table->integer('students_id')->unsigned();
            $table->boolean('active');
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('students_id')->references('id')->on('students')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('students_roles');
    }
}
