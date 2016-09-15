<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mail_chimp_id', 32)->nullable();
            $table->string('name')->nullable();
            $table->string('email');
            $table->string('status')->nullable();
            $table->string('language', 5);
            $table->string('interests')->nullable();
            $table->string('opt_in_code')->nullable();
            $table->string('ip_signup')->nullable();
            $table->string('ip_opt')->nullable();
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
        Schema::drop('subscribers');
    }
}
