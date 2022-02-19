<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResidentCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resident_cards', function (Blueprint $table) {
            $table->id();
            $table->string('card_id', 10);

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            
            $table->date('date_of_issue');

            $table->unsignedBigInteger('vehicle_id');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            
            $table->string('plate_number');
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
        Schema::dropIfExists('resident_cards');
    }
}
