<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTkbofteachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tkbofteachers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('teacher_number',100);
            $table->string('class',10);
            $table->integer('weekdays_id');
            $table->integer('tiethoc_id');
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
        Schema::dropIfExists('tkbofteachers');
    }
}
