<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tiket;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = \App\Models\Transaksi::with(['tiket.penonton', 'tiket.pertandingan.stadion', 'tiket.kursi'])
            ->orderBy('tgl_transaksi', 'desc')
            ->get()
            ->groupBy('kode_booking');

        return view('admin.transaksi.index', compact('transaksi'));
    }  

    public function approve($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status_bayar = 'Lunas';
        $transaksi->save();

        // Update status tiket jadi Aktif
        $transaksi->tiket->status_tiket = 'Aktif';
        $transaksi->tiket->save();

        return redirect('/admin/transaksi')
            ->with('success', 'Transaksi berhasil dikonfirmasi!');
    }

    public function tolak($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status_bayar = 'Gagal';
        $transaksi->save();

        // Update status tiket jadi Dibatalkan
        $transaksi->tiket->status_tiket = 'Dibatalkan';
        $transaksi->tiket->save();

        return redirect('/admin/transaksi')
            ->with('success', 'Transaksi berhasil ditolak.');
    }

    public function downloadTiket($id)
    {
        $tiket = \App\Models\Tiket::with(['pertandingan.stadion', 'penonton', 'transaksi'])
                ->findOrFail($id);

        if ($tiket->status_tiket !== 'Aktif') {
            return redirect()->back()->with('error', 'Tiket belum dikonfirmasi!');
        }

        $pdf = Pdf::loadView('pdf.tiket', compact('tiket'))
            ->setPaper('a5', 'portrait');

            return $pdf->download('tiket-' . $tiket->kode_tiket . '.pdf');
        }

        public function approveBooking($kode)
        {
        $transaksis = Transaksi::where('kode_booking', $kode)->get();
        foreach ($transaksis as $t) {
            $t->status_bayar = 'Lunas';
            $t->save();
            $t->tiket->status_tiket = 'Aktif';
            $t->tiket->save();
        }
        return redirect('/admin/transaksi')->with('success', 'Booking berhasil dikonfirmasi!');
    }

        public function tolakBooking($kode)
        {
            $transaksis = Transaksi::where('kode_booking', $kode)->get();
            foreach ($transaksis as $t) {
                $t->status_bayar = 'Gagal';
                $t->save();
                $t->tiket->status_tiket = 'Dibatalkan';
                $t->tiket->save();
            }
            return redirect('/admin/transaksi')->with('success', 'Booking berhasil ditolak.');
        }
}