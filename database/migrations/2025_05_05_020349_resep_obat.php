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
       Schema::create('resep_obat', function (Blueprint $table) {
           $table->id();
           $table->foreignId('id_jadwal_konsultasi')->constrained('jadwal_konsultasi');
           $table->foreignId('id_dokter')->constrained('dokter');
           $table->foreignId('id_pasien')->constrained('pasien');
           $table->text('detail_obat');
           $table->timestamps();
       });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resep_obat');
    }
};
