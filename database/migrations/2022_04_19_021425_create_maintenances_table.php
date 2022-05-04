<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('maintenance_id');
            $table->foreign('maintenance_id')->references('id')->on('maintenance_category')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger('building_id');
            $table->foreign('building_id')->references('id')->on('buildings')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->tinyInteger('year')->nullable();
            $table->tinyInteger('month')->nullable();
            $table->tinyInteger('day')->nullable();
            $table->integer('progress')->nullable();
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
        Schema::dropIfExists('maintenances');
    }
}
