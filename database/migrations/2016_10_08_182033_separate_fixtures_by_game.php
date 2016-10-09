<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeparateFixturesByGame extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matches', function (Blueprint $table) {
            $table->string('game');
        });

        Schema::table('opponents', function (Blueprint $table) {
            $table->string('game');
        });

        Schema::table('tournaments', function (Blueprint $table) {
            $table->string('game');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matches', function (Blueprint $table) {
            $table->dropColumn('game');
        });

        Schema::table('opponents', function (Blueprint $table) {
            $table->dropColumn('game');
        });

        Schema::table('tournaments', function (Blueprint $table) {
            $table->dropColumn('game');
        });
    }
}
