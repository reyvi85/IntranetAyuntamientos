<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToInstances extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instances', function (Blueprint $table) {
            $table->string('color_title')->after('lng')->default('#000000');
            $table->string('color_sub_title')->after('color_title')->default('#000000');
            $table->string('background_color_dark')->after('color_sub_title')->default('#000000');
            $table->string('background_color_dark_plus')->after('background_color_dark')->default('#000000');
            $table->string('background_color_light')->after('background_color_dark_plus')->default('#000000');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('instances', function (Blueprint $table) {
            $table->dropColumn(['color_title', 'color_sub_title', 'background_color_dark', 'background_color_dark_plus', 'background_color_light']);
        });
    }
}
