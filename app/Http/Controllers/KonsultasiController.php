<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalKonsultasi;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Auth;

class KonsultasiController extends Controller
{
    public function index()
    {
        if (Auth::user()->peran === 'Dokter') {
            $konsultasi = JadwalKonsultasi::where('id_dokter', Auth::id())->get();
        } else {
            $konsultasi = JadwalKonsultasi::where('id_pasien', Auth::id())->get();
        }

        return view('konsultasi.index', compact('konsultasi'));
    }

    public function create()
    {
        $dokter = Pengguna::where('peran', 'Dokter')->get();
        return view('konsultasi.create', compact('dokter'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_dokter' => 'required|exists:pengguna,id',
            'tanggal_konsultasi' => 'required|date',
            'status' => 'required|string'
        ]);

        JadwalKonsultasi::create([
            'id_dokter' => $request->id_dokter,
            'id_pasien' => Auth::id(),
            'tanggal_konsultasi' => $request->tanggal_konsultasi,
            'status' => 'Menunggu'
        ]);

        return redirect()->route('konsultasi.index')->with('success', 'Jadwal konsultasi berhasil dibuat!');
    }

    public function show($id)
    {
        $konsultasi = JadwalKonsultasi::findOrFail($id);
        return view('konsultasi.detail', compact('konsultasi'));
    }

    public function update(Request $request, $id)
    {
        $konsultasi = JadwalKonsultasi::findOrFail($id);

        $request->validate([
            'status' => 'required|string'
        ]);

        $konsultasi->update([
            'status' => $request->status
        ]);

        return redirect()->route('konsultasi.index')->with('success', 'Status konsultasi berhasil diperbarui!');
    }
}
