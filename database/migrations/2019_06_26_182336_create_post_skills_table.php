<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_skills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('poster_id');
            $table->string('skill_name');
            $table->string('skill_exp');
            $table->string('skill_level');
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
        Schema::dropIfExists('post_skills');
    }
}
