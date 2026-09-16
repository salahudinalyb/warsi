<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lokasis', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('nama');
            $table->string('wilayah');
            $table->enum('kategori', ['hutan', 'program', 'monitoring']);
            $table->unsignedTinyInteger('bulan')->default(1);
            $table->unsignedInteger('luas')->default(0);
            $table->unsignedInteger('penerima')->default(0);
            $table->decimal('x', 4, 3)->default(0.5);
            $table->decimal('y', 4, 3)->default(0.5);
            $table->enum('status', ['terbit', 'menunggu', 'ditolak'])->default('menunggu');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lokasis');
    }
};
