<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddRolToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            DB::statement("ALTER TABLE users MODIFY COLUMN rol ENUM('Super-Administrador', 'Administrador-Instancia', 'Gestor-Instancia', 'Comerciante', 'Usuarios')");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('rol');
            $table->enum('rol', ['Super-Administrador', 'Administrador-Instancia', 'Gestor-Instancia', 'Usuarios'])->default('Usuarios');
        });
    }
}
