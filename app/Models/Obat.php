<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'obat';
    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    // Relasi ke transaksi
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_obat');
    }

}
