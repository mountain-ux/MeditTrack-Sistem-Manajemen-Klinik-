<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $fillable = [
        'id_pasien',
        'id_obat',
        'jumlah',
        'total_harga',
        'tanggal_transaksi'
    ];
    public function hitungTotalHarga()
    {
        return $this->jumlah * $this->obat->harga;
    }

    // Relasi ke pasien
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }

    // Relasi ke obat
    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat');
    }
}
