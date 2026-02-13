<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('empresas', function (Blueprint $table) {
            // Añadimos el nuevo campo estado
            $table->string('estado')->default('pendiente')->after('logo');

            // Eliminamos el campo verificada
            $table->dropColumn('verificada');
        });
    }

    public function down()
    {
        Schema::table('empresas', function (Blueprint $table) {
            // Restauramos verificada
            $table->boolean('verificada')->default(false)->after('logo');

            // Eliminamos estado
            $table->dropColumn('estado');
        });
    }
};

