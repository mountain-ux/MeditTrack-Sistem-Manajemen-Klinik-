<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JadwalKonsultasi;
use App\Models\Dokter;
use App\Models\Pasien;

class KonsultasiController extends Controller
{
    // Menampilkan daftar konsultasi berdasarkan peran
    public function index()
    {
        $user = Auth::user();

        if ($user->peran === 'Dokter') {
            $dokter = \App\Models\Dokter::where('id_pengguna', $user->id)->first();

            $konsultasi = JadwalKonsultasi::with(['pasien'])
                ->where('id_dokter', $dokter->id)
                ->orderByDesc('tanggal_konsultasi')
                ->get();
        } else {
            $pasien = Pasien::where('id_pengguna', $user->id)->first();
            // $konsultasi = JadwalKonsultasi::with(['pasien.pengguna', 'dokter.pengguna'])
            $konsultasi = JadwalKonsultasi::with(['pasien.pengguna:id,nama', 'dokter.pengguna:id,nama'])
                ->where('id_pasien', $pasien->id)
                ->orderByDesc('tanggal_konsultasi')
                ->get();
        }

        return view('konsultasi.index', compact('konsultasi'));
    }
    // Form ajukan konsultasi (Pasien)
    public function create(Request $request)
    {
        // dd(Auth::user(), $request->all());
        $dokter = Dokter::with('pengguna')->get();
        return view('konsultasi.create', compact('dokter'));
    }

    // Proses simpan konsultasi
    public function store(Request $request)
    {
        $request->validate([
            'id_dokter' => 'required|exists:dokter,id',
            'tanggal_konsultasi' => 'required|date',
            'keluhan' => 'required|string',
        ]);

        // dd($request->all());
        // $dokter = \App\Models\Dokter::where('id_pengguna', $request->id_dokter)->firstOrFail();
        // dd($dokter);
        // $dokter = \App\Models\Dokter::where('id_pengguna', $request->id_dokter)->first();
        // dd($dokter);
        $dokter = Dokter::findOrFail($request->id_dokter);
        $pasien = Pasien::where('id_pengguna', Auth::id())->firstOrFail();

        JadwalKonsultasi::create([
            'id_dokter' => $dokter->id,
            'id_pasien' => $pasien->id,
            'tanggal_konsultasi' => $request->tanggal_konsultasi,
            'keluhan' => $request->keluhan,
            'status' => 'Menunggu',
        ]);
        return redirect()->route('konsultasi.index');
    }

    // Detail konsultasi
    public function show($id)
    {
        $konsultasi = JadwalKonsultasi::with(['dokter.pengguna', 'pasien'])->findOrFail($id);
        return view('konsultasi.detail', compact('konsultasi'));
    }

    // Update status konsultasi (Dokter)
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Dijadwalkan,Dikonfirmasi,Selesai,Batal',
        ]);

        $konsultasi = JadwalKonsultasi::findOrFail($id);
        $konsultasi->update([
            'status' => $request->status,
        ]);

        return redirect()->route('konsultasi.index')->with('success', 'Status konsultasi diperbarui.');
    }

    // Tandai konsultasi selesai (Dokter)
    public function selesaikan(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|string',
        ]);

        $konsultasi = JadwalKonsultasi::findOrFail($id);
        $konsultasi->update([
            'status' => 'Selesai',
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('konsultasi.index')->with('success', 'Konsultasi ditandai sebagai selesai.');
    }
}
