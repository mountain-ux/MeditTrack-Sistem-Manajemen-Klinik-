<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengguna;
use App\Models\Dokter;
use App\Models\JadwalKonsultasi;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $dokter = Dokter::where('id_pengguna', $user->id)->first();

        $jadwalKonsultasi = JadwalKonsultasi::with('pasien')->where('id_dokter', $dokter->id)->orderBy('tanggal_konsultasi', 'desc')->get();

        return view('dashboard.dokter', compact('jadwalKonsultasi'));
    }

    // === Admin Dashboard ===
    public function admin()
    {
        $totalPengguna = Pengguna::count();
        $totalDokter = Pengguna::where('peran', 'Dokter')->count();
        $totalKonsultasi = JadwalKonsultasi::count();
        $pengguna = Pengguna::all();

        return view('dashboard.admin', compact('totalPengguna', 'totalDokter', 'totalKonsultasi', 'pengguna'));
    }

    public function storeDokter(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pengguna,email',
            'password' => 'required|string|min:6',
            'spesialisasi' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'jadwal_praktik' => 'required|string|max:255',
        ]);

        // Simpan ke pengguna
        $user = Pengguna::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'peran' => 'Dokter',
        ]);

        // Simpan ke dokter
        Dokter::create([
            'id_pengguna' => $user->id,
            'spesialisasi' => $request->spesialisasi,
            'telepon' => $request->telepon,
            'jadwal_praktik' => $request->jadwal_praktik,
        ]);

        return redirect()->route('dashboard.admin')->with('success', 'Dokter berhasil ditambahkan!');
    }

    public function destroyDokter($id)
    {
        $dokter = Pengguna::findOrFail($id);

        // Hapus data dari tabel dokter jika ada
        Dokter::where('id_pengguna', $dokter->id)->delete();

        $dokter->delete();

        return redirect()->route('dashboard.admin')->with('success', 'Dokter berhasil dihapus!');
    }

    // === Dokter Dashboard ===
    public function dokter()
    {
        $dokterId = Auth::id();

        $jadwalKonsultasi = JadwalKonsultasi::with('pasien')->where('id_dokter', $dokterId)->orderBy('tanggal_konsultasi', 'desc')->get();

        return view('dashboard.dokter', compact('jadwalKonsultasi'));
    }

    // === Pasien Dashboard ===
    public function pasien()
    {
        $pasienId = Auth::id();

        $konsultasi = JadwalKonsultasi::with('dokter')->where('id_pasien', $pasienId)->orderBy('tanggal_konsultasi', 'desc')->get();

        return view('dashboard.pasien', compact('konsultasi'));
    }
}
