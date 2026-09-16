<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lokasis', function (Blueprint $table) {
            $table->string('sumber')->nullable()->after('penerima');
            $table->text('deskripsi')->nullable()->after('sumber');
            $table->string('ig_path')->nullable()->after('deskripsi');
            $table->string('ig_filename')->nullable()->after('ig_path');
            $table->unsignedInteger('ig_size')->nullable()->after('ig_filename');
            $table->string('style_path')->nullable()->after('ig_size');
            $table->string('style_filename')->nullable()->after('style_path');
        });
    }

    public function down(): void
    {
        Schema::table('lokasis', function (Blueprint $table) {
            $table->dropColumn(['sumber', 'deskripsi', 'ig_path', 'ig_filename', 'ig_size', 'style_path', 'style_filename']);
        });
    }
};
