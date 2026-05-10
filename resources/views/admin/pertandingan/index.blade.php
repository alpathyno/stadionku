@extends('layouts.admin')

@section('title', 'Pertandingan — StadionKu Admin')

@section('content')

<div class="admin-topbar">
    <div>
        <div class="admin-page-title">Pertandingan</div>
        <div class="admin-page-sub">Kelola semua data pertandingan</div>
    </div>
    <a href="/admin/pertandingan/create"
        style="background:var(--accent);color:#0c0c0c;padding:9px 20px;border-radius:6px;font-size:13px;font-weight:600;text-decoration:none">
        + Tambah Pertandingan
    </a>
</div>

{{-- ALERT SUCCESS --}}
@if(session('success'))
<div style="background:rgba(74,222,128,.1);border:1px solid rgba(74,222,128,.2);color:#4ade80;padding:12px 16px;border-radius:8px;margin-bottom:20px;font-size:13px">
    ✓ {{ session('success') }}
</div>
@endif

{{-- TABEL --}}
<div style="background:var(--card);border:1px solid var(--border);border-radius:10px;overflow:hidden">
    <table style="width:100%;border-collapse:collapse">
        <thead>
            <tr style="border-bottom:1px solid var(--border)">
                <th style="padding:12px 22px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">No</th>
                <th style="padding:12px 16px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">Pertandingan</th>
                <th style="padding:12px 16px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">Tanggal</th>
                <th style="padding:12px 16px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">Stadion</th>
                <th style="padding:12px 16px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">Harga Min</th>
                <th style="padding:12px 16px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">Status</th>
                <th style="padding:12px 16px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pertandingan as $index => $p)
            <tr style="border-bottom:1px solid rgba(34,34,34,.6);transition:background .15s"
                onmouseover="this.style.background='rgba(255,255,255,.015)'"
                onmouseout="this.style.background='transparent'">

                <td style="padding:14px 22px;color:var(--muted);font-size:13px">
                    {{ $pertandingan->firstItem() + $index }}
                </td>
                <td style="padding:14px 16px;font-weight:500">
                    {{ $p->tim_tuan_rumah }} vs {{ $p->tim_tamu }}
                </td>
                <td style="padding:14px 16px;font-size:12px;color:var(--muted);font-family:monospace">
                    {{ \Carbon\Carbon::parse($p->tanggal_pertandingan)->format('d M Y') }}
                    · {{ \Carbon\Carbon::parse($p->jam_mulai)->format('H:i') }}
                </td>
                <td style="padding:14px 16px;font-size:13px;color:var(--muted)">
                    {{ $p->stadion->nama_stadion ?? '-' }}
                </td>
                <td style="padding:14px 16px;font-size:13px;font-weight:600;color:var(--accent)">
                    Rp {{ number_format($p->harga_min, 0, ',', '.') }}
                </td>
                <td style="padding:14px 16px">
                    @if($p->status === 'Dijual')
                        <span style="font-size:10px;font-family:monospace;padding:3px 10px;border-radius:100px;background:rgba(74,222,128,.1);color:#4ade80;border:1px solid rgba(74,222,128,.2)">● Dijual</span>
                    @elseif($p->status === 'Selesai')
                        <span style="font-size:10px;font-family:monospace;padding:3px 10px;border-radius:100px;background:rgba(96,96,96,.15);color:#888;border:1px solid #2e2e2e">● Selesai</span>
                    @elseif($p->status === 'Terjadwal')
                        <span style="font-size:10px;font-family:monospace;padding:3px 10px;border-radius:100px;background:rgba(251,191,36,.1);color:#fbbf24;border:1px solid rgba(251,191,36,.2)">● Terjadwal</span>
                    @elseif($p->status === 'Berlangsung')
                        <span style="font-size:10px;font-family:monospace;padding:3px 10px;border-radius:100px;background:rgba(96,165,250,.1);color:#60a5fa;border:1px solid rgba(96,165,250,.2)">● Berlangsung</span>
                    @else
                        <span style="font-size:10px;font-family:monospace;padding:3px 10px;border-radius:100px;background:rgba(248,113,113,.1);color:#f87171;border:1px solid rgba(248,113,113,.2)">● {{ $p->status }}</span>
                    @endif
                </td>
                <td style="padding:14px 16px">
                    <div style="display:flex;gap:6px">
                        <a href="/admin/pertandingan/{{ $p->id_pertandingan }}/edit"
                            style="font-size:12px;color:var(--text);text-decoration:none;border:1px solid var(--border);padding:5px 12px;border-radius:5px;transition:border-color .15s"
                            onmouseover="this.style.borderColor='var(--muted)'"
                            onmouseout="this.style.borderColor='var(--border)'">
                            Edit
                        </a>
                        <form method="POST" action="/admin/pertandingan/{{ $p->id_pertandingan }}"
                            onsubmit="return confirm('Yakin ingin menghapus pertandingan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                style="font-size:12px;color:#f87171;background:rgba(248,113,113,.1);border:1px solid rgba(248,113,113,.2);padding:5px 12px;border-radius:5px;cursor:pointer;font-family:var(--font);transition:all .15s"
                                onmouseover="this.style.background='rgba(248,113,113,.2)'"
                                onmouseout="this.style.background='rgba(248,113,113,.1)'">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="padding:40px;text-align:center;color:var(--muted)">
                    Belum ada data pertandingan.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- PAGINATION --}}
    @if($pertandingan->hasPages())
    <div style="padding:14px 22px;border-top:1px solid var(--border);display:flex;justify-content:flex-end">
        {{ $pertandingan->links() }}
    </div>
    @endif
</div>

@endsection