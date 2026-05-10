<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Tiket;
use App\Models\Transaksi;
use App\Models\Pertandingan;
use App\Models\Kursi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookingController extends Controller
{
   public function store(Request $request)
{
    $request->validate([
        'id_pertandingan' => 'required|exists:pertandingan,id_pertandingan',
        'zona'            => 'required|in:VIP,Tribune,Economy',
        'id_kursi'        => 'required',
        'harga'           => 'required|numeric',
        'metode_bayar'    => 'required',
        'bukti_bayar'     => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ], [
        'bukti_bayar.required' => 'Bukti pembayaran wajib diupload.',
        'bukti_bayar.image'    => 'File harus berupa gambar.',
        'bukti_bayar.max'      => 'Ukuran file maksimal 2MB.',
    ]);

    $pertandingan = \App\Models\Pertandingan::findOrFail($request->id_pertandingan);
    $kursiList    = explode(',', $request->id_kursi);

    // Upload bukti bayar sekali saja
    $pathBukti = $request->file('bukti_bayar')->store('bukti_bayar', 'public');

    foreach ($kursiList as $kursiLabel) {
        $prefix = match($request->zona) {
            'VIP'     => 'VIP',
            'Tribune' => 'TRB',
            'Economy' => 'ECO',
        };
        $nomorKursi = $prefix . '-' . $kursiLabel;

        $kursi = \App\Models\Kursi::where('id_stadion', $pertandingan->id_stadion)
                                  ->where('nomor_kursi', $nomorKursi)
                                  ->where('kategori', $request->zona)
                                  ->first();

        if (!$kursi) {
            return back()->withErrors(['id_kursi' => "Kursi $nomorKursi tidak ditemukan."]);
        }

        $tiket = Tiket::create([
            'id_pertandingan' => $request->id_pertandingan,
            'id_penonton'     => auth()->id(),
            'id_kursi'        => $kursi->id_kursi,
            'kode_tiket'      => 'TKT-' . strtoupper(\Illuminate\Support\Str::random(8)),
            'harga'           => $request->harga,
            'status_tiket'    => 'Pending',
            'tgl_pembelian'   => now(),
        ]);

        Transaksi::create([
            'id_tiket'      => $tiket->id_tiket,
            'metode_bayar'  => $request->metode_bayar,
            'bukti_bayar'   => $pathBukti,
            'total_bayar'   => $request->harga + 15000,
            'tgl_transaksi' => now(),
            'status_bayar'  => 'Pending',
        ]);
    }

    return redirect('/riwayat')->with('success', 'Pemesanan berhasil! Menunggu konfirmasi admin.');
}}