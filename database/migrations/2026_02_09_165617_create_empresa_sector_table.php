<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('empresa_sector', function (Blueprint $table) {
            $table->unsignedBigInteger('idempresa');
            $table->unsignedBigInteger('idsector');

            $table->primary(['idempresa', 'idsector']);

            $table->foreign('idempresa', 'fk_es_empresa')
                ->references('id')->on('empresas')
                ->onDelete('cascade');

            $table->foreign('idsector', 'fk_es_sector')
                ->references('id')->on('sectores')
                ->onDelete('cascade');

            $table->timestamps(); // created_at y updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('empresa_sector');
    }
};
