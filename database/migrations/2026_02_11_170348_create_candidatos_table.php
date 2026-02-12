<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('candidatos', function (Blueprint $table) {
            $table->id();

            // Relación con users
            $table->unsignedBigInteger('idusuario')->unique();
            $table->foreign('idusuario')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            // Datos del candidato
            $table->string('telefono', 20);
            $table->string('direccion', 255);
            $table->date('fecha_nacimiento');
            $table->string('cv'); // ruta del archivo PDF
            $table->text('experiencia')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('candidatos');
    }
};
