<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',200);
            $table->string('email')->unique();
            $table->string('password');
            $table->tinyInteger('status')->default(2);
            $table->dateTime('last_login_date')->nullable();
            $table->string('phone',64);
            $table->string('address',255);
            $table->string('avatar')->nullable();
            $table->integer('attr')->unsigned()->default(0);
            $table->integer('added_by')->unsigned();            
            $table->rememberToken();
            $table->timestamps();
            $table->index(['name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
