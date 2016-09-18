<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentBlockContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_block_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('content_block_id')->unsigned();
            $table->foreign('content_block_id')
                  ->references('id')->on('content_blocks')
                  ->onDelete('cascade');
            $table->string('locale');
            $table->unique(['content_block_id', 'locale']);
            $table->text('content');
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
        Schema::drop('content_block_contents');
    }
}
