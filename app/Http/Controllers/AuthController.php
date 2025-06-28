<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengguna;
use App\Models\Pasien;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    // Menampilkan halaman registrasi
    public function showRegister()
    {
        return view('auth.register');
    }

    // Proses registrasi
    public function register(Request $request)
    {
        $request->validate([
            'nama'           => 'required|string|max:255',
            'email'          => 'required|email|unique:pengguna,email',
            'password'       => 'required|string|min:6|confirmed',
            'tanggal_lahir'  => 'required|date',
            'jenis_kelamin'  => 'required|string',
            'telepon'        => 'required|string|max:20',
            'alamat'         => 'required|string|max:255',
            'riwayat_medis'  => 'nullable|string'
        ]);

        // Simpan ke tabel pengguna
        $user = Pengguna::create([
            'nama'     => $request->nama,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'peran'    => 'Pasien'
        ]);

        // Simpan ke tabel pasien
        Pasien::create([
            'id_pengguna'   => $user->id,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'telepon'       => $request->telepon,
            'alamat'        => $request->alamat,
            'riwayat_medis' => $request->riwayat_medis
        ]);

        return redirect()->route('auth.login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }
}
