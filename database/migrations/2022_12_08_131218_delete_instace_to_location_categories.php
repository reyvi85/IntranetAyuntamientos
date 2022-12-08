<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteInstaceToLocationCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('location_categories', function (Blueprint $table) {
            $table->dropForeign('location_categories_instance_id_foreign');
            $table->dropColumn('instance_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('location_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('instance_id');
            $table->foreign('instance_id')->references('id')->on('instances')->onDelete('cascade');
        });
    }
}
