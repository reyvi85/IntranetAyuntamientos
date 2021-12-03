<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('instance_id');
            $table->string('titulo');
            $table->string('subtitulo');
            $table->longText('contenido');
            $table->string('image');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');

            $table->boolean('visitantes')->nullable()->default(false);
            $table->boolean('residentes')->nullable()->default(false);
            $table->boolean('inicio')->nullable()->default(false);

            $table->boolean('active')->nullable()->default(false);

            $table->string('slug');

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
        Schema::dropIfExists('posts');
    }
}
