<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ofertas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idempresa');
            $table->unsignedBigInteger('idsector');
            $table->unsignedBigInteger('idmodalidad');
            $table->unsignedBigInteger('idpuesto'); // 👈 clasificación por puesto

            $table->string('titulo', 200);
            $table->text('descripcion');
            $table->text('requisitos')->nullable();
            $table->text('funciones')->nullable();

            $table->decimal('salario_min', 10, 2)->nullable();
            $table->decimal('salario_max', 10, 2)->nullable();

            $table->string('tipo_contrato', 100)->nullable();
            $table->string('jornada', 100)->nullable();
            $table->string('ubicacion', 150)->nullable();

            $table->date('fecha_publicacion')->nullable();
            $table->date('publicar_hasta')->nullable();
            $table->date('fecha_incorporacion')->nullable();

            $table->enum('estado', ['borrador','publicada','pausada','cerrada','vencida'])
                  ->default('borrador')
                  ->index(); // idx_ofertas_estado

            $table->timestamps();
            $table->softDeletes();

            // Índices
            $table->index('idempresa', 'idx_ofertas_empresa');
            $table->index('idsector', 'idx_ofertas_sector');
            $table->index('idmodalidad', 'fk_oferta_modalidad');
            $table->index('idpuesto', 'idx_ofertas_puesto');

            // FKs
            $table->foreign('idempresa', 'fk_oferta_empresa')
                ->references('id')->on('empresas')
                ->onDelete('cascade');

            $table->foreign('idsector', 'fk_oferta_sector')
                ->references('id')->on('sectores');

            $table->foreign('idmodalidad', 'fk_oferta_modalidad_fk')
                ->references('id')->on('modalidad');

            $table->foreign('idpuesto', 'fk_oferta_puesto')
                ->references('id')->on('puestos');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ofertas');
    }
};
