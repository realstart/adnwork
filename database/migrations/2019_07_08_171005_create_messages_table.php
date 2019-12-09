<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->integer('sender')->nullable();
            $table->integer('receiver')->nullable();
            $table->integer('status')->nullable();
            $table->string('attachment')->nullable();
            $table->string('filename')->nullable();          
            $table->integer('post_id')->nullable();
            $table->string('accept_status')->nullable();
            $table->string('del_s')->nullable();                   
            $table->string('del_r')->nullable();                   
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
        Schema::dropIfExists('messages');
    }
}
