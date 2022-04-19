<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('avatar', 255)->nullable();
            $table->string('email', 50)->unique();
            $table->string('phone_number', 10)->unique();
            $table->date('dob')->nullable();
            $table->tinyInteger('gender');

            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments')
                ->onUpdate('cascade')
                ->onDelete('cascade');

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
        Schema::dropIfExists('staffs');
    }
}
