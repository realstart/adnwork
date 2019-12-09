<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('visitor')->nullable;
            $table->integer('Jan')->nullable;
            $table->integer('Feb')->nullable;
            $table->integer('Mar')->nullable;
            $table->integer('Apr')->nullable;
            $table->integer('May')->nullable;
            $table->integer('Jun')->nullable;
            $table->integer('Jul')->nullable;
            $table->integer('Aug')->nullable;
            $table->integer('Sep')->nullable;
            $table->integer('Oct')->nullable;
            $table->integer('Nov')->nullable;
            $table->integer('Dec')->nullable;
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
        Schema::dropIfExists('site_statuses');
    }
}
