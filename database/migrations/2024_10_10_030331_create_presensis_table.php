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
        Schema::create('presensis', function (Blueprint $table) {
            $table->id('id_presensi');
            $table->date('tanggal');
            $table->string('bukti')->nullable();
            $table->unsignedBigInteger('id_anggota');
            $table->unsignedBigInteger('id_divisi');
            $table->unsignedBigInteger('aktifasi_id')->nullable();
            $table->foreign('aktifasi_id')->references('id_aktifasi')->on('aktifasis')->onDelete('cascade');
            $table->string('status')->default('menunggu');
            $table->timestamps();
            $table->foreign('id_divisi')->references('id_divisi')->on('divisis')->onDelete('cascade');
            $table->foreign(columns: 'id_anggota')->references('id_anggota')->on('anggotas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensis');
    }
};
