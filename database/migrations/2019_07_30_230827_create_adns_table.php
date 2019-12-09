<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */    
    public function up()
    {
        Schema::create('adns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subject');
            $table->string('tagline')->nullable();
            $table->string('link')->nullable();
            $table->string('type')->nullable();
            $table->string('logo')->nullable();
            $table->string('image')->nullable();
            $table->text('body');
            $table->string('location');
            $table->string('user_id');
            $table->string('status')->nullable();
            $table->date('exp_date')->nullable();
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
        Schema::dropIfExists('adns');
    }
}
