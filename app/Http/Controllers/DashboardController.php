<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengguna;
use App\Models\JadwalKonsultasi;

class DashboardController extends Controller
{
    // Menentukan dashboard berdasarkan peran
    public function index()
    {
        $pengguna = Auth::user();

        if ($pengguna->peran === 'Admin') {
            return $this->admin();
        } elseif ($pengguna->peran === 'Dokter') {
            return $this->dokter();
        } else {
            return $this->pasien();
        }
    }

    // Dashboard Admin
    public function admin()
    {
        $totalPengguna = Pengguna::count();
        $totalDokter = Pengguna::where('peran', 'Dokter')->count();
        $totalKonsultasi = JadwalKonsultasi::count();
        $pengguna = Pengguna::all();

        return view('dashboard.admin', compact('totalPengguna', 'totalDokter', 'totalKonsultasi', 'pengguna'));
    }
    public function pasien()
    {
        return view('dashboard.pasien');
    }


    // Menambahkan dokter dari dashboard admin
    public function storeDokter(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pengguna',
            'password' => 'required|min:6'
        ]);

        Pengguna::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'peran' => 'Dokter'
        ]);

        return redirect()->route('dashboard.admin')->with('success', 'Dokter berhasil ditambahkan!');
    }
    public function dokter()
    {
        return view('dashboard.dokter');
    }


    // Hapus dokter dari dashboard admin
    public function destroyDokter($id)
    {
        $dokter = Pengguna::findOrFail($id);
        $dokter->delete();

        return redirect()->route('dashboard.admin')->with('success', 'Dokter berhasil dihapus!');
    }
}
