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
        Schema::create('prestamos', function (Blueprint $table) {
          $table->id();
          $table->unsignedbigInteger('user_id');
          $table->unsignedBigInteger('libro_id');
          $table->date('fecha_prestamo');
          $table->date('fecha_devolucion_estimada');
          $table->date('fecha_devolucion')->nullable();
          $table->boolean('entregado');
          $table->timestamps();

          $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
          $table->foreign('libro_id')->references('id')->on('libros')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};
