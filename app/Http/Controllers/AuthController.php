<?php

namespace App\Http\Controllers;

use App\Models\Jamaah;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'kata_sandi' => 'required'
        ]);

        $jamaah = Jamaah::where('username', $request->username)->first();

        if (!$jamaah || !password_verify($request->kata_sandi, $jamaah->kata_sandi)) {
            return back()->with('error', 'Username atau password salah.');
        }

        session(['jamaah_id' => $jamaah->id_jamaah]);

        return redirect('/dashboard');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:jamaah',
            'kata_sandi' => 'required|min:5',
            'nama_lengkap' => 'required'
        ]);

        $jamaah = Jamaah::create([
            'username' => $request->username,
            'kata_sandi' => bcrypt($request->kata_sandi),
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => 'L'
        ]);

        session(['jamaah_id' => $jamaah->id_jamaah]);

        return redirect('/dashboard');
    }

    public function logout()
    {
        session()->forget('jamaah_id');
        return redirect('/login')->with('success', 'Berhasil logout.');
    }

    public function profile()
{
    $jamaah = \App\Models\Jamaah::find(session('jamaah_id'));

    return view('profile', [
        'jamaah' => $jamaah
    ]);
}

public function updateProfile(Request $request)
{
    $jamaah = \App\Models\Jamaah::find(session('jamaah_id'));

    $request->validate([
        'username' => "required|unique:jamaah,username,$jamaah->id_jamaah,id_jamaah",
        'nama_lengkap' => 'required',
        'tanggal_lahir' => 'nullable|date',
        'no_handphone' => 'nullable',
        'alamat' => 'nullable',
        'kata_sandi' => 'nullable|min:5'
    ]);

    $jamaah->username = $request->username;
    $jamaah->nama_lengkap = $request->nama_lengkap;
    $jamaah->tanggal_lahir = $request->tanggal_lahir;
    $jamaah->no_handphone = $request->no_handphone;
    $jamaah->alamat = $request->alamat;

    if ($request->filled('kata_sandi')) {
        $jamaah->kata_sandi = bcrypt($request->kata_sandi);
    }

    $jamaah->save();

    return back()->with('success', 'Profil berhasil diperbarui!');
}

}
