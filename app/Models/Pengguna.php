<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengguna extends Authenticatable
{
    use HasFactory;

    protected $table = 'pengguna';
    protected $fillable = ['nama', 'email', 'password', 'peran'];
    protected $hidden = ['password'];

    public function pasien()
    {
        return $this->hasOne(Pasien::class, 'id_pengguna');
    }

    public function dokter()
    {
        return $this->hasOne(Dokter::class, 'id_pengguna');
    }
}
