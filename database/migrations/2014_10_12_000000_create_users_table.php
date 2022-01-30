<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('user_name', 50)->unique();
            $table->string('password', 50);
            $table->string('name', 50);
            $table->string('email', 50)->unique();
            $table->date('dob')->nullable();
            $table->integer('number_card')->nullable();
            $table->string('department_id', 10);
            $table->string('avatar', 255)->nullable();
            $table->string('phone_number', 10)->unique()->nullable();
            $table->unsignedBigInteger('role_id');
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
        Schema::dropIfExists('users');
    }
}
