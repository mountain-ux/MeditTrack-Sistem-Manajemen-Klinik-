<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    // Menampilkan daftar pengguna (hanya admin yang dapat mengakses)
    public function index()
    {
        $pengguna = Pengguna::all();
        return view('pengguna.index', compact('pengguna'));
    }

    // Menampilkan form tambah dokter (hanya admin)
    public function create()
    {
        return view('pengguna.create');
    }

    // Menyimpan data dokter baru
    public function store(Request $request)
    {
        $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email|unique:pengguna',
        'password' => 'required|min:6',
        'peran' => 'required|in:admin,dokter',
    ]);

    Pengguna::create([
        'nama' => $request->nama,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'peran' => $request->peran,
    ]);

        return redirect()->route('pengguna.index')->with('success', 'Dokter berhasil ditambahkan!');
    }

    // Menampilkan form edit pengguna
    public function edit($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        return view('pengguna.edit', compact('pengguna'));
    }

    // Menyimpan perubahan data pengguna
    public function update(Request $request, $id)
    {
        $pengguna = Pengguna::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pengguna,email,' . $id,
        ]);

        $pengguna->update([
            'nama' => $request->nama,
            'email' => $request->email,
        ]);

        return redirect()->route('pengguna.index')->with('success', 'Data pengguna berhasil diperbarui!');
    }

    // Menghapus pengguna
    public function destroy($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        $pengguna->delete();

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil dihapus!');
    }
}
