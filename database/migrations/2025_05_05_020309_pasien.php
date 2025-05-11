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
       Schema::create('pasien', function (Blueprint $table) {
           $table->id();
           $table->foreignId('id_pengguna')->constrained('pengguna');
           $table->date('tanggal_lahir');
           $table->string('jenis_kelamin');
           $table->string('telepon');
           $table->text('alamat');
           $table->text('riwayat_medis'); // Perbaikan typo: rivayat → riwayat
           $table->timestamps();
       });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasien');
    }
};
