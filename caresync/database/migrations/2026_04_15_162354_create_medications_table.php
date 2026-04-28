<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medications', function (Blueprint $table) {
            $table->id();
            
            // Atrela o remédio ao usuário dono dele
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            
            // Dados do Remédio
            $table->string('name', 150); 
            $table->string('dosage', 100)->nullable(); 
            
            // Controle de Tempo
            $table->dateTime('next_dose_at'); 
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medications');
    }
};