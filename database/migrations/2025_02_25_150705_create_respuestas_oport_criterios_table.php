<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuestas_oport_criterios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('criterio_id');
            $table->unsignedBigInteger('user_id');
            $table->text('problematica')->nullable();
            $table->text('estrategia')->nullable();
            $table->text('mecanismo')->nullable();  
            $table->text('accion')->nullable();
            $table->text('responsable')->nullable();
            $table->text('fecha_p')->nullable();
            $table->timestamps();

            // Claves foráneas
            $table->foreign('criterio_id')->references('id')->on('criterios')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('respuestas_oport_criterios');
    }
};
