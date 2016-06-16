<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->binary('image');
            $table->morphs('imageable');
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->integer('image_id')->unsigned()->nullable();

            $table->foreign('image_id')->references('id')->on('images')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('teams', function (Blueprint $table) {
            $table->integer('image_id')->unsigned()->nullable();

            $table->foreign('image_id')->references('id')->on('images')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table)
        {
            $table->dropForeign('users_image_id_foreign');
            $table->removeColumn('image_id');
        });

        Schema::table('teams', function($table)
        {
            $table->dropForeign('teams_image_id_foreign');
            $table->removeColumn('image_id');
        });

        Schema::drop('images');
    }
}
