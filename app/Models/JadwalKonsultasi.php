<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKonsultasi extends Model
{
    use HasFactory;

    protected $table = 'jadwal_konsultasi';
    protected $fillable = [
    'id_pasien',
    'id_dokter',
    'tanggal_konsultasi',
    'status',
    'keluhan',
    'catatan'
];

    public function dokter()
    {
        return $this->belongsTo(Pengguna::class, 'id_dokter');
    }

    public function pasien()
    {
        return $this->belongsTo(Pengguna::class, 'id_pasien');
    }
}
