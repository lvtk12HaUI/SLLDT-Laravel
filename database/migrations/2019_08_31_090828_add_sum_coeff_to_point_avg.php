<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSumCoeffToPointAvg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('point_avg', function (Blueprint $table) {
            $table->integer('sumCoeff')->unsigned()->default(0)->after('point_avg');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('point_avg', function (Blueprint $table) {
            //
        });
    }
}
