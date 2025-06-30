<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKonsultasi extends Model
{
    use HasFactory;

    protected $table = 'jadwal_konsultasi';

    protected $fillable = ['id_pasien', 'id_dokter', 'tanggal_konsultasi', 'status', 'keluhan', 'catatan'];

    // Relasi ke model Dokter
    public function dokter()
    {
        return $this->belongsTo(\App\Models\Dokter::class, 'id_dokter');
    }

    // Relasi ke model Pengguna sebagai Pasien
    public function pasien()
    {
        return $this->belongsTo(\App\Models\Pasien::class, 'id_pasien');
    }
}
