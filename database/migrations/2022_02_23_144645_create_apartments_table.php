<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('apartment_id', 10);
            $table->integer('floor')->default(1);
            $table->tinyInteger('status')->default(0);
            $table->text('description')->nullable();
            $table->float('square_meters')->nullable();
            $table->tinyInteger('type_apartment')->default(1);
            $table->string('password', 255)->nullable();

            $table->unsignedBigInteger('building_id');
            $table->foreign('building_id')->references('id')->on('buildings')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('user_id')->unique()->nullable();
            // $table->foreign('user_id')->references('id')->on('users')
            //         ->onUpdate('cascade')
            //         ->onDelete('cascade');

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
        Schema::dropIfExists('apartments');
    }
}
