<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warnings', function (Blueprint $table) {
            $table->id();
            $table->string('asunto');
            $table->text('description');
            $table->string('image')->nullable()->default(null);
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
            $table->unsignedBigInteger('instance_id');
            $table->unsignedBigInteger('warning_state_id');
            $table->unsignedBigInteger('warning_sub_category_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('instance_id')->references('id')->on('instances')->onDelete('cascade');
            $table->foreign('warning_sub_category_id')->references('id')->on('warning_sub_categories')->onDelete('cascade');
            $table->foreign('warning_state_id')->references('id')->on('warning_states')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warnings');
    }
}
