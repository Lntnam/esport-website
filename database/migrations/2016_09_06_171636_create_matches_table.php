<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('schedule');
            $table->integer('tournament_id');
            $table->integer('opponent_id')->nullable();
            $table->smallInteger('for')->default(0);
            $table->smallInteger('against')->default(0);
            $table->smallInteger('games')->default(1);
            $table->tinyInteger('over')->default(0);
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
        Schema::drop('matches');
    }
}
