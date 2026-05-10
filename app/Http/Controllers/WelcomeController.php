<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    // WelcomeController.php
public function index()
{
    // Redirect kalau sudah login
    if (auth()->check()) {
        if (auth()->user()->role === 'admin') {
            return redirect('/admin/dashboard');
        }
        return redirect('/dashboard');
    }

    $pertandingan = \App\Models\Pertandingan::with('stadion')
        ->where('status', 'Dijual')
        ->where('tanggal_pertandingan', '>=', now()->toDateString())
        ->orderBy('tanggal_pertandingan')
        ->take(5)
        ->get();

    return view('welcome', compact('pertandingan'));

    return response()->view('welcome', compact('pertandingan'))
    ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
    ->header('Pragma', 'no-cache')
    ->header('Expires', '0');
}
}
