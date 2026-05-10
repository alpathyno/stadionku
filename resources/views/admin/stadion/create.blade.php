@extends('layouts.admin')

@section('title', 'Tambah Stadion — StadionKu Admin')

@section('content')

<div class="admin-topbar">
    <div>
        <div class="admin-page-title">Tambah Stadion</div>
        <div class="admin-page-sub">
            <a href="/admin/stadion" style="color:var(--muted);text-decoration:none">Stadion</a> → Tambah Baru
        </div>
    </div>
</div>

<div style="max-width:600px">
    <div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:28px">
        <form method="POST" action="/admin/stadion">
            @csrf

            <div style="margin-bottom:16px">
                <label style="display:block;font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px">
                    Nama Stadion <span style="color:#f87171">*</span>
                </label>
                <input type="text" name="nama_stadion" value="{{ old('nama_stadion') }}"
                    placeholder="Contoh: Gelora Bung Karno"
                    style="width:100%;background:var(--surface);border:1px solid {{ $errors->has('nama_stadion') ? '#f87171' : 'var(--border)' }};color:var(--text);padding:10px 13px;border-radius:8px;font-size:14px;font-family:var(--font);outline:none">
                @error('nama_stadion')
                    <div style="font-size:11px;color:#f87171;margin-top:4px">{{ $message }}</div>
                @enderror
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px">
                <div>
                    <label style="display:block;font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px">
                        Kota <span style="color:#f87171">*</span>
                    </label>
                    <input type="text" name="kota" value="{{ old('kota') }}"
                        placeholder="Contoh: Jakarta"
                        style="width:100%;background:var(--surface);border:1px solid {{ $errors->has('kota') ? '#f87171' : 'var(--border)' }};color:var(--text);padding:10px 13px;border-radius:8px;font-size:14px;font-family:var(--font);outline:none">
                    @error('kota')
                        <div style="font-size:11px;color:#f87171;margin-top:4px">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label style="display:block;font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px">
                        Kapasitas <span style="color:#f87171">*</span>
                    </label>
                    <input type="number" name="kapasitas" value="{{ old('kapasitas') }}"
                        placeholder="Contoh: 78000"
                        style="width:100%;background:var(--surface);border:1px solid {{ $errors->has('kapasitas') ? '#f87171' : 'var(--border)' }};color:var(--text);padding:10px 13px;border-radius:8px;font-size:14px;font-family:var(--font);outline:none">
                    @error('kapasitas')
                        <div style="font-size:11px;color:#f87171;margin-top:4px">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div style="margin-bottom:24px">
                <label style="display:block;font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px">
                    Alamat Lengkap <span style="color:#f87171">*</span>
                </label>
                <textarea name="alamat" rows="3" placeholder="Alamat lengkap stadion"
                    style="width:100%;background:var(--surface);border:1px solid {{ $errors->has('alamat') ? '#f87171' : 'var(--border)' }};color:var(--text);padding:10px 13px;border-radius:8px;font-size:14px;font-family:var(--font);outline:none;resize:vertical">{{ old('alamat') }}</textarea>
                @error('alamat')
                    <div style="font-size:11px;color:#f87171;margin-top:4px">{{ $message }}</div>
                @enderror
            </div>

            <div style="display:flex;gap:10px">
                <button type="submit"
                    style="background:var(--accent);color:#0c0c0c;padding:11px 24px;border-radius:8px;font-size:13px;font-weight:600;border:none;cursor:pointer;font-family:var(--font)">
                    Simpan Stadion
                </button>
                <a href="/admin/stadion"
                    style="background:transparent;color:var(--text);padding:11px 24px;border-radius:8px;font-size:13px;font-weight:500;border:1px solid var(--border);text-decoration:none">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@endsection