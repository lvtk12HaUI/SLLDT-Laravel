<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointOfStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pointOfStudent', function (Blueprint $table) {
            $table->increments('id');
            $table->string('student_number',100);
            $table->string('subject_number',20);
            $table->string('point_id',10);
            $table->float('point',2,2);
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
        Schema::dropIfExists('pointOfStudent');
    }
}
