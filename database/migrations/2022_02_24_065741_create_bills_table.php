<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->decimal('amount', 8, 2);
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('type_payment')->default(0);
            $table->tinyInteger('payment_method')->default(0);
            $table->string('image', 255)->nullable();
            $table->string('fax');

            $table->unsignedBigInteger('apartment_id');
            $table->foreign('apartment_id')->references('id')->on('apartments')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            
            $table->text('notes');
            $table->integer('receiver_id');
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
        Schema::dropIfExists('bills');
    }
}
