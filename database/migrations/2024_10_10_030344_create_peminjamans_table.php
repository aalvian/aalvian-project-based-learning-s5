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
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id('id_peminjaman');
            $table->integer('jml_alat');
            $table->date('tggl_pinjam');
            $table->string('status')->default('dipinjam');
            $table->unsignedBigInteger('petugas_id');
            $table->unsignedBigInteger('id_alat');
            $table->unsignedBigInteger('id_anggota');
            $table->timestamps();

            $table->foreign(columns: 'petugas_id')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign(columns: 'id_alat')->references('id_alat')->on('alats')->onDelete('cascade');
            $table->foreign(columns: 'id_anggota')->references('id_anggota')->on('anggotas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};
