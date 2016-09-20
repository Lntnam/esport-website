<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_blocks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('view', 50);
            $table->string('key', 50);
            $table->string('description')->nullable();
            $table->timestamps();
            $table->unique(['view', 'key']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('content_blocks');
    }
}
