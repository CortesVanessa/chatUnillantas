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
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->String('nombre');
            $table->String('correo');
            $table->String('telefono');
             $table->date('fecha')->nullable(false);
            $table->time('hora')->nullable(false);
            $table->unique(['fecha', 'hora']);
            $table->String('asunto');
            $table->foreignId('servicio_id')->constrained('servicios');
    $table->foreignId('producto_id')->constrained('productos');
         $table->enum('status',['proceso','cancelado','finalizado'])->default('proceso');
$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
