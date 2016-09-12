<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTournamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('short', 10);
            $table->enum('type', ['online', 'onlan', 'other'])->nullable;
            $table->string('logo')->nullable();
            $table->string('homepage')->nullable();
            $table->string('bracket')->nullable();
            $table->integer('prize')->default(0);
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
        Schema::drop('tournaments');
    }
}
