@extends('layouts.admin')

@section('title', 'Edit Admin — StadionKu Admin')

@section('content')

<div class="admin-topbar">
    <div>
        <div class="admin-page-title">Edit Admin</div>
        <div class="admin-page-sub">
            <a href="/admin/users" style="color:var(--muted);text-decoration:none">User</a> → Edit
        </div>
    </div>
</div>

<div style="max-width:600px">
    <div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:28px">
        <form method="POST" action="/admin/admins/{{ $user->id }}">
            @csrf
            @method('PUT')

            <div style="margin-bottom:16px">
                <label style="display:block;font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px">
                    Nama Lengkap <span style="color:#f87171">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    style="width:100%;background:var(--surface);border:1px solid {{ $errors->has('name') ? '#f87171' : 'var(--border)' }};color:var(--text);padding:10px 13px;border-radius:8px;font-size:14px;font-family:var(--font);outline:none">
                @error('name')
                    <div style="font-size:11px;color:#f87171;margin-top:4px">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom:16px">
                <label style="display:block;font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px">
                    Email <span style="color:#f87171">*</span>
                </label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                    style="width:100%;background:var(--surface);border:1px solid {{ $errors->has('email') ? '#f87171' : 'var(--border)' }};color:var(--text);padding:10px 13px;border-radius:8px;font-size:14px;font-family:var(--font);outline:none">
                @error('email')
                    <div style="font-size:11px;color:#f87171;margin-top:4px">{{ $message }}</div>
                @enderror
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:8px">
                <div>
                    <label style="display:block;font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px">
                        Password Baru <span style="color:var(--muted)">(opsional)</span>
                    </label>
                    <input type="password" name="password"
                        placeholder="Kosongkan jika tidak diubah"
                        style="width:100%;background:var(--surface);border:1px solid {{ $errors->has('password') ? '#f87171' : 'var(--border)' }};color:var(--text);padding:10px 13px;border-radius:8px;font-size:14px;font-family:var(--font);outline:none">
                    @error('password')
                        <div style="font-size:11px;color:#f87171;margin-top:4px">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label style="display:block;font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px">
                        Konfirmasi Password
                    </label>
                    <input type="password" name="password_confirmation"
                        placeholder="Ulangi password baru"
                        style="width:100%;background:var(--surface);border:1px solid var(--border);color:var(--text);padding:10px 13px;border-radius:8px;font-size:14px;font-family:var(--font);outline:none">
                </div>
            </div>
            <div style="font-size:11px;color:var(--muted);margin-bottom:24px">
                * Kosongkan field password jika tidak ingin mengubah password.
            </div>

            <div style="display:flex;gap:10px">
                <button type="submit"
                    style="background:var(--accent);color:#0c0c0c;padding:11px 24px;border-radius:8px;font-size:13px;font-weight:600;border:none;cursor:pointer;font-family:var(--font)">
                    Simpan Perubahan
                </button>
                <a href="/admin/admins"
                    style="background:transparent;color:var(--text);padding:11px 24px;border-radius:8px;font-size:13px;font-weight:500;border:1px solid var(--border);text-decoration:none">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@endsection