<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->integer('district_id')->after('state_id');
            $table->integer('p_district_id')->after('p_state_id');
            $table->string('total_amount')->after('suspicious_check');
            $table->string('payment_method')->after('total_amount');
            $table->string('payment_status')->after('payment_method');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('district_id');
            $table->dropColumn('p_district_id');
            $table->dropColumn('total_amount');
            $table->dropColumn('payment_method');
            $table->dropColumn('payment_status');
        });
    }
}
