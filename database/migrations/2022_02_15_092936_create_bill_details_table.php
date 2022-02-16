<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_details', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('bill_id');
            $table->foreign('bill_id')->references('id')->on('bills')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('type_template_id');
            $table->foreign('type_template_id')->references('id')->on('bill_type_templates')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->integer('quantity')->default(0);
            $table->decimal('price', 10, 2);
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
        Schema::dropIfExists('bill_details');
    }
}
