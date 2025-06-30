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
    $query = ResepObat::with('jadwalKonsultasi.pasien.pengguna', 'obat');

    if (Auth::user()->peran === 'Dokter') {
        $dokter = \App\Models\Dokter::where('id_pengguna', Auth::id())->first();

        if (!$dokter) {
            return redirect()->back()->with('error', 'Data dokter tidak ditemukan.');
        }

        $resep = $query->where('id_dokter', $dokter->id)->get();
    } elseif (Auth::user()->peran === 'Pasien') {
        $pasien = \App\Models\Pasien::where('id_pengguna', Auth::id())->first();

        if (!$pasien) {
            return redirect()->back()->with('error', 'Data pasien tidak ditemukan.');
        }

        $resep = $query->where('id_pasien', $pasien->id)->get();
    } else {
        // Untuk admin atau peran lain, tampilkan semua resep
        $resep = $query->get();
    }



    return view('resep.index', compact('resep'));
}


    // Menampilkan form tambah resep obat (hanya dokter)
    public function create()
    {
        // Ambil data dokter yang sedang login
        $dokter = \App\Models\Dokter::where('id_pengguna', Auth::id())->first();

        // Ambil jadwal konsultasi berdasarkan id dokter dari tabel 'dokter'
        $jadwal = JadwalKonsultasi::with('pasien')->where('id_dokter', $dokter->id)->where('status', 'Selesai')->get();

        $obat = Obat::all();

        return view('resep.create', compact('jadwal', 'obat'));
    }

    // Menyimpan resep obat baru
    public function store(Request $request)
    {
        $request->validate([
            'id_jadwal_konsultasi' => 'required|exists:jadwal_konsultasi,id',
            'detail_obat' => 'required|string',
        ]);

        $jadwal = JadwalKonsultasi::findOrFail($request->id_jadwal_konsultasi);

        ResepObat::create([
            'id_jadwal_konsultasi' => $jadwal->id,
            'id_dokter' => $jadwal->id_dokter,
            'id_pasien' => $jadwal->id_pasien,
            'detail_obat' => $request->detail_obat,
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
            'detail_obat' => 'required|string',
        ]);

        $resep = ResepObat::findOrFail($id);
        $resep->update(['detail_obat' => $request->detail_obat]);

        return redirect()->route('resep.index')->with('success', 'Resep berhasil diperbarui!');
    }
}
