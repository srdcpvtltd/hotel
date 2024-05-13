<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_staffs', function (Blueprint $table) {
            $table->id();
            $table->integer('hotel_id');
            $table->string('name');
            $table->string('contact_no');
            $table->integer('designation_id');
            $table->string('salary');
            $table->string('shift');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('hotel_staffs');
    }
}
