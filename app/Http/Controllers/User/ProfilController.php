<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('user.profil.index', compact('user'));
    }

    public function updateProfil(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
        ], [
            'name.required'  => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique'   => 'Email sudah dipakai akun lain.',
        ]);

        $user = auth()->user();
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect('/profil')->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama'    => 'required',
            'password'         => 'required|min:8|confirmed',
        ], [
            'password_lama.required' => 'Password lama wajib diisi.',
            'password.required'      => 'Password baru wajib diisi.',
            'password.min'           => 'Password minimal 8 karakter.',
            'password.confirmed'     => 'Konfirmasi password tidak cocok.',
        ]);

        $user = auth()->user();

        // Cek password lama
        if (!Hash::check($request->password_lama, $user->password)) {
            return redirect('/profil')
                ->withErrors(['password_lama' => 'Password lama tidak sesuai.'])
                ->with('tab', 'password');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/profil')->with('success', 'Password berhasil diubah!');
    }
}