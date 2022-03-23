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
            $table->string('email', 50)->unique();
            $table->string('phone_number', 10)->unique();
            $table->string('password', 255);
            $table->string('name', 50)->nullable();
            $table->date('dob')->nullable();
            $table->integer('number_card')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->unsignedBigInteger('apartment_id')->unique()->nullable();
            $table->string('avatar', 255)->nullable();
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
