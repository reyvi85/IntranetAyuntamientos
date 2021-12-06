<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWidgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('widgets', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('subtitulo');
            $table->string('image');
            $table->boolean('type')->nullable()->default(false); //Enlace / Noticia
            $table->string('enlace');
            $table->boolean('active')->nullable()->default(false);
            $table->string('slug');
            $table->unsignedBigInteger('instance_id');
            $table->timestamps();
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
        Schema::dropIfExists('widgets');
    }
}
