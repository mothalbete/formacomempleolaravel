<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('candidato_oferta', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('candidato_id');
            $table->unsignedBigInteger('oferta_id');

            $table->timestamps();

            $table->foreign('candidato_id')->references('id')->on('candidatos')->onDelete('cascade');
            $table->foreign('oferta_id')->references('id')->on('ofertas')->onDelete('cascade');

            $table->unique(['candidato_id', 'oferta_id']);
        });
    }

};
