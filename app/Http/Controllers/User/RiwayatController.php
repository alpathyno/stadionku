<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Tiket;
use Barryvdh\DomPDF\Facade\Pdf;

class RiwayatController extends Controller
{
    public function index()
    {
        $tikets = Tiket::with(['pertandingan.stadion', 'transaksi'])
                    ->where('id_penonton', auth()->id())
                    ->latest()
                    ->get();

        return view('user.riwayat.index', compact('tikets'));
    }
    
    public function downloadTiket($id)
    {
        $tiket = \App\Models\Tiket::with(['pertandingan.stadion', 'penonton', 'transaksi'])
                ->where('id_penonton', auth()->id())
                ->findOrFail($id);

        if ($tiket->status_tiket !== 'Aktif') {
        return redirect()->back()->with('error', 'Tiket belum dikonfirmasi admin!');
        }

        $pdf = Pdf::loadView('pdf.tiket', compact('tiket'))
              ->setPaper('a5', 'portrait');

        return $pdf->download('tiket-' . $tiket->kode_tiket . '.pdf');
}
}