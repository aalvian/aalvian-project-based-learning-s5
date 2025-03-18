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
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user');             
            $table->unsignedBigInteger('id_anggota')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();            
            $table->string('gambar')->nullable();
            $table->string('token')->nullable();            
            $table->foreignId('current_role_id')->nullable()->constrained('roles');
            $table->foreign('id_anggota')->references('id_anggota')->on('anggotas')->onDelete('cascade');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
