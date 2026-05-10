<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pertandingan;
use App\Models\Tiket;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $totalTiket  = Tiket::where('id_penonton', $user->id)->count();
        $totalNonton = Tiket::where('id_penonton', $user->id)
                            ->where('status_tiket', 'Digunakan')->count();
        $totalBayar  = Tiket::where('id_penonton', $user->id)
                            ->with('transaksi')
                            ->get()
                            ->sum(fn($t) => $t->transaksi->total_bayar ?? 0);

        $pertandingan = Pertandingan::with('stadion')
                            ->where('status', 'Dijual')
                            ->orderBy('tanggal_pertandingan')
                            ->take(3)
                            ->get();

        $riwayat = Tiket::with(['pertandingan.stadion', 'kursi', 'transaksi'])
                        ->where('id_penonton', $user->id)
                        ->latest()
                        ->take(3)
                        ->get();

        return view('user.dashboard', compact(
            'totalTiket', 'totalNonton', 'totalBayar',
            'pertandingan', 'riwayat'
        ));
    }
}