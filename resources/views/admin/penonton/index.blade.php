@extends('layouts.admin')

@section('title', 'Data Penonton — StadionKu Admin')

@section('content')

<div class="admin-topbar">
    <div>
        <div class="admin-page-title">Data Penonton</div>
        <div class="admin-page-sub">Semua penonton yang terdaftar di sistem</div>
    </div>
</div>

@if(session('success'))
<div style="background:rgba(74,222,128,.1);border:1px solid rgba(74,222,128,.2);color:#4ade80;padding:12px 16px;border-radius:8px;margin-bottom:20px;font-size:13px">
    ✓ {{ session('success') }}
</div>
@endif

{{-- STATS --}}
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:24px">
    <div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:20px">
        <div style="font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:10px">Total Penonton</div>
        <div style="font-size:28px;font-weight:700;color:var(--accent)">{{ $penonton->total() }}</div>
    </div>
    <div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:20px">
        <div style="font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:10px">Penonton Bulan Ini</div>
        <div style="font-size:28px;font-weight:700;">
            {{ \App\Models\User::where('role','user')->whereMonth('created_at', now()->month)->count() }}
        </div>
    </div>
    <div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:20px">
        <div style="font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:10px">Total Tiket Dibeli</div>
        <div style="font-size:28px;font-weight:700;">
            {{ \App\Models\Tiket::count() }}
        </div>
    </div>
</div>

{{-- TABEL --}}
<div style="background:var(--card);border:1px solid var(--border);border-radius:10px;overflow:hidden">
    <div style="padding:16px 22px;border-bottom:1px solid var(--border);display:flex;justify-content:space-between;align-items:center">
        <div style="font-size:14px;font-weight:600">Daftar Penonton</div>
        <div style="font-size:12px;color:var(--muted)">Total: {{ $penonton->total() }} penonton</div>
    </div>
    <table style="width:100%;border-collapse:collapse">
        <thead>
            <tr style="border-bottom:1px solid var(--border)">
                <th style="padding:12px 22px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">No</th>
                <th style="padding:12px 16px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">Nama</th>
                <th style="padding:12px 16px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">Email</th>
                <th style="padding:12px 16px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">Terdaftar</th>
                <th style="padding:12px 16px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">Total Tiket</th>
                <th style="padding:12px 16px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">Status</th>
                <th style="padding:12px 16px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($penonton as $index => $p)
            <tr style="border-bottom:1px solid rgba(34,34,34,.6);transition:background .15s"
                onmouseover="this.style.background='rgba(255,255,255,.015)'"
                onmouseout="this.style.background='transparent'">
                <td style="padding:14px 22px;color:var(--muted);font-size:13px">
                    {{ $penonton->firstItem() + $index }}
                </td>
                <td style="padding:14px 16px">
                    <div style="font-weight:500">{{ $p->name }}</div>
                </td>
                <td style="padding:14px 16px;font-size:12px;color:var(--muted);font-family:monospace">
                    {{ $p->email }}
                </td>
                <td style="padding:14px 16px;font-size:12px;color:var(--muted)">
                    {{ \Carbon\Carbon::parse($p->created_at)->format('d M Y') }}
                </td>
                <td style="padding:14px 16px">
                    <span style="font-size:13px;font-weight:600;color:var(--accent)">
                        {{ $p->tikets_count }}
                    </span>
                    <span style="font-size:12px;color:var(--muted)"> tiket</span>
                </td>
                <td style="padding:14px 16px">
                    <span style="font-size:10px;font-family:monospace;padding:3px 10px;border-radius:100px;background:rgba(74,222,128,.1);color:#4ade80;border:1px solid rgba(74,222,128,.2)">
                        ● Aktif
                    </span>
                </td>
                <td style="padding:14px 16px">
                    <form method="POST" action="/admin/penonton/{{ $p->id }}"
                        onsubmit="return confirm('Yakin ingin menghapus akun penonton ini? Semua tiket terkait juga akan terhapus.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            style="font-size:12px;color:#f87171;background:rgba(248,113,113,.1);border:1px solid rgba(248,113,113,.2);padding:5px 12px;border-radius:5px;cursor:pointer;font-family:var(--font)">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="padding:40px;text-align:center;color:var(--muted)">
                    Belum ada penonton terdaftar.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($penonton->hasPages())
    <div style="padding:14px 22px;border-top:1px solid var(--border);display:flex;justify-content:flex-end">
        {{ $penonton->links() }}
    </div>
    @endif
</div>

@endsection