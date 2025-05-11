<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Obat;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    // Menampilkan daftar transaksi berdasarkan pasien
    public function index()
    {
        $transaksi = Transaksi::where('id_pasien', Auth::id())->get();
        return view('transaksi.index', compact('transaksi'));
    }

    // Menampilkan form tambah transaksi (hanya pasien)
    public function create()
    {
        $obat = Obat::all();
        return view('transaksi.create', compact('obat'));
    }

    // Menyimpan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'id_obat' => 'required|exists:obat,id',
            'jumlah' => 'required|integer|min:1'
        ]);

        $obat = Obat::findOrFail($request->id_obat);
        $totalHarga = $obat->harga * $request->jumlah;

        Transaksi::create([
            'id_pasien' => Auth::id(),
            'id_obat' => $request->id_obat,
            'jumlah' => $request->jumlah,
            'total_harga' => $totalHarga,
            'tanggal_transaksi' => now()
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dibuat!');
    }
}
