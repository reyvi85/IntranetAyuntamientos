<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarningAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warning_answers', function (Blueprint $table) {
            $table->id();
            $table->mediumText('answer');
            $table->unsignedBigInteger('warning_id');
            $table->timestamps();

            $table->foreign('warning_id')->references('id')->on('warnings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warning_answers');
    }
}
