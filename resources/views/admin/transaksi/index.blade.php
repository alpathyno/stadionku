@extends('layouts.admin')

@section('title', 'Transaksi — StadionKu Admin')

@section('content')

<div class="admin-topbar">
    <div>
        <div class="admin-page-title">Transaksi</div>
        <div class="admin-page-sub">Kelola semua transaksi pemesanan tiket</div>
    </div>
</div>

@if(session('success'))
<div style="background:rgba(74,222,128,.1);border:1px solid rgba(74,222,128,.2);color:#4ade80;padding:12px 16px;border-radius:8px;margin-bottom:20px;font-size:13px">
    ✓ {{ session('success') }}
</div>
@endif

{{-- STATS --}}
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:24px">
    <div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:20px">
        <div style="font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:10px">Total Transaksi</div>
        <div style="font-size:26px;font-weight:700">{{ \App\Models\Transaksi::count() }}</div>
    </div>
    <div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:20px">
        <div style="font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:10px">Menunggu</div>
        <div style="font-size:26px;font-weight:700;color:#fbbf24">{{ \App\Models\Transaksi::where('status_bayar','Pending')->count() }}</div>
    </div>
    <div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:20px">
        <div style="font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:10px">Lunas</div>
        <div style="font-size:26px;font-weight:700;color:#4ade80">{{ \App\Models\Transaksi::where('status_bayar','Lunas')->count() }}</div>
    </div>
    <div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:20px">
        <div style="font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:10px">Gagal</div>
        <div style="font-size:26px;font-weight:700;color:#f87171">{{ \App\Models\Transaksi::where('status_bayar','Gagal')->count() }}</div>
    </div>
</div>

