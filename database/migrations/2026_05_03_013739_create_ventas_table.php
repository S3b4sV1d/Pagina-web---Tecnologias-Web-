<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users'); // Cliente
            $table->timestamp('fecha_venta')->useCurrent();
            $table->decimal('total', 10, 2);

            // El categorizador de estados que mencionaste
            //Parte a mejorar - No es común usar un boolean para estados, normalmente se usaría un enum o una tabla relacionada. Pero siguiendo tu idea:
            $table->boolean('estado')->default(false); // true = completada, false = pendiente/cancelada

            $table->string('metodo_pago')->default('Efectivo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
