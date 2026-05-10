@extends('layouts.admin')

@section('title', 'Laporan — StadionKu Admin')

@section('content')

<div class="admin-topbar">
    <div>
        <div class="admin-page-title">Laporan Transaksi</div>
        <div class="admin-page-sub">Filter dan export data transaksi</div>
    </div>
    <div style="display:flex;gap:8px">
        <a href="/admin/laporan/export-pdf?{{ request()->getQueryString() }}"
            style="background:#f87171;color:#0c0c0c;padding:9px 16px;border-radius:6px;font-size:13px;font-weight:600;text-decoration:none">
            ⬇ Export PDF
        </a>
        <a href="/admin/laporan/export-excel?{{ request()->getQueryString() }}"
            style="background:#4ade80;color:#0c0c0c;padding:9px 16px;border-radius:6px;font-size:13px;font-weight:600;text-decoration:none">
            ⬇ Export Excel
        </a>
    </div>
</div>

{{-- FILTER --}}
<div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:20px;margin-bottom:20px">
    <form method="GET" action="/admin/laporan">
        <div style="display:grid;grid-template-columns:1fr 1fr 1fr 1fr auto;gap:12px;align-items:end">
            <div>
                <label style="display:block;font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px">Tanggal Dari</label>
                <input type="date" name="tanggal_dari" value="{{ request('tanggal_dari') }}"
                    style="width:100%;background:var(--surface);border:1px solid var(--border);color:var(--text);padding:9px 12px;border-radius:7px;font-size:13px;font-family:var(--font);outline:none">
            </div>
            <div>
                <label style="display:block;font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px">Tanggal Sampai</label>
                <input type="date" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}"
                    style="width:100%;background:var(--surface);border:1px solid var(--border);color:var(--text);padding:9px 12px;border-radius:7px;font-size:13px;font-family:var(--font);outline:none">
            </div>
            <div>
                <label style="display:block;font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px">Status</label>
                <select name="status"
                    style="width:100%;background:var(--surface);border:1px solid var(--border);color:var(--text);padding:9px 12px;border-radius:7px;font-size:13px;font-family:var(--font);outline:none">
                    <option value="semua">Semua Status</option>
                    <option value="Pending" {{ request('status') === 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Lunas" {{ request('status') === 'Lunas' ? 'selected' : '' }}>Lunas</option>
                    <option value="Gagal" {{ request('status') === 'Gagal' ? 'selected' : '' }}>Gagal</option>
                </select>
            </div>
            <div>
                <label style="display:block;font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px">Metode Bayar</label>
                <select name="metode"
                    style="width:100%;background:var(--surface);border:1px solid var(--border);color:var(--text);padding:9px 12px;border-radius:7px;font-size:13px;font-family:var(--font);outline:none">
                    <option value="semua">Semua Metode</option>
                    <option value="QRIS" {{ request('metode') === 'QRIS' ? 'selected' : '' }}>QRIS</option>
                    <option value="Transfer Bank" {{ request('metode') === 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                    <option value="GoPay" {{ request('metode') === 'GoPay' ? 'selected' : '' }}>GoPay</option>
                    <option value="Dana" {{ request('metode') === 'Dana' ? 'selected' : '' }}>Dana</option>
                </select>
            </div>
            <div style="display:flex;gap:8px">
                <button type="submit"
                    style="background:var(--accent);color:#0c0c0c;padding:9px 18px;border-radius:7px;font-size:13px;font-weight:600;border:none;cursor:pointer;font-family:var(--font)">
                    Filter
                </button>
                <a href="/admin/laporan"
                    style="background:var(--surface);color:var(--muted);padding:9px 14px;border-radius:7px;font-size:13px;border:1px solid var(--border);text-decoration:none">
                    Reset
                </a>
            </div>
        </div>
    </form>
</div>

{{-- STATS --}}
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:20px">
    <div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:20px">
        <div style="font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:10px">Total Transaksi</div>
        <div style="font-size:26px;font-weight:700">{{ $transaksi->total() }}</div>
    </div>
    <div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:20px">
        <div style="font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:10px">Total Pendapatan (Lunas)</div>
        <div style="font-size:26px;font-weight:700;color:var(--accent)">
            Rp {{ number_format($totalLunas, 0, ',', '.') }}
        </div>
    </div>
    <div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:20px">
        <div style="font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:10px">Total Semua Transaksi</div>
        <div style="font-size:26px;font-weight:700">
            Rp {{ number_format($totalAll, 0, ',', '.') }}
        </div>
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
                    {{ $t->tiket->pertandingan->tim_tuan_rumah ?? '-' }} vs {{ $t->tiket->pertandingan->tim_tamu ?? '-' }}
                </td>
                <td style="padding:14px 16px;font-size:13px;color:var(--muted)">{{ $t->metode_bayar }}</td>
                <td style="padding:14px 16px;font-size:13px;font-weight:600;color:var(--accent)">
                    Rp {{ number_format($t->total_bayar, 0, ',', '.') }}
                </td>
                <td style="padding:14px 16px;font-size:12px;color:var(--muted);font-family:monospace">
                    {{ \Carbon\Carbon::parse($t->tgl_transaksi)->format('d M Y') }}
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
            </tr>
            @empty
            <tr>
                <td colspan="8" style="padding:40px;text-align:center;color:var(--muted)">
                    Tidak ada data transaksi.
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