<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillTypeTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_type_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);

            $table->unsignedBigInteger('bill_type_id');
            $table->foreign('bill_type_id')->references('id')->on('bill_types')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

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
        Schema::dropIfExists('bill_type_templates');
    }
}
