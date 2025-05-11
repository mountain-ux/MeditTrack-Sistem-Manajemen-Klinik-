<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResepObat extends Model
{
    use HasFactory;

    protected $table = 'resep_obat';
    protected $fillable = [
        'id_jadwal_konsultasi',
        'id_dokter',
        'id_pasien',
        'detail_obat'
    ];

    // Relasi ke jadwal konsultasi
    public function jadwalKonsultasi()
    {
        return $this->belongsTo(JadwalKonsultasi::class, 'id_jadwal_konsultasi');
    }

    // Relasi ke dokter
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter');
    }

    // Relasi ke pasien
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }

}
