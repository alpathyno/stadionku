@extends('layouts.admin')

@section('title', 'Kelola Admin — StadionKu Admin')

@section('content')

<div class="admin-topbar">
    <div>
        <div class="admin-page-title">Kelola Admin</div>
        <div class="admin-page-sub">Daftar semua admin sistem</div>
    </div>
    <a href="/admin/admins/create"
        style="background:var(--accent);color:#0c0c0c;padding:9px 20px;border-radius:6px;font-size:13px;font-weight:600;text-decoration:none">
        + Tambah Admin
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
                <th style="padding:12px 16px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">Nama</th>
                <th style="padding:12px 16px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">Email</th>
                <th style="padding:12px 16px;text-align:left;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">Terdaftar</th>
                <th style="padding:12px 56px;text-align:justify;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.5px;text-transform:uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $index => $u)
            <tr style="border-bottom:1px solid rgba(34,34,34,.6);transition:background .15s"
                onmouseover="this.style.background='rgba(255,255,255,.015)'"
                onmouseout="this.style.background='transparent'">
                <td style="padding:14px 22px;color:var(--muted);font-size:13px">
                    {{ $users->firstItem() + $index }}
                </td>
                <td style="padding:14px 16px;font-weight:500">{{ $u->name }}</td>
                <td style="padding:14px 16px;font-size:12px;color:var(--muted);font-family:monospace">{{ $u->email }}</td>
                <td style="padding:14px 16px;font-size:12px;color:var(--muted)">
                    {{ \Carbon\Carbon::parse($u->created_at)->format('d M Y') }}
                </td>
                <td style="padding:14px 16px">
                    <div style="display:flex;gap:6px">
                        <a href="/admin/admins/{{ $u->id }}/edit"
                            style="font-size:12px;color:var(--text);text-decoration:none;border:1px solid var(--border);padding:5px 12px;border-radius:5px">
                            Edit
                        </a>
                        <form method="POST" action="/admin/admins/{{ $u->id }}"
                            onsubmit="return confirm('Yakin ingin menghapus user ini?')">
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
                    Belum ada user terdaftar.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($users->hasPages())
    <div style="padding:14px 22px;border-top:1px solid var(--border);display:flex;justify-content:flex-end">
        {{ $users->links() }}
    </div>
    @endif
</div>

@endsection