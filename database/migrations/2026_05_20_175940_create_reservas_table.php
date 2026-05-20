<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Fila de reservas - implementa estrutura FIFO (Queue)
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('livro_id')->constrained('livros')->onDelete('cascade');
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->integer('posicao_fila'); // posição na fila FIFO
            $table->enum('status', ['aguardando', 'notificado', 'cancelado'])->default('aguardando');
            $table->timestamps(); // created_at = momento que entrou na fila (FIFO ordering)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
