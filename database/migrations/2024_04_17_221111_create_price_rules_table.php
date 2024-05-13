<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_rules', function (Blueprint $table) {
            $table->id();
            $table->string('room_type_id');
            $table->string('rent_by_hour');
            $table->string('rent_by_hour_price');
            $table->string('after_rent_by_hour_price');
            $table->string('price');
            $table->string('extra_adult_price');
            $table->string('extra_child_price');
            $table->string('check_in');
            $table->string('check_out');
            $table->string('overtime_charge');
            $table->string('rounded_minutes');
            $table->string('friday_price');
            $table->string('saturday_price');
            $table->string('sunday_price');
            $table->string('holiday_price');
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
        Schema::dropIfExists('price_rules');
    }
}
