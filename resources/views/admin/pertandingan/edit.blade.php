@extends('layouts.admin')

@section('title', 'Edit Pertandingan — StadionKu Admin')

@section('content')

<div class="admin-topbar">
    <div>
        <div class="admin-page-title">Edit Pertandingan</div>
        <div class="admin-page-sub">
            <a href="/admin/pertandingan" style="color:var(--muted);text-decoration:none">Pertandingan</a>
            → Edit
        </div>
    </div>
</div>

<div style="max-width:700px">
    <div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:28px">

        <form method="POST" action="/admin/pertandingan/{{ $pertandingan->id_pertandingan }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Tim --}}
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px">
                <div>
                    <label style="display:block;font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px">
                        Tim Tuan Rumah <span style="color:#f87171">*</span>
                    </label>
                    <input type="text" name="tim_tuan_rumah"
                        value="{{ old('tim_tuan_rumah', $pertandingan->tim_tuan_rumah) }}"
                        style="width:100%;background:var(--surface);border:1px solid {{ $errors->has('tim_tuan_rumah') ? '#f87171' : 'var(--border2)' }};color:var(--text);padding:10px 13px;border-radius:8px;font-size:14px;font-family:var(--font);outline:none">
                    @error('tim_tuan_rumah')
                        <div style="font-size:11px;color:#f87171;margin-top:4px">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label style="display:block;font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px">
                        Tim Tamu <span style="color:#f87171">*</span>
                    </label>
                    <input type="text" name="tim_tamu"
                        value="{{ old('tim_tamu', $pertandingan->tim_tamu) }}"
                        style="width:100%;background:var(--surface);border:1px solid {{ $errors->has('tim_tamu') ? '#f87171' : 'var(--border2)' }};color:var(--text);padding:10px 13px;border-radius:8px;font-size:14px;font-family:var(--font);outline:none">
                    @error('tim_tamu')
                        <div style="font-size:11px;color:#f87171;margin-top:4px">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px">
    <div>
        <label style="display:block;font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px">
            Logo Tim Tuan Rumah
        </label>
        {{-- Khusus edit: tampilkan logo lama kalau ada --}}
        @isset($pertandingan)
            @if($pertandingan->logo_tuan_rumah)
            <img src="{{ asset('storage/' . $pertandingan->logo_tuan_rumah) }}"
                style="width:48px;height:48px;object-fit:contain;border-radius:50%;background:var(--card2);border:1px solid var(--border);margin-bottom:8px;display:block">
            @endif
        @endisset
        <input type="file" name="logo_tuan_rumah" accept="image/*"
            style="width:100%;background:var(--surface);border:1px solid var(--border);color:var(--text);padding:9px 13px;border-radius:8px;font-size:13px;font-family:var(--font);outline:none">
        <div style="font-size:11px;color:var(--muted);margin-top:4px">JPG/PNG/WEBP, maks 2MB</div>
    </div>
    <div>
        <label style="display:block;font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px">
            Logo Tim Tamu
        </label>
        @isset($pertandingan)
            @if($pertandingan->logo_tamu)
            <img src="{{ asset('storage/' . $pertandingan->logo_tamu) }}"
                style="width:48px;height:48px;object-fit:contain;border-radius:50%;background:var(--card2);border:1px solid var(--border);margin-bottom:8px;display:block">
            @endif
        @endisset
        <input type="file" name="logo_tamu" accept="image/*"
            style="width:100%;background:var(--surface);border:1px solid var(--border);color:var(--text);padding:9px 13px;border-radius:8px;font-size:13px;font-family:var(--font);outline:none">
        <div style="font-size:11px;color:var(--muted);margin-top:4px">JPG/PNG/WEBP, maks 2MB</div>
    </div>
