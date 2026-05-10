@extends('layouts.user')

@section('title', 'Riwayat Tiket — StadionKu')

@section('content')

{{-- HEADER --}}
<div style="margin-bottom:28px">
    <div style="font-size:11px;color:var(--accent);text-transform:uppercase;letter-spacing:1px;margin-bottom:6px">Aktivitas</div>
    <div style="font-size:22px;font-weight:700;letter-spacing:-.5px">Riwayat Tiket</div>
    <div style="font-size:13px;color:var(--muted);margin-top:4px">Semua tiket yang pernah kamu beli.</div>
</div>

{{-- ALERT --}}
@if(session('success'))
<div style="background:rgba(74,222,128,.1);border:1px solid rgba(74,222,128,.2);color:#4ade80;padding:12px 16px;border-radius:8px;margin-bottom:20px;font-size:13px">
    ✓ {{ session('success') }}
</div>
@endif

{{-- LIST --}}
@forelse($tikets as $t)
<div style="background:var(--card);border:1px solid var(--border);border-radius:10px;overflow:hidden;margin-bottom:12px">
    <div style="padding:16px 22px;display:flex;justify-content:space-between;align-items:start;gap:16px">
        <div>
            <div style="font-size:15px;font-weight:600;margin-bottom:5px">
                {{ $t->pertandingan->tim_tuan_rumah }} vs {{ $t->pertandingan->tim_tamu }}
            </div>
            <div style="font-size:12px;color:var(--muted)">
                {{ \Carbon\Carbon::parse($t->pertandingan->tanggal_pertandingan)->format('D, d M Y') }}
                · {{ $t->pertandingan->stadion->nama_stadion ?? '-' }}
            </div>
        </div>
        <div style="text-align:right;flex-shrink:0">
            <div style="font-size:15px;font-weight:600;color:var(--accent);margin-bottom:6px">
                Rp {{ number_format($t->transaksi->total_bayar ?? 0, 0, ',', '.') }}
            </div>
            @if($t->status_tiket === 'Aktif')
                <span style="font-size:10px;font-family:monospace;padding:3px 9px;border-radius:100px;background:rgba(74,222,128,.1);color:#4ade80;border:1px solid rgba(74,222,128,.2)">● Aktif</span>
            @elseif($t->status_tiket === 'Pending')
                <span style="font-size:10px;font-family:monospace;padding:3px 9px;border-radius:100px;background:rgba(251,191,36,.1);color:#fbbf24;border:1px solid rgba(251,191,36,.2)">● Menunggu Konfirmasi</span>
            @elseif($t->status_tiket === 'Digunakan')
                <span style="font-size:10px;font-family:monospace;padding:3px 9px;border-radius:100px;background:rgba(96,96,96,.15);color:#888;border:1px solid #2e2e2e">● Digunakan</span>
            @else
                <span style="font-size:10px;font-family:monospace;padding:3px 9px;border-radius:100px;background:rgba(248,113,113,.1);color:#f87171;border:1px solid rgba(248,113,113,.2)">● Dibatalkan</span>
            @endif
        </div>
    </div>
    <div style="padding:12px 22px;background:var(--surface);border-top:1px solid var(--border);display:flex;gap:20px;align-items:center;flex-wrap:wrap">
        <div style="font-size:12px;color:var(--muted)">
            Kode: <strong style="color:var(--text);font-family:monospace">{{ $t->kode_tiket }}</strong>
        </div>
        <div style="font-size:12px;color:var(--muted)">
            Metode: <strong style="color:var(--text)">{{ $t->transaksi->metode_bayar ?? '-' }}</strong>
        </div>
        <div style="font-size:12px;color:var(--muted)">
            Tanggal Beli: <strong style="color:var(--text)">{{ \Carbon\Carbon::parse($t->tgl_pembelian)->format('d M Y, H:i') }}</strong>
        </div>
        @if($t->status_tiket === 'Aktif')
        <div style="margin-left:auto">
            <a href="/riwayat/{{ $t->id_tiket }}/tiket"
                style="font-size:12px;color:#0c0c0c;background:var(--accent);text-decoration:none;padding:7px 16px;border-radius:6px;font-weight:600">
                Lihat Tiket
            </a>
        </div>
        @endif
    </div>
</div>
@empty
<div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:48px;text-align:center">
    <div style="font-size:32px;margin-bottom:12px">🎫</div>
    <div style="font-size:15px;font-weight:600;margin-bottom:6px">Belum ada tiket</div>
    <div style="font-size:13px;color:var(--muted);margin-bottom:20px">Kamu belum pernah membeli tiket pertandingan.</div>
    <a href="/pertandingan"
        style="background:var(--accent);color:#0c0c0c;padding:10px 24px;border-radius:8px;font-size:13px;font-weight:600;text-decoration:none">
        Lihat Pertandingan
    </a>
</div>
@endforelse

@endsection