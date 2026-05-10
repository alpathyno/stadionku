<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransaksiExport;

class LaporanController extends Controller
{
    public function index(Request $request)
{
    $query = Transaksi::with(['tiket.pertandingan', 'tiket.penonton'])
                ->orderBy('tgl_transaksi', 'desc');

    // Filter tanggal
    if ($request->filled('tanggal_dari')) {
        $query->whereDate('tgl_transaksi', '>=', $request->tanggal_dari);
    }
    if ($request->filled('tanggal_sampai')) {
        $query->whereDate('tgl_transaksi', '<=', $request->tanggal_sampai);
    }

    // Filter status
    if ($request->filled('status') && $request->status !== 'semua') {
        $query->where('status_bayar', $request->status);
    }

    // Filter metode
    if ($request->filled('metode') && $request->metode !== 'semua') {
        $query->where('metode_bayar', $request->metode);
    }

    // Clone query untuk hitung total sebelum paginate
    $queryClone = clone $query;

    $totalLunas = (clone $query)->where('status_bayar', 'Lunas')->sum('total_bayar');
    $totalAll   = (clone $queryClone)->sum('total_bayar');

    $transaksi = $query->paginate(15)->withQueryString();

    return view('admin.laporan.index', compact('transaksi', 'totalLunas', 'totalAll'));
}

    public function exportPdf(Request $request)
    {
        $query = Transaksi::with(['tiket.pertandingan', 'tiket.penonton'])
                    ->orderBy('tgl_transaksi', 'desc');

        if ($request->tanggal_dari) {
            $query->whereDate('tgl_transaksi', '>=', $request->tanggal_dari);
        }
        if ($request->tanggal_sampai) {
            $query->whereDate('tgl_transaksi', '<=', $request->tanggal_sampai);
        }
        if ($request->status && $request->status !== 'semua') {
            $query->where('status_bayar', $request->status);
        }
        if ($request->metode && $request->metode !== 'semua') {
            $query->where('metode_bayar', $request->metode);
        }

        $transaksi  = $query->get();
        $totalLunas = $transaksi->where('status_bayar', 'Lunas')->sum('total_bayar');

        $pdf = Pdf::loadView('pdf.laporan', compact('transaksi', 'totalLunas'))
                  ->setPaper('a4', 'landscape');

        return $pdf->download('laporan-transaksi-' . now()->format('Y-m-d') . '.pdf');
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(
            new TransaksiExport($request->all()),
            'laporan-transaksi-' . now()->format('Y-m-d') . '.xlsx'
        );
    }
}