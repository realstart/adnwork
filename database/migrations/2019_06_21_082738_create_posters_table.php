<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('category_id');
            $table->string('title');            
            $table->text('classifiedbody')->nullable();
            $table->text('estimated_rent')->nullable();
            $table->text('utilities')->nullable();
            $table->string('address')->nullable();
            $table->string('in_city')->nullable();
            $table->string('in_county')->nullable();
            $table->string('in_state')->nullable();
            $table->string('in_zip')->nullable();
            $table->string('in_country')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('country')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_url')->nullable();
            $table->string('preferred_email')->nullable();
            $table->string('preferred_phone')->nullable();
            $table->string('preferred_url')->nullable();
            $table->string('dont_reply')->nullable();
            $table->text('post_image1')->nullable();
            $table->string('post_image2')->nullable();
            $table->string('post_image3')->nullable();
            $table->string('user_verify')->nullable();
            $table->string('status')->nullable();
            $table->string('usedstatus')->nullable();
            $table->text('internal_note')->nullable();
            $table->text('condition')->nullable();
            $table->text('conditionM')->nullable();
            $table->string('map_address')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('provider_name')->nullable();           
            $table->string('sale_make')->nullable();
            $table->string('sale_model')->nullable();           
            $table->string('sale_detail')->nullable();
            $table->string('sale_year')->nullable();
            $table->string('sale_color')->nullable();
            $table->string('listedby')->nullable();
            $table->string('e_date')->nullable();
            $table->string('s_date')->nullable();
            $table->text('events_attending')->nullable();
            $table->text('events_tickets')->nullable();
            $table->string('job_level')->nullable();
            $table->string('job_industry')->nullable();            
            $table->string('user_confirm')->nullable();            
            $table->string('open_position')->nullable();           
            $table->string('min_exp')->nullable();  
            $table->string('max_exp')->nullable();  
            $table->string('work_auth_any')->nullable();  
            $table->string('work_auth_citizen')->nullable();  
            $table->string('work_auth_green')->nullable();  
            $table->string('work_auth_ead')->nullable();  
            $table->string('work_auth_h1b')->nullable();  
            $table->string('work_auth_h4')->nullable();  
            $table->string('work_auth_l1')->nullable();  
            $table->string('work_auth_l2')->nullable();  
            $table->string('work_auth_opt')->nullable();  
            $table->string('work_auth_m1')->nullable();  
            $table->string('work_auth_j1')->nullable();  
            $table->string('work_auth_other')->nullable();
            $table->string('contact_phone_code')->nullable();  
            $table->string('total_price')->nullable();
            $table->string('paid_status')->nullable();   
            $table->string('paid_address')->nullable();   
            $table->string('paid_city')->nullable();   
            $table->string('paid_state')->nullable();   
            $table->string('paid_zip')->nullable();            
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
        Schema::dropIfExists('posters');
    }
}
