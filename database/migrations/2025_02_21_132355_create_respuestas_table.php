<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('respuestas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('criterio_id');
            $table->unsignedBigInteger('indicador_id');
            $table->unsignedBigInteger('pregunta_id');
            $table->unsignedBigInteger('user_id');

            $table->string('responsable');
            $table->text('instancia')->nullable();
            $table->text('documentos')->nullable();
            $table->enum('existe', ['SI', 'NO']);
            $table->string('quien_elabora')->nullable();
            $table->text('info_complementaria')->nullable();
            $table->text('respuesta')->nullable();
            //$table->text('fortalezas')->nullable();
            //$table->text('oportunidades')->nullable();
            $table->text('evidencias')->nullable();
            $table->timestamps();

            // Claves foráneas
            $table->foreign('criterio_id')->references('id')->on('criterios')->onDelete('cascade');
            $table->foreign('indicador_id')->references('id')->on('indicadores')->onDelete('cascade');
            $table->foreign('pregunta_id')->references('id')->on('preguntas')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('respuestas');
    }
};