{{-- TABEL --}}
<div style="background:var(--card);border:1px solid var(--border);border-radius:10px;overflow:hidden">
    <table style="width:100%;border-collapse:collapse">
        <thead>
            <tr style="border-bottom:1px solid var(--border)">
                <th style="padding:12px 22px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">No</th>
                <th style="padding:12px 16px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">Kode Tiket</th>
                <th style="padding:12px 16px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">Penonton</th>
                <th style="padding:12px 16px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">Pertandingan</th>
                <th style="padding:12px 16px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">Metode</th>
                <th style="padding:12px 16px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">Total</th>
                <th style="padding:12px 16px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">Tanggal</th>
                <th style="padding:12px 16px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">Status</th>
                <th style="padding:12px 36px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksi as $index => $t)
            <tr style="border-bottom:1px solid rgba(34,34,34,.6);transition:background .15s"
                onmouseover="this.style.background='rgba(255,255,255,.015)'"
                onmouseout="this.style.background='transparent'">
                <td style="padding:14px 22px;color:var(--muted);font-size:13px">
                    {{ $transaksi->firstItem() + $index }}
                </td>
                <td style="padding:14px 16px;font-family:monospace;font-size:12px;color:var(--accent)">
                    {{ $t->tiket->kode_tiket ?? '-' }}
                </td>
                <td style="padding:14px 16px">
                    <div style="font-weight:500;font-size:13px">{{ $t->tiket->penonton->name ?? '-' }}</div>
                    <div style="font-size:11px;color:var(--muted)">{{ $t->tiket->penonton->email ?? '-' }}</div>
                </td>
                <td style="padding:14px 16px;font-size:13px">
                    {{ $t->tiket->pertandingan->tim_tuan_rumah ?? '-' }}
                    vs
                    {{ $t->tiket->pertandingan->tim_tamu ?? '-' }}
                </td>
                <td style="padding:14px 16px;font-size:13px;color:var(--muted)">
                    {{ $t->metode_bayar }}
                </td>
                <td style="padding:14px 16px;font-size:13px;font-weight:600;color:var(--accent)">
                    Rp {{ number_format($t->total_bayar, 0, ',', '.') }}
                </td>
                <td style="padding:14px 16px;font-size:12px;color:var(--muted);font-family:monospace">
                    {{ \Carbon\Carbon::parse($t->tgl_transaksi)->format('d M Y · H:i') }}
                </td>
                <td style="padding:14px 16px">
                    @if($t->status_bayar === 'Pending')
                        <span style="font-size:10px;font-family:monospace;padding:3px 10px;border-radius:100px;background:rgba(251,191,36,.1);color:#fbbf24;border:1px solid rgba(251,191,36,.2)">● Pending</span>
                    @elseif($t->status_bayar === 'Lunas')
                        <span style="font-size:10px;font-family:monospace;padding:3px 10px;border-radius:100px;background:rgba(74,222,128,.1);color:#4ade80;border:1px solid rgba(74,222,128,.2)">● Lunas</span>
                    @else
                        <span style="font-size:10px;font-family:monospace;padding:3px 10px;border-radius:100px;background:rgba(248,113,113,.1);color:#f87171;border:1px solid rgba(248,113,113,.2)">● Gagal</span>
                    @endif
                </td>
                <td style="padding:14px 16px">
                    @if($t->status_bayar === 'Pending')
                        <div style="display:flex;gap:6px;flex-wrap:wrap">
                            @if($t->bukti_bayar)
                                <a href="{{ asset('storage/' . $t->bukti_bayar) }}" target="_blank"
                                style="font-size:12px;color:#60a5fa;background:rgba(96,165,250,.1);border:1px solid rgba(96,165,250,.2);padding:5px 12px;border-radius:5px;text-decoration:none">
                                🖼 Bukti
                                </a>
                            @endif
                            <form method="POST" action="/admin/transaksi/{{ $t->id_transaksi }}/approve">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    style="font-size:12px;color:#4ade80;background:rgba(74,222,128,.1);border:1px solid rgba(74,222,128,.2);padding:5px 12px;border-radius:5px;cursor:pointer;font-family:var(--font)">
                                    Approve
                                </button>
                            </form>
                            <form method="POST" action="/admin/transaksi/{{ $t->id_transaksi }}/tolak"
                                onsubmit="return confirm('Yakin ingin menolak transaksi ini?')">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    style="font-size:12px;color:#f87171;background:rgba(248,113,113,.1);border:1px solid rgba(248,113,113,.2);padding:5px 12px;border-radius:5px;cursor:pointer;font-family:var(--font)">
                                    Tolak
                                </button>
                            </form>
                        </div>
                    @elseif($t->status_bayar === 'Lunas')
                        <div style="display:flex;gap:6px">
                            @if($t->bukti_bayar)
                                <a href="{{ asset('storage/' . $t->bukti_bayar) }}" target="_blank"
                                    style="font-size:12px;color:#60a5fa;background:rgba(96,165,250,.1);border:1px solid rgba(96,165,250,.2);padding:5px 12px;border-radius:5px;text-decoration:none">
                                    🖼 Bukti
                                </a>
                            @endif
                            <a href="/admin/transaksi/{{ $t->tiket->id_tiket }}/tiket"
                                style="font-size:12px;color:#0c0c0c;background:var(--accent);padding:5px 12px;border-radius:5px;text-decoration:none;font-weight:600">
                                ⬇ Tiket
                            </a>
                        </div>
                    @else
                        <div style="display:flex;gap:6px">
                            @if($t->bukti_bayar)
                                <a href="{{ asset('storage/' . $t->bukti_bayar) }}" target="_blank"
                                    style="font-size:12px;color:#60a5fa;background:rgba(96,165,250,.1);border:1px solid rgba(96,165,250,.2);padding:5px 12px;border-radius:5px;text-decoration:none">
                                    🖼 Bukti
                                </a>
                            @else
                                <span style="font-size:12px;color:var(--muted)">—</span>
                            @endif
                        </div>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" style="padding:40px;text-align:center;color:var(--muted);font-size:13px">
                    Belum ada transaksi.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($transaksi->hasPages())
    <div style="padding:14px 22px;border-top:1px solid var(--border);display:flex;justify-content:flex-end">
        {{ $transaksi->links() }}
    </div>
    @endif
</div>

@endsection