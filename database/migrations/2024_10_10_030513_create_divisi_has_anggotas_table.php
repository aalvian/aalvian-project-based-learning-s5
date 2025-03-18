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
        Schema::create('divisi_has_anggotas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_divisi');
            $table->unsignedBigInteger('id_anggota');

            $table->foreign(columns: 'id_divisi')->references('id_divisi')->on('divisis')->onDelete('cascade');
            $table->foreign('id_anggota')->references('id_anggota')->on('anggotas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('divisi_has_anggotas');
    }
};
