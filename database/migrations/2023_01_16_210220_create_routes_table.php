<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('imagen');
            $table->boolean('state')->default(1);
            $table->string('inicio_ruta_name');
            $table->text('inicio_ruta_direccion');
            $table->text('inicio_ruta_description')->nullable();
            $table->text('inicio_ruta_imagen');
            $table->string('fin_ruta_name');
            $table->text('fin_ruta_direccion');
            $table->text('fin_ruta_description')->nullable();
            $table->text('fin_ruta_imagen');

            $table->unsignedBigInteger('instance_id');
            $table->unsignedBigInteger('route_category_id');
            $table->foreign('instance_id')->references('id')->on('instances')->onDelete('cascade');
            $table->foreign('route_category_id')->references('id')->on('route_categories')->onDelete('cascade');


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
        Schema::dropIfExists('routes');
    }
}
