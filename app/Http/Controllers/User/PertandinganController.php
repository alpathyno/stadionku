<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pertandingan;

class PertandinganController extends Controller
{
    public function index()
    {
        $pertandingan = Pertandingan::with('stadion')
                            ->orderBy('tanggal_pertandingan', 'asc')
                            ->get();

        return view('user.pertandingan.index', compact('pertandingan'));
    }

    public function show($id)
    {
        $pertandingan = Pertandingan::with('stadion')->findOrFail($id);

        return view('user.pertandingan.show', compact('pertandingan'));
    }
}