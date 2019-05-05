<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('body');
            $table->string('type');
            $table->bigInteger('user_id')->unsigned();  
            $table->bigInteger('movie_id')->unsigned()->nullable();
            $table->bigInteger('series_id')->unsigned()->nullable();
            $table->timestamps();
        });
        Schema::table('comments', function($table) {
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('series_id')->references('id')->on('series')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
