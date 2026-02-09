<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('cif', 20)->unique();
            $table->string('nombre', 150);
            $table->string('telefono', 20)->nullable();
            $table->string('web', 200)->nullable();
            $table->string('persona_contacto', 150)->nullable();
            $table->string('email_contacto', 150)->nullable();
            $table->string('direccion', 200)->nullable();
            $table->string('cp', 10)->nullable();
            $table->string('ciudad', 100)->nullable()->index(); // idx_empresas_ciudad
            $table->string('provincia', 100)->nullable();
            $table->string('logo', 255)->nullable();
            $table->boolean('verificada')->default(false);
            $table->timestamps();
            $table->softDeletes(); // deleted_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
