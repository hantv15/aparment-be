<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('plate_number');

            $table->unsignedBigInteger('vehicle_type_id');
            $table->foreign('vehicle_type_id')->references('id')->on('vehicle_types')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');    
            
            $table->unsignedBigInteger('vehicle_card_id');
            $table->foreign('vehicle_card_id')->references('id')->on('vehicle_cards')
                    ->onUpdate('cascade')
                    ->onDelete('cascade'); 

            $table->tinyInteger('status')->default(0);
            $table->string('image', 255)->nullable();
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
        Schema::dropIfExists('vehicles');
    }
}
