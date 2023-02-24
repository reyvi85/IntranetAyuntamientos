<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInstanceToRouteReserves extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('route_reserves', function (Blueprint $table) {
            $table->unsignedBigInteger('instance_id')->after('route_id');
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
        Schema::table('route_reserves', function (Blueprint $table) {
            $table->dropForeign('route_reserves_instance_id_foreign');
            $table->dropColumn('instance_id');
        });
    }
}
