@extends('layouts.admin')

@section('title', 'Stadion — StadionKu Admin')

@section('content')

<div class="admin-topbar">
    <div>
        <div class="admin-page-title">Stadion</div>
        <div class="admin-page-sub">Kelola data stadion pertandingan</div>
    </div>
    <a href="/admin/stadion/create"
        style="background:var(--accent);color:#0c0c0c;padding:9px 20px;border-radius:6px;font-size:13px;font-weight:600;text-decoration:none">
        + Tambah Stadion
    </a>
</div>

@if(session('success'))
<div style="background:rgba(74,222,128,.1);border:1px solid rgba(74,222,128,.2);color:#4ade80;padding:12px 16px;border-radius:8px;margin-bottom:20px;font-size:13px">
    ✓ {{ session('success') }}
</div>
@endif

<div style="background:var(--card);border:1px solid var(--border);border-radius:10px;overflow:hidden">
    <table style="width:100%;border-collapse:collapse">
        <thead>
            <tr style="border-bottom:1px solid var(--border)">
                <th style="padding:12px 22px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">No</th>
                <th style="padding:12px 16px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">Nama Stadion</th>
                <th style="padding:12px 16px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">Kota</th>
                <th style="padding:12px 16px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">Kapasitas</th>
                <th style="padding:12px 16px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">Pertandingan</th>
                <th style="padding:12px 16px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($stadions as $index => $s)
            <tr style="border-bottom:1px solid rgba(34,34,34,.6);transition:background .15s"
                onmouseover="this.style.background='rgba(255,255,255,.015)'"
                onmouseout="this.style.background='transparent'">
                <td style="padding:14px 22px;color:var(--muted);font-size:13px">
                    {{ $stadions->firstItem() + $index }}
                </td>
                <td style="padding:14px 16px">
                    <div style="font-weight:500">{{ $s->nama_stadion }}</div>
                    <div style="font-size:11px;color:var(--muted);margin-top:2px">{{ $s->alamat }}</div>
                </td>
                <td style="padding:14px 16px;font-size:13px;color:var(--muted)">{{ $s->kota }}</td>
                <td style="padding:14px 16px;font-size:13px">
                    {{ number_format($s->kapasitas) }} kursi
                </td>
                <td style="padding:14px 16px;font-size:13px">
                    <span style="color:var(--accent);font-weight:600">{{ $s->pertandingan_count }}</span>
                    <span style="color:var(--muted)"> pertandingan</span>
                </td>
                <td style="padding:14px 16px">
                    <div style="display:flex;gap:6px">
                        <a href="/admin/stadion/{{ $s->id_stadion }}/edit"
                            style="font-size:12px;color:var(--text);text-decoration:none;border:1px solid var(--border);padding:5px 12px;border-radius:5px">
                            Edit
                        </a>
                        <form method="POST" action="/admin/stadion/{{ $s->id_stadion }}"
                            onsubmit="return confirm('Yakin ingin menghapus stadion ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                style="font-size:12px;color:#f87171;background:rgba(248,113,113,.1);border:1px solid rgba(248,113,113,.2);padding:5px 12px;border-radius:5px;cursor:pointer;font-family:var(--font)">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="padding:40px;text-align:center;color:var(--muted)">
                    Belum ada data stadion.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($stadions->hasPages())
    <div style="padding:14px 22px;border-top:1px solid var(--border);display:flex;justify-content:flex-end">
        {{ $stadions->links() }}
    </div>
    @endif
</div>

@endsection