@extends('layouts.user')

@section('title', 'Profil Saya — StadionKu')

@section('content')

<div style="display:grid;grid-template-columns:220px 1fr;gap:24px;align-items:start">

    {{-- SIDEBAR PROFIL --}}
    <div>
        <div style="background:var(--card);border:1px solid var(--border);border-radius:10px;overflow:hidden;position:sticky;top:72px">
            {{-- Avatar --}}
            <div style="padding:24px;text-align:center;border-bottom:1px solid var(--border)">
                <div style="width:72px;height:72px;border-radius:50%;background:var(--card2);border:2px solid var(--border);display:flex;align-items:center;justify-content:center;font-size:28px;margin:0 auto 12px">👤</div>
                <div style="font-size:15px;font-weight:600;margin-bottom:3px">{{ $user->name }}</div>
                <div style="font-size:12px;color:var(--muted)">{{ $user->email }}</div>
            </div>
            {{-- Nav --}}
            <div style="padding:8px 0">
                <a href="/profil" style="display:flex;align-items:center;gap:10px;padding:10px 16px;font-size:13px;color:var(--text);text-decoration:none;background:rgba(200,241,53,.06);border-right:2px solid var(--accent)">
                    <span>👤</span> Profil Saya
                </a>
                <a href="/riwayat" style="display:flex;align-items:center;gap:10px;padding:10px 16px;font-size:13px;color:var(--muted);text-decoration:none;transition:all .15s">
                    <span>🎫</span> Riwayat Tiket
                </a>
                <div style="height:1px;background:var(--border);margin:4px 0"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="display:flex;align-items:center;gap:10px;padding:10px 16px;font-size:13px;color:#f87171;background:none;border:none;cursor:pointer;font-family:var(--font);width:100%">
                        <span>🚪</span> Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- KONTEN --}}
    <div>

        {{-- Alert --}}
        @if(session('success'))
        <div style="background:rgba(74,222,128,.1);border:1px solid rgba(74,222,128,.2);color:#4ade80;padding:12px 16px;border-radius:8px;margin-bottom:16px;font-size:13px">
            ✓ {{ session('success') }}
        </div>
        @endif

        {{-- Avatar Section --}}
        <div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:20px;margin-bottom:16px;display:flex;align-items:center;gap:16px">
            <div style="width:64px;height:64px;border-radius:50%;background:var(--card2);border:2px solid var(--border);display:flex;align-items:center;justify-content:center;font-size:26px;flex-shrink:0">👤</div>
            <div>
                <div style="font-size:16px;font-weight:600;margin-bottom:4px">{{ $user->name }}</div>
                <div style="font-size:12px;color:var(--muted)">Member sejak {{ \Carbon\Carbon::parse($user->created_at)->format('F Y') }}</div>
                <div style="font-size:12px;color:var(--muted);margin-top:2px">{{ $user->tikets()->count() }} tiket dibeli</div>
            </div>
        </div>

        {{-- Form Data Diri --}}
        <div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:24px;margin-bottom:16px">
            <div style="font-size:14px;font-weight:600;margin-bottom:20px">Data Penonton</div>

            <form method="POST" action="/profil/update">
                @csrf

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:16px">
                    <div>
                        <label style="display:block;font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px">
                            Nama Lengkap <span style="color:#f87171">*</span>
                        </label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                            style="width:100%;background:var(--surface);border:1px solid {{ $errors->has('name') ? '#f87171' : 'var(--border)' }};color:var(--text);padding:10px 13px;border-radius:8px;font-size:14px;font-family:var(--font);outline:none"
                            onfocus="this.style.borderColor='var(--accent)'"
                            onblur="this.style.borderColor='var(--border)'">
                        @error('name')
                            <div style="font-size:11px;color:#f87171;margin-top:4px">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label style="display:block;font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px">
                            Email <span style="color:#f87171">*</span>
                        </label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                            style="width:100%;background:var(--surface);border:1px solid {{ $errors->has('email') ? '#f87171' : 'var(--border)' }};color:var(--text);padding:10px 13px;border-radius:8px;font-size:14px;font-family:var(--font);outline:none"
                            onfocus="this.style.borderColor='var(--accent)'"
                            onblur="this.style.borderColor='var(--border)'">
                        @error('email')
                            <div style="font-size:11px;color:#f87171;margin-top:4px">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit"
                    style="background:var(--accent);color:#0c0c0c;padding:10px 22px;border-radius:8px;font-size:13px;font-weight:600;border:none;cursor:pointer;font-family:var(--font)">
                    Simpan Perubahan
                </button>
            </form>
        </div>

        {{-- Form Password --}}
        <div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:24px">
            <div style="font-size:14px;font-weight:600;margin-bottom:20px">Keamanan Akun</div>

            <form method="POST" action="/profil/password">
                @csrf

                <div style="margin-bottom:14px">
                    <label style="display:block;font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px">
                        Password Lama <span style="color:#f87171">*</span>
                    </label>
                    <input type="password" name="password_lama" placeholder="••••••••"
                        style="width:100%;background:var(--surface);border:1px solid {{ $errors->has('password_lama') ? '#f87171' : 'var(--border)' }};color:var(--text);padding:10px 13px;border-radius:8px;font-size:14px;font-family:var(--font);outline:none"
                        onfocus="this.style.borderColor='var(--accent)'"
                        onblur="this.style.borderColor='var(--border)'">
                    @error('password_lama')
                        <div style="font-size:11px;color:#f87171;margin-top:4px">{{ $message }}</div>
                    @enderror
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:16px">
                    <div>
                        <label style="display:block;font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px">
                            Password Baru <span style="color:#f87171">*</span>
                        </label>
                        <input type="password" name="password" placeholder="Min. 8 karakter"
                            style="width:100%;background:var(--surface);border:1px solid {{ $errors->has('password') ? '#f87171' : 'var(--border)' }};color:var(--text);padding:10px 13px;border-radius:8px;font-size:14px;font-family:var(--font);outline:none"
                            onfocus="this.style.borderColor='var(--accent)'"
                            onblur="this.style.borderColor='var(--border)'">
                        @error('password')
                            <div style="font-size:11px;color:#f87171;margin-top:4px">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label style="display:block;font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px">
                            Konfirmasi Password <span style="color:#f87171">*</span>
                        </label>
                        <input type="password" name="password_confirmation" placeholder="Ulangi password baru"
                            style="width:100%;background:var(--surface);border:1px solid var(--border);color:var(--text);padding:10px 13px;border-radius:8px;font-size:14px;font-family:var(--font);outline:none"
                            onfocus="this.style.borderColor='var(--accent)'"
                            onblur="this.style.borderColor='var(--border)'">
                    </div>
                </div>

                <button type="submit"
                    style="background:var(--surface);color:var(--text);padding:10px 22px;border-radius:8px;font-size:13px;font-weight:600;border:1px solid var(--border);cursor:pointer;font-family:var(--font)">
                    Ubah Password
                </button>
            </form>
        </div>

    </div>
</div>

@endsection