@extends('layouts.admin')

@section('title', 'Dashboard Admin — StadionKu')

@section('content')

<div class="admin-topbar">
    <div>
        <div class="admin-page-title">Dashboard</div>
        <div class="admin-page-sub">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</div>
    </div>
    <a href="/admin/pertandingan/create"
        style="background:var(--accent);color:#0c0c0c;padding:9px 20px;border-radius:6px;font-size:13px;font-weight:600;text-decoration:none;transition:background .15s"
        onmouseover="this.style.background='#a8d420'"
        onmouseout="this.style.background='var(--accent)'">
        + Tambah Pertandingan
    </a>
</div>

{{-- STATS --}}
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:28px">
    <div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:22px">
        <div style="font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:12px">Tiket Terjual</div>
        <div style="font-size:32px;font-weight:700;color:var(--accent);letter-spacing:-1px">{{ number_format($totalTiket) }}</div>
        <div style="font-size:11px;color:#4ade80;margin-top:6px">↑ Transaksi lunas</div>
    </div>
    <div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:22px">
        <div style="font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:12px">Total Pendapatan</div>
        <div style="font-size:32px;font-weight:700;letter-spacing:-1px">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
        <div style="font-size:11px;color:#4ade80;margin-top:6px">↑ Dari semua transaksi lunas</div>
    </div>
    <div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:22px">
        <div style="font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:12px">Penonton Terdaftar</div>
        <div style="font-size:32px;font-weight:700;letter-spacing:-1px">{{ number_format($totalPenonton) }}</div>
        <div style="font-size:11px;color:#4ade80;margin-top:6px">↑ Total akun user aktif</div>
    </div>
</div>

{{-- TABEL PERTANDINGAN --}}
<div style="background:var(--card);border:1px solid var(--border);border-radius:10px;overflow:hidden">
    <div style="padding:16px 22px;border-bottom:1px solid var(--border);display:flex;justify-content:space-between;align-items:center">
        <div style="font-size:14px;font-weight:600">Pertandingan Mendatang</div>
        <a href="/admin/pertandingan" style="font-size:12px;color:var(--accent);text-decoration:none">Lihat Semua →</a>
    </div>
    <table style="width:100%;border-collapse:collapse">
        <thead>
            <tr style="border-bottom:1px solid var(--border)">
                <th style="padding:11px 22px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">Pertandingan</th>
                <th style="padding:11px 16px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">Tanggal</th>
                <th style="padding:11px 16px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">Stadion</th>
                <th style="padding:11px 16px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">Tiket Terjual</th>
                <th style="padding:11px 16px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">Pendapatan</th>
                <th style="padding:11px 16px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">Status</th>
                <th style="padding:11px 16px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($pertandingan as $p)
            <tr style="border-bottom:1px solid rgba(34,34,34,.6);transition:background .15s"
                onmouseover="this.style.background='rgba(255,255,255,.015)'"
                onmouseout="this.style.background='transparent'">
                <td style="padding:14px 22px;font-weight:500">
                    {{ $p->tim_tuan_rumah }} vs {{ $p->tim_tamu }}
                </td>
                <td style="padding:14px 16px;font-size:12px;color:var(--muted);font-family:monospace">
                    {{ \Carbon\Carbon::parse($p->tanggal_pertandingan)->format('d M Y') }}
                </td>
                <td style="padding:14px 16px;font-size:13px;color:var(--muted)">
                    {{ $p->stadion->nama_stadion ?? '-' }}
                </td>
                <td style="padding:14px 16px;font-size:13px">
                    {{ $p->tiket->count() }} / {{ number_format($p->stadion->kapasitas ?? 0) }}
                </td>
                <td style="padding:14px 16px;font-size:13px;font-weight:600;color:var(--accent)">
                    Rp {{ number_format($p->tiket->filter(fn($t) => $t->transaksi && $t->transaksi->status_bayar === 'Lunas')->sum('harga'), 0, ',', '.') }}
                </td>
                <td style="padding:14px 16px">
                    @if($p->status === 'Dijual')
                        <span style="font-size:10px;font-family:monospace;padding:3px 10px;border-radius:100px;background:rgba(74,222,128,.1);color:#4ade80;border:1px solid rgba(74,222,128,.2)">● Dijual</span>
                    @elseif($p->status === 'Selesai')
                        <span style="font-size:10px;font-family:monospace;padding:3px 10px;border-radius:100px;background:rgba(96,96,96,.15);color:#888;border:1px solid #2e2e2e">● Selesai</span>
                    @elseif($p->status === 'Terjadwal')
                        <span style="font-size:10px;font-family:monospace;padding:3px 10px;border-radius:100px;background:rgba(251,191,36,.1);color:#fbbf24;border:1px solid rgba(251,191,36,.2)">● Terjadwal</span>
                    @else
                        <span style="font-size:10px;font-family:monospace;padding:3px 10px;border-radius:100px;background:rgba(248,113,113,.1);color:#f87171;border:1px solid rgba(248,113,113,.2)">● {{ $p->status }}</span>
                    @endif
                </td>
                <td style="padding:14px 16px">
                    <a href="/admin/pertandingan/{{ $p->id_pertandingan }}/edit"
                        style="font-size:12px;color:var(--text);text-decoration:none;border:1px solid var(--border);padding:5px 12px;border-radius:5px">
                        Edit
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="padding:32px;text-align:center;color:var(--muted)">
                    Belum ada data pertandingan.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection