<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category')->nullable(); // Por ejemplo: 'Programación', 'Idiomas', 'Soft Skills'
            $table->timestamps();
        });

        Schema::create('skill_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('skill_id')->constrained()->onDelete('cascade');
            $table->integer('level')->default(1); // 1-5 para indicar nivel de dominio
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skill_user');
        Schema::dropIfExists('skills');
    }
};
