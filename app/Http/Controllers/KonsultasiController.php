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
        $user = Auth::user();
        $konsultasi = ($user->peran === 'Dokter')
            ? JadwalKonsultasi::where('id_dokter', $user->id)->get()
            : JadwalKonsultasi::where('id_pasien', $user->id)->get();

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
            'keluhan' => 'required|string',
        ]);

        JadwalKonsultasi::create([
            'id_dokter' => $request->id_dokter,
            'id_pasien' => Auth::id(),
            'tanggal_konsultasi' => $request->tanggal_konsultasi,
            'keluhan' => $request->keluhan,
            'status' => 'Menunggu'
        ]);

        return redirect()->route('konsultasi.index')->with('success', 'Permintaan konsultasi berhasil diajukan.');
    }

    public function show($id)
    {
        $konsultasi = JadwalKonsultasi::findOrFail($id);
        return view('konsultasi.detail', compact('konsultasi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Dijadwalkan,Dikonfirmasi,Selesai,Batal'
        ]);

        $konsultasi = JadwalKonsultasi::findOrFail($id);
        $konsultasi->update([
            'status' => $request->status
        ]);

        return redirect()->route('konsultasi.index')->with('success', 'Status konsultasi diperbarui.');
    }

    public function selesaikan(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|string'
        ]);

        $konsultasi = JadwalKonsultasi::findOrFail($id);
        $konsultasi->update([
            'status' => 'Selesai',
            'catatan' => $request->catatan
        ]);

        return redirect()->route('konsultasi.index')->with('success', 'Konsultasi ditandai sebagai selesai.');
    }
}
