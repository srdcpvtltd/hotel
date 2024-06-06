<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToHotelStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hotel_staffs', function (Blueprint $table) {
            $table->string('shift_timing_start')->after('status');
            $table->string('shift_timing_end')->after('shift_timing_start');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hotel_staffs', function (Blueprint $table) {
            $table->dropColumn('shift_timing_start');
            $table->dropColumn('shift_timing_end');
        });
    }
}
