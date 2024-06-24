<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->integer('hotel_id');
            $table->integer('category_id');
            $table->string('name');
            $table->string('email');
            $table->string('mobile_no');
            $table->string('address');
            $table->integer('country_id');
            $table->integer('state_id');
            $table->integer('district_id');
            $table->string('city');
            $table->string('gst_no');
            $table->string('contact_person_name');
            $table->string('contact_person_mobile');
            $table->string('contact_person_email');
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
        Schema::dropIfExists('vendors');
    }
}
