<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->string('key')
                  ->unique();
            $table->primary('key');
            $table->string('title');
            $table->integer('lines')
                  ->default(3);
            $table->text('options')
                  ->nullable();
            $table->text('value')
                  ->nullable();
            $table->string('hint', 200)
                  ->nullable();
            $table->tinyInteger('visible')
                  ->default(1);
            $table->integer('order')
                  ->defeault(0);
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
        Schema::drop('site_settings');
    }
}