</div>

            {{-- Tanggal & Jam --}}
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px">
                <div>
                    <label style="display:block;font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px">
                        Tanggal Pertandingan <span style="color:#f87171">*</span>
                    </label>
                    <input type="date" name="tanggal_pertandingan"
                        value="{{ old('tanggal_pertandingan', $pertandingan->tanggal_pertandingan) }}"
                        style="width:100%;background:var(--surface);border:1px solid {{ $errors->has('tanggal_pertandingan') ? '#f87171' : 'var(--border2)' }};color:var(--text);padding:10px 13px;border-radius:8px;font-size:14px;font-family:var(--font);outline:none">
                    @error('tanggal_pertandingan')
                        <div style="font-size:11px;color:#f87171;margin-top:4px">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label style="display:block;font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px">
                        Jam Mulai <span style="color:#f87171">*</span>
                    </label>
                    <input type="time" name="jam_mulai"
                        value="{{ old('jam_mulai', $pertandingan->jam_mulai) }}"
                        style="width:100%;background:var(--surface);border:1px solid {{ $errors->has('jam_mulai') ? '#f87171' : 'var(--border2)' }};color:var(--text);padding:10px 13px;border-radius:8px;font-size:14px;font-family:var(--font);outline:none">
                    @error('jam_mulai')
                        <div style="font-size:11px;color:#f87171;margin-top:4px">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Stadion --}}
            <div style="margin-bottom:16px">
                <label style="display:block;font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px">
                    Stadion <span style="color:#f87171">*</span>
                </label>
                <select name="id_stadion"
                    style="width:100%;background:var(--surface);border:1px solid {{ $errors->has('id_stadion') ? '#f87171' : 'var(--border2)' }};color:var(--text);padding:10px 13px;border-radius:8px;font-size:14px;font-family:var(--font);outline:none">
                    <option value="">-- Pilih Stadion --</option>
                    @foreach($stadions as $s)
                        <option value="{{ $s->id_stadion }}"
                            {{ old('id_stadion', $pertandingan->id_stadion) == $s->id_stadion ? 'selected' : '' }}>
                            {{ $s->nama_stadion }} — {{ $s->kota }}
                        </option>
                    @endforeach
                </select>
                @error('id_stadion')
                    <div style="font-size:11px;color:#f87171;margin-top:4px">{{ $message }}</div>
                @enderror
            </div>

            {{-- Harga & Status --}}
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:24px">
                <div>
                    <label style="display:block;font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px">
                        Harga Minimum (Rp) <span style="color:#f87171">*</span>
                    </label>
                    <input type="number" name="harga_min"
                        value="{{ old('harga_min', $pertandingan->harga_min) }}"
                        style="width:100%;background:var(--surface);border:1px solid {{ $errors->has('harga_min') ? '#f87171' : 'var(--border2)' }};color:var(--text);padding:10px 13px;border-radius:8px;font-size:14px;font-family:var(--font);outline:none">
                    @error('harga_min')
                        <div style="font-size:11px;color:#f87171;margin-top:4px">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label style="display:block;font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px">
                        Status <span style="color:#f87171">*</span>
                    </label>
                    <select name="status"
                        style="width:100%;background:var(--surface);border:1px solid {{ $errors->has('status') ? '#f87171' : 'var(--border2)' }};color:var(--text);padding:10px 13px;border-radius:8px;font-size:14px;font-family:var(--font);outline:none">
                        @foreach(['Terjadwal','Dijual','Berlangsung','Selesai','Dibatalkan'] as $s)
                            <option value="{{ $s }}"
                                {{ old('status', $pertandingan->status) === $s ? 'selected' : '' }}>
                                {{ $s }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                        <div style="font-size:11px;color:#f87171;margin-top:4px">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- BUTTONS --}}
            <div style="display:flex;gap:10px">
                <button type="submit"
                    style="background:var(--accent);color:#0c0c0c;padding:11px 24px;border-radius:8px;font-size:13px;font-weight:600;border:none;cursor:pointer;font-family:var(--font)">
                    Simpan Perubahan
                </button>
                <a href="/admin/pertandingan"
                    style="background:transparent;color:var(--text);padding:11px 24px;border-radius:8px;font-size:13px;font-weight:500;border:1px solid var(--border);text-decoration:none">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@endsection