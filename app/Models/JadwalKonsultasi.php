<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKonsultasi extends Model
{
    use HasFactory;

    protected $table = 'jadwal_konsultasi';
    protected $fillable = [
        'id_pasien', 'id_dokter', 'tanggal_konsultasi', 'status'
    ];

  public function pasien()
  {
      return $this->belongsTo(Pasien::class, 'id_pasien');
  }

  public function dokter()
  {
      return $this->belongsTo(Dokter::class, 'id_dokter');
  }

}
