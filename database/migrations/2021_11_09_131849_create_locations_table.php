<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('ubicacion');
            $table->string('telefono');
            $table->string('web')->nullable();
            $table->string('image')->nullable();

            $table->boolean('visitantes')->default(false);
            $table->boolean('residentes')->default(false);
            $table->boolean('inicio')->default(false);

            $table->unsignedBigInteger('instance_id');
            $table->unsignedBigInteger('location_category_id');
            $table->timestamps();

            $table->foreign('instance_id')->references('id')->on('instances')->onDelete('cascade');
            $table->foreign('location_category_id')->references('id')->on('location_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
