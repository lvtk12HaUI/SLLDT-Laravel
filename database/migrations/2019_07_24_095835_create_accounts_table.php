<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            //Increments : khoa chinh tu dong tang
            //big : so nguyen vo cung lon
            $table->increments('id')->unsigned();
            //varchar : mac 100 charater
            $table->string('username',100)->unique();//username k trung nhau
            $table->string('password',100);
            $table->tinyInteger('role')->default(-1);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            //created_at va updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
