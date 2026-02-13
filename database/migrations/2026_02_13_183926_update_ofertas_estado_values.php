<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('ofertas', function (Blueprint $table) {
            // Aseguramos que el campo estado existe
            if (!Schema::hasColumn('ofertas', 'estado')) {
                $table->string('estado')->default('pendiente')->after('fecha_incorporacion');
            }
        });
    }

    public function down()
    {
        Schema::table('ofertas', function (Blueprint $table) {
            // No eliminamos el campo por seguridad
        });
    }
};

