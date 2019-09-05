<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoteachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infoteachers', function (Blueprint $table) {
            $table->increments('id')->unsinged();
            $table->string('teacher_number',100)->unique();
            $table->string('teacher_name',100);
            $table->string('subject',50);
            $table->string('email',50)->unique();
            $table->string('phone',20)->unique();
            $table->tinyInteger('gender')->default(1);//1: nam 0: nu
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
        Schema::dropIfExists('infoteachers');
    }
}
