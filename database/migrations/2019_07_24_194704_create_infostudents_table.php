<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfostudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infostudents', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('student_number',100)->unique();
            $table->string('student_name',100);
            $table->string('email',50)->unique()->nullable();
            $table->string('phone',20)->unique();
            $table->tinyInteger('gender')->default(1);//1: nam 0: nu
            $table->integer('class');
            $table->string('address',100);
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
        Schema::dropIfExists('infostudents');
    }
}
