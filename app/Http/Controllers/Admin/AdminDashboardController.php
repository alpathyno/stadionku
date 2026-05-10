<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pertandingan;
use App\Models\Tiket;
use App\Models\Transaksi;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalTiket      = Tiket::count();
        $totalPendapatan = Transaksi::where('status_bayar', 'Lunas')->sum('total_bayar');
        $totalPenonton   = User::where('role', 'user')->count();

        $pertandingan = Pertandingan::with(['stadion', 'tiket'])
                            ->orderBy('tanggal_pertandingan', 'desc')
                            ->take(5)
                            ->get();

        return view('admin.dashboard', compact(
            'totalTiket', 'totalPendapatan', 'totalPenonton', 'pertandingan'
        ));
    }
}