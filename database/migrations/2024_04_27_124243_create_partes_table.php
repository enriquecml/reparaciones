<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('partes', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->date('fecha');
            $table->foreignId('cliente_id');
            //Descripcion
            $table->string('maquina');
            $table->text('averia');
            $table->text('reparacion')->nullable();
            //Gastos
            $table->decimal('mano_obra')->nullable();
            $table->decimal('desplazamiento')->nullable();
            $table->decimal('portes')->nullable();
            $table->decimal('materiales')->nullable();
            $table->decimal('iva')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partes');
    }
};
