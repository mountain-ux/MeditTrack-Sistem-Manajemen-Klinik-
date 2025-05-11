<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';
    protected $fillable = [
        'id_pengguna', 'tanggal_lahir', 'jenis_kelamin',
        'telepon', 'alamat', 'riwayat_medis'
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_pasien');
    }
    public function resep()
    {
        return $this->hasMany(ResepObat::class, 'id_pasien');
    }
}
