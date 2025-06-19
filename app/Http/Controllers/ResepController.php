<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResepObat;
use App\Models\JadwalKonsultasi;
use App\Models\Pengguna;
use App\Models\Obat;
use Illuminate\Support\Facades\Auth;

class ResepController extends Controller
{
    // Menampilkan daftar resep obat berdasarkan pasien dan dokter
    public function index()
    {
        if (Auth::user()->peran === 'Dokter') {
            $resep = ResepObat::where('id_dokter', Auth::id())->get();
        } else {
            $resep = ResepObat::where('id_pasien', Auth::id())->get();
        }

        return view('resep.index', compact('resep'));
    }

    // Menampilkan form tambah resep obat (hanya dokter)
    public function create()
    {
        $pasien = Pengguna::where('peran', 'Pasien')->get();
        $jadwal = JadwalKonsultasi::where('id_dokter', Auth::id())->where('status', 'Selesai')->get();
        $obat = Obat::all();

        return view('resep.create', compact('pasien', 'jadwal','obat'));
    }

    // Menyimpan resep obat baru
    public function store(Request $request)
    {
        $request->validate([
            'id_jadwal_konsultasi' => 'required|exists:jadwal_konsultasi,id',
            'id_pasien' => 'required|exists:pengguna,id',
            'detail_obat' => 'required|string'
        ]);

        ResepObat::create([
            'id_jadwal_konsultasi' => $request->id_jadwal_konsultasi,
            'id_dokter' => Auth::id(),
            'id_pasien' => $request->id_pasien,
            'detail_obat' => $request->detail_obat
        ]);

        return redirect()->route('resep.index')->with('success', 'Resep berhasil ditambahkan!');
    }

    // Menampilkan form edit resep obat (hanya dokter)
    public function edit($id)
    {
        $resep = ResepObat::findOrFail($id);

        return view('resep.edit', compact('resep'));
    }

    // Memperbarui resep obat
    public function update(Request $request, $id)
    {
        $request->validate([
            'detail_obat' => 'required|string'
        ]);

        $resep = ResepObat::findOrFail($id);
        $resep->update(['detail_obat' => $request->detail_obat]);

        return redirect()->route('resep.index')->with('success', 'Resep berhasil diperbarui!');
    }
}
