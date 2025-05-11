<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengguna;
use App\Models\JadwalKonsultasi;

class DashboardController extends Controller
{
    public function index()
    {
        $pengguna = Auth::user();

        return match ($pengguna->peran) {
            'Admin' => $this->admin(),
            'Dokter' => $this->dokter(),
            default => $this->pasien(),
        };
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
            'email' => 'required|email|unique:pengguna',
            'password' => 'required|min:6',
        ]);

        Pengguna::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'peran' => 'Dokter',
        ]);

        return redirect()->route('dashboard.admin')->with('success', 'Dokter berhasil ditambahkan!');
    }

    public function destroyDokter($id)
    {
        $dokter = Pengguna::findOrFail($id);
        $dokter->delete();

        return redirect()->route('dashboard.admin')->with('success', 'Dokter berhasil dihapus!');
    }

    // === Dokter Dashboard ===
    public function dokter()
    {
        $dokterId = Auth::id();

        $jadwalKonsultasi = JadwalKonsultasi::with('pasien') // relasi pasien harus ada
            ->where('id_dokter', $dokterId)
            ->orderBy('tanggal_konsultasi', 'desc')
            ->get();

        return view('dashboard.dokter', compact('jadwalKonsultasi'));
    }

    // === Pasien Dashboard ===
    public function pasien()
    {
        $pasienId = Auth::id();

        $konsultasi = JadwalKonsultasi::with('dokter')
            ->where('id_pasien', $pasienId)
            ->orderBy('tanggal_konsultasi', 'desc')
            ->get();

        return view('dashboard.pasien', compact('konsultasi'));
    }
}
