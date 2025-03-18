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
        //
        Schema::create('aktifasis', function(Blueprint $table){
            $table->id('id_aktifasi');
            $table->time('tenggat');
            $table->boolean('status')->default(0);
            $table->string('pertemuan');
            $table->date('tanggal');
            $table->unsignedBigInteger('jadwal_id');
            $table->foreign('jadwal_id')->references('id_jadwal')->on('jadwals')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
