<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('general')->nullable();
            $table->string('support')->nullable();
            $table->string('scam')->nullable();
            $table->string('global')->nullable();
            $table->string('tel')->nullable();
            $table->string('report')->nullable();
            $table->string('contact')->nullable();
            $table->string('address')->nullable();
            $table->text('footer_terms')->nullable();
            $table->text('footer_privacy')->nullable();
            $table->text('footer_faq')->nullable();
            $table->text('footer_prohibited')->nullable();
            $table->text('footer_postingtips')->nullable();
            $table->text('footer_careers')->nullable();
            $table->text('footer_payment')->nullable();
            $table->date('date_terms')->nullable();
            $table->date('date_privacy')->nullable();
            $table->date('date_faq')->nullable();
            $table->date('date_prohibited')->nullable();
            $table->date('date_postingtips')->nullable();
            $table->date('date_careers')->nullable();
            $table->date('date_payment')->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
