<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('busines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('direccion');
            $table->string('telefonos')->nullable();
            $table->string('faxs')->nullable();
            $table->string('emails')->nullable();
            $table->string('logo')->nullable();
            $table->text('description');
            $table->string('slug');

            $table->unsignedBigInteger('category_busine_id');
            $table->unsignedBigInteger('instance_id');
            $table->timestamps();

            $table->foreign('category_busine_id')->references('id')->on('category_busines')->onDelete('cascade');
            $table->foreign('instance_id')->references('id')->on('instances')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('busines');
    }
}
