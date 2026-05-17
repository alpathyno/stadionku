@extends('layouts.user')

@section('title', $pertandingan->tim_tuan_rumah . ' vs ' . $pertandingan->tim_tamu . ' — StadionKu')

@section('content')

{{-- BREADCRUMB --}}
<div style="font-size:12px;color:var(--muted);margin-bottom:20px;display:flex;align-items:center;gap:6px">
    <a href="/pertandingan" style="color:var(--muted);text-decoration:none">Pertandingan</a>
    <span>›</span>
    <span>{{ $pertandingan->tim_tuan_rumah }} vs {{ $pertandingan->tim_tamu }}</span>
</div>

{{-- MATCH HEADER --}}
<div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:24px 28px;margin-bottom:20px">
    <div style="display:flex;align-items:center;gap:24px;flex-wrap:wrap">

        {{-- Tuan Rumah --}}
        <div style="text-align:center;min-width:140px;flex-shrink:0">
            <div style="width:64px;height:64px;margin:0 auto 10px;display:flex;align-items:center;justify-content:center">
                @if($pertandingan->logo_tuan_rumah)
                    <img src="{{ asset('storage/' . $pertandingan->logo_tuan_rumah) }}"
                        style="width:64px;height:64px;object-fit:contain;display:block;margin:0 auto">
                @else
                    <div style="width:64px;height:64px;display:flex;align-items:center;justify-content:center;font-size:26px">⚽</div>
                @endif
            </div>
            <div style="font-size:15px;font-weight:600">{{ $pertandingan->tim_tuan_rumah }}</div>
        </div>

        {{-- VS --}}
        <div style="flex:1;text-align:center">
            <div style="font-size:28px;font-weight:700;color:var(--muted);letter-spacing:-1px">VS</div>
            <div style="font-size:12px;color:var(--muted);margin-top:4px;font-family:monospace">
                {{ \Carbon\Carbon::parse($pertandingan->tanggal_pertandingan)->format('D, d M Y') }}
                · {{ \Carbon\Carbon::parse($pertandingan->jam_mulai)->format('H:i') }} WIB
            </div>
            <div style="margin-top:8px">
                @if($pertandingan->status === 'Dijual')
                    <span style="font-size:10px;font-family:monospace;padding:3px 10px;border-radius:100px;background:rgba(74,222,128,.1);color:#4ade80;border:1px solid rgba(74,222,128,.2)">● Dijual</span>
                @endif
            </div>
        </div>

        {{-- Tamu --}}
        <div style="text-align:center;min-width:140px;flex-shrink:0">
            <div style="width:64px;height:64px;margin:0 auto 10px;display:flex;align-items:center;justify-content:center">
                @if($pertandingan->logo_tamu)
                    <img src="{{ asset('storage/' . $pertandingan->logo_tamu) }}"
                        style="width:64px;height:64px;object-fit:contain;display:block;margin:0 auto">
                @else
                    <div style="width:64px;height:64px;display:flex;align-items:center;justify-content:center;font-size:26px">⚽</div>
                @endif
            </div>
            <div style="font-size:15px;font-weight:600">{{ $pertandingan->tim_tamu }}</div>
        </div>

    </div>

    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-top:20px;padding-top:20px;border-top:1px solid var(--border)">
        <div style="background:var(--surface);border:1px solid var(--border);border-radius:8px;padding:14px">
            <div style="font-size:10px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:5px">Stadion</div>
            <div style="font-size:14px;font-weight:500">{{ $pertandingan->stadion->nama_stadion ?? '-' }}</div>
        </div>
        <div style="background:var(--surface);border:1px solid var(--border);border-radius:8px;padding:14px">
            <div style="font-size:10px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:5px">Kota</div>
            <div style="font-size:14px;font-weight:500">{{ $pertandingan->stadion->kota ?? '-' }}</div>
        </div>
        <div style="background:var(--surface);border:1px solid var(--border);border-radius:8px;padding:14px">
            <div style="font-size:10px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:5px">Tanggal</div>
            <div style="font-size:14px;font-weight:500">{{ \Carbon\Carbon::parse($pertandingan->tanggal_pertandingan)->format('d F Y') }}</div>
        </div>
        <div style="background:var(--surface);border:1px solid var(--border);border-radius:8px;padding:14px">
            <div style="font-size:10px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:5px">Kickoff</div>
            <div style="font-size:14px;font-weight:500">{{ \Carbon\Carbon::parse($pertandingan->jam_mulai)->format('H:i') }} WIB</div>
        </div>
    </div>
</div>

{{-- FORM membungkus semua --}}
<form id="form-booking" method="POST" action="/booking" enctype="multipart/form-data">
@if($errors->any())
    <div style="background:rgba(248,113,113,.1);border:1px solid rgba(248,113,113,.2);color:#f87171;padding:12px 16px;border-radius:8px;margin-bottom:16px;font-size:13px">
        <strong>Terjadi kesalahan:</strong>
        <ul style="margin-top:6px;padding-left:16px">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@csrf
<input type="hidden" name="id_pertandingan" value="{{ $pertandingan->id_pertandingan }}">
<input type="hidden" name="zona" id="input-zona" value="VIP">
<input type="hidden" name="id_kursi" id="input-kursi" value="">
<input type="hidden" name="harga" id="input-harga" value="{{ $pertandingan->harga_min * 2.5 }}">
<input type="hidden" name="metode_bayar" id="input-metode" value="QRIS">

{{-- MAIN LAYOUT --}}
<div style="display:grid;grid-template-columns:1fr 300px;gap:20px;align-items:start">

    {{-- KIRI --}}
    <div>
        {{-- STEP 1: Pilih Zona --}}
        <div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:22px;margin-bottom:16px">
            <div style="font-size:13px;font-weight:600;margin-bottom:16px;display:flex;align-items:center;gap:8px">
                <div style="width:22px;height:22px;border-radius:50%;background:var(--accent);color:#0c0c0c;font-size:10px;font-weight:700;display:flex;align-items:center;justify-content:center">1</div>
                Pilih Zona Tribun
            </div>
            <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:10px">
                <div class="zone-card" data-zone="VIP" data-price="{{ $pertandingan->harga_min * 2.5 }}"
                    onclick="selectZone(this)"
                    style="padding:16px;border-radius:8px;border:1px solid var(--accent);background:rgba(200,241,53,.06);cursor:pointer;transition:all .15s">
                    <div style="font-size:10px;font-family:monospace;color:var(--accent);letter-spacing:1px;margin-bottom:6px">VIP</div>
                    <div style="font-size:16px;font-weight:700">Rp {{ number_format($pertandingan->harga_min * 2.5, 0, ',', '.') }}</div>
                    <div style="font-size:11px;color:var(--muted);margin-top:3px">Tribun Utama</div>
                </div>
                <div class="zone-card" data-zone="Tribune" data-price="{{ $pertandingan->harga_min * 1.5 }}"
                    onclick="selectZone(this)"
                    style="padding:16px;border-radius:8px;border:1px solid var(--border);background:transparent;cursor:pointer;transition:all .15s">
                    <div style="font-size:10px;font-family:monospace;color:var(--muted);letter-spacing:1px;margin-bottom:6px">TRIBUNE</div>
                    <div style="font-size:16px;font-weight:700">Rp {{ number_format($pertandingan->harga_min * 1.5, 0, ',', '.') }}</div>
                    <div style="font-size:11px;color:var(--muted);margin-top:3px">Tribun Barat & Timur</div>
                </div>
                <div class="zone-card" data-zone="Economy" data-price="{{ $pertandingan->harga_min }}"
                    onclick="selectZone(this)"
                    style="padding:16px;border-radius:8px;border:1px solid var(--border);background:transparent;cursor:pointer;transition:all .15s">
                    <div style="font-size:10px;font-family:monospace;color:var(--muted);letter-spacing:1px;margin-bottom:6px">ECONOMY</div>
                    <div style="font-size:16px;font-weight:700">Rp {{ number_format($pertandingan->harga_min, 0, ',', '.') }}</div>
                    <div style="font-size:11px;color:var(--muted);margin-top:3px">Tribun Utara & Selatan</div>
                </div>
            </div>
        </div>

        {{-- STEP 2: Denah Stadion + Pilih Kursi --}}
        <div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:22px;margin-bottom:16px">
            <div style="font-size:13px;font-weight:600;margin-bottom:16px;display:flex;align-items:center;gap:8px">
                <div style="width:22px;height:22px;border-radius:50%;background:var(--accent);color:#0c0c0c;font-size:10px;font-weight:700;display:flex;align-items:center;justify-content:center">2</div>
                Pilih Kursi
            </div>
            <div style="background:var(--surface);border:1px solid var(--border);border-radius:8px;padding:16px;margin-bottom:16px">
                <div style="font-size:10px;font-family:monospace;color:var(--muted);letter-spacing:1px;text-transform:uppercase;margin-bottom:12px">Denah Stadion</div>
                <svg viewBox="0 0 820 360" style="width:100%;max-height:240px">
                    <rect id="map-Economy" x="20" y="20" width="780" height="320" rx="70" ry="70" fill="#1e1e1e" stroke="#3a3a3a" stroke-width="1.5" style="cursor:pointer" onclick="selectZoneByName('Economy')"/>
                    <rect id="map-Tribune" x="100" y="80" width="620" height="200" rx="50" ry="50" fill="#141e2c" stroke="#1e3655" stroke-width="1.5" style="cursor:pointer" onclick="selectZoneByName('Tribune')"/>
                    <rect id="map-VIP" x="185" y="130" width="450" height="100" rx="32" ry="32" fill="#2a2510" stroke="#4a3e00" stroke-width="1.5" style="cursor:pointer" onclick="selectZoneByName('VIP')"/>
                    <rect x="240" y="148" width="340" height="64" rx="6" fill="#0e2e0e" stroke="#1a4a1a" stroke-width="1.5"/>
                    <line x1="410" y1="150" x2="410" y2="210" stroke="#1a4a1a" stroke-width="1"/>
                    <circle cx="410" cy="180" r="18" fill="none" stroke="#1a4a1a" stroke-width="1"/>
                    <circle cx="410" cy="180" r="2" fill="#1a4a1a"/>
                    <rect x="242" y="158" width="56" height="44" rx="2" fill="none" stroke="#1a4a1a" stroke-width="1"/>
                    <rect x="522" y="158" width="56" height="44" rx="2" fill="none" stroke="#1a4a1a" stroke-width="1"/>
                    <text x="410" y="184" text-anchor="middle" font-size="10" fill="#1e5e1e" font-family="monospace">LAPANGAN</text>
                    <text x="410" y="60" text-anchor="middle" font-size="9" fill="#555" font-family="monospace">ECONOMY</text>
                    <text x="410" y="115" text-anchor="middle" font-size="9" fill="#2a5080" font-family="monospace">TRIBUNE</text>
                    <text x="410" y="148" text-anchor="middle" font-size="9" fill="#7a6010" font-family="monospace">VIP</text>
                    <text x="410" y="14" text-anchor="middle" font-size="8" fill="#333" font-family="monospace">UTARA</text>
                    <text x="410" y="352" text-anchor="middle" font-size="8" fill="#333" font-family="monospace">SELATAN</text>
                    <text x="812" y="183" text-anchor="middle" font-size="8" fill="#333" font-family="monospace">TIMUR</text>
                    <text x="8" y="183" text-anchor="middle" font-size="8" fill="#333" font-family="monospace">BARAT</text>
                    <rect id="ring-VIP" x="185" y="130" width="450" height="100" rx="32" ry="32" fill="none" stroke="#c8a020" stroke-width="2.5" stroke-dasharray="8 4" opacity="0.9"/>
                    <rect id="ring-Tribune" x="100" y="80" width="620" height="200" rx="50" ry="50" fill="none" stroke="#60a5fa" stroke-width="2.5" stroke-dasharray="8 4" opacity="0"/>
                    <rect id="ring-Economy" x="20" y="20" width="780" height="320" rx="70" ry="70" fill="none" stroke="#909090" stroke-width="2.5" stroke-dasharray="8 4" opacity="0"/>
                </svg>
            </div>
            <div style="display:flex;gap:14px;margin-bottom:12px;flex-wrap:wrap">
                <div style="display:flex;align-items:center;gap:5px;font-size:11px;color:var(--muted)">
                    <div style="width:10px;height:10px;border-radius:2px;background:var(--card2);border:1px solid var(--border)"></div> Tersedia
                </div>
                <div style="display:flex;align-items:center;gap:5px;font-size:11px;color:var(--muted)">
                    <div id="legend-selected" style="width:10px;height:10px;border-radius:2px;background:#c8a020"></div> Dipilih
                </div>
                <div style="display:flex;align-items:center;gap:5px;font-size:11px;color:var(--muted)">
                    <div style="width:10px;height:10px;border-radius:2px;background:#333"></div> Terisi
                </div>
            </div>
            <div style="font-size:10px;font-family:monospace;color:var(--muted);letter-spacing:1px;text-transform:uppercase;margin-bottom:8px" id="grid-label">
                Baris Kursi — VIP
            </div>
            <div id="seat-container" style="display:flex;flex-direction:column;gap:4px"></div>
        </div>

        {{-- STEP 3: Data Penonton --}}
        <div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:22px;margin-bottom:16px">
            <div style="font-size:13px;font-weight:600;margin-bottom:16px;display:flex;align-items:center;gap:8px">
                <div style="width:22px;height:22px;border-radius:50%;background:var(--accent);color:#0c0c0c;font-size:10px;font-weight:700;display:flex;align-items:center;justify-content:center">3</div>
                Data Penonton
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px">
                <div>
                    <label style="display:block;font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px">Nama Lengkap *</label>
                    <input type="text" id="nama" placeholder="Sesuai KTP"
                        style="width:100%;background:var(--surface);border:1px solid var(--border);color:var(--text);padding:10px 13px;border-radius:8px;font-size:14px;font-family:var(--font);outline:none"
                        onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='var(--border)'">
                </div>
                <div>
                    <label style="display:block;font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px">No. Identitas (NIK) *</label>
                    <input type="text" id="nik" placeholder="16 digit NIK"
                        style="width:100%;background:var(--surface);border:1px solid var(--border);color:var(--text);padding:10px 13px;border-radius:8px;font-size:14px;font-family:var(--font);outline:none"
                        onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='var(--border)'">
                </div>
                <div>
                    <label style="display:block;font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px">Email *</label>
                    <input type="email" id="email" placeholder="email@domain.com"
                        style="width:100%;background:var(--surface);border:1px solid var(--border);color:var(--text);padding:10px 13px;border-radius:8px;font-size:14px;font-family:var(--font);outline:none"
                        onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='var(--border)'">
                </div>
                <div>
                    <label style="display:block;font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px">No. Telepon *</label>
                    <input type="tel" id="telepon" placeholder="08xxxxxxxxxx"
                        style="width:100%;background:var(--surface);border:1px solid var(--border);color:var(--text);padding:10px 13px;border-radius:8px;font-size:14px;font-family:var(--font);outline:none"
                        onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='var(--border)'">
                </div>
            </div>
        </div>

        {{-- STEP 4: Metode Bayar --}}
        <div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:22px">
            <div style="font-size:13px;font-weight:600;margin-bottom:16px;display:flex;align-items:center;gap:8px">
                <div style="width:22px;height:22px;border-radius:50%;background:var(--accent);color:#0c0c0c;font-size:10px;font-weight:700;display:flex;align-items:center;justify-content:center">4</div>
                Metode Pembayaran
            </div>
            <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:8px;margin-bottom:16px">
                @foreach([['💳','QRIS'],['🏦','Transfer Bank'],['💚','GoPay'],['💙','Dana']] as $m)
                <div class="pay-opt" data-pay="{{ $m[1] }}" onclick="selectPay(this)"
                    style="padding:14px 8px;border-radius:8px;border:1px solid {{ $loop->first ? 'var(--accent)' : 'var(--border)' }};background:{{ $loop->first ? 'rgba(200,241,53,.06)' : 'var(--surface)' }};cursor:pointer;text-align:center;transition:all .15s">
                    <div style="font-size:20px;margin-bottom:5px">{{ $m[0] }}</div>
                    <div style="font-size:11px;font-weight:500">{{ $m[1] }}</div>
                </div>
                @endforeach
            </div>

        {{-- INSTRUKSI PEMBAYARAN --}}
        <div id="payment-info" style="margin-bottom:16px;padding:16px;background:var(--surface);border:1px solid rgba(200,241,53,.2);border-radius:8px">
            {{-- QRIS --}}
            <div id="info-QRIS">
                <div style="font-size:11px;font-weight:600;color:var(--accent);letter-spacing:1px;text-transform:uppercase;margin-bottom:10px">Instruksi QRIS</div>
                <div style="display:flex;align-items:flex-start;gap:16px">
                    {{-- Ganti src dengan QR code asli kamu: asset('images/qris.png') --}}
                    <div style="width:90px;height:90px;background:white;border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:11px;color:#999;text-align:center;padding:6px;flex-shrink:0">
                        QR Code
                    </div>
                    <div style="font-size:13px;color:var(--muted);line-height:1.8">
                        <div>1. Buka aplikasi e-wallet atau m-banking kamu</div>
                        <div>2. Scan QR Code di samping</div>
                        <div>3. Masukkan nominal sesuai total pembayaran</div>
                        <div>4. Screenshot bukti pembayaran lalu upload di bawah</div>
                    </div>
                </div>
            </div>

            {{-- Transfer Bank --}}
            <div id="info-Transfer Bank" style="display:none">
                <div style="font-size:11px;font-weight:600;color:var(--accent);letter-spacing:1px;text-transform:uppercase;margin-bottom:10px">Instruksi Transfer Bank</div>
                <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:10px;margin-bottom:12px">
                    <div style="background:var(--card);border:1px solid var(--border);border-radius:8px;padding:12px">
                        <div style="font-size:10px;color:var(--muted);margin-bottom:4px">Bank</div>
                        <div style="font-size:14px;font-weight:600">BCA</div>
                    </div>
                    <div style="background:var(--card);border:1px solid var(--border);border-radius:8px;padding:12px">
                        <div style="font-size:10px;color:var(--muted);margin-bottom:4px">No. Rekening</div>
                        <div style="font-size:14px;font-weight:600;font-family:monospace">1234567890</div>
                    </div>
                    <div style="background:var(--card);border:1px solid var(--border);border-radius:8px;padding:12px">
                        <div style="font-size:10px;color:var(--muted);margin-bottom:4px">Atas Nama</div>
                        <div style="font-size:14px;font-weight:600">StadionKu</div>
                    </div>
                </div>
                <div style="font-size:12px;color:var(--muted);line-height:1.8">
                    <div>1. Transfer sesuai total pembayaran ke rekening di atas</div>
                    <div>2. Gunakan berita transfer: <span style="color:var(--accent);font-family:monospace">TIKET-{{ auth()->user()->id }}</span></div>
                    <div>3. Screenshot bukti transfer lalu upload di bawah</div>
                </div>
            </div>

            {{-- GoPay --}}
            <div id="info-GoPay" style="display:none">
                <div style="font-size:11px;font-weight:600;color:var(--accent);letter-spacing:1px;text-transform:uppercase;margin-bottom:10px">Instruksi GoPay</div>
                <div style="display:flex;align-items:center;gap:14px;margin-bottom:12px">
                    <div style="width:48px;height:48px;background:#00aed6;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:22px">💚</div>
                    <div>
                        <div style="font-size:10px;color:var(--muted);margin-bottom:2px">Nomor GoPay</div>
                        <div style="font-size:18px;font-weight:700;font-family:monospace">0812-3456-7890</div>
                        <div style="font-size:12px;color:var(--muted)">a/n StadionKu</div>
                    </div>
                </div>
                <div style="font-size:12px;color:var(--muted);line-height:1.8">
                    <div>1. Buka aplikasi Gojek → GoPay</div>
                    <div>2. Pilih Transfer → masukkan nomor di atas</div>
                    <div>3. Masukkan nominal sesuai total pembayaran</div>
                    <div>4. Screenshot bukti lalu upload di bawah</div>
                </div>
            </div>

            {{-- Dana --}}
            <div id="info-Dana" style="display:none">
                <div style="font-size:11px;font-weight:600;color:var(--accent);letter-spacing:1px;text-transform:uppercase;margin-bottom:10px">Instruksi Dana</div>
                <div style="display:flex;align-items:center;gap:14px;margin-bottom:12px">
                    <div style="width:48px;height:48px;background:#118eea;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:22px">💙</div>
                    <div>
                        <div style="font-size:10px;color:var(--muted);margin-bottom:2px">Nomor Dana</div>
                        <div style="font-size:18px;font-weight:700;font-family:monospace">0812-3456-7890</div>
                        <div style="font-size:12px;color:var(--muted)">a/n StadionKu</div>
                    </div>
                </div>
                <div style="font-size:12px;color:var(--muted);line-height:1.8">
                    <div>1. Buka aplikasi Dana</div>
                    <div>2. Pilih Kirim → masukkan nomor di atas</div>
                    <div>3. Masukkan nominal sesuai total pembayaran</div>
                    <div>4. Screenshot bukti lalu upload di bawah</div>
                </div>
            </div>
        </div>

        {{-- Upload Bukti --}}
            {{-- Upload Bukti --}}
            <div style="padding:16px;background:var(--surface);border:1px solid var(--border);border-radius:8px">
                <label style="display:block;font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:8px">
                    Upload Bukti Pembayaran <span style="color:#f87171">*</span>
                </label>
                <input type="file" name="bukti_bayar" id="bukti_bayar" accept="image/*"
                    onchange="previewBukti(this)" style="display:none">

                <label for="bukti_bayar" id="label-bukti"
                    style="display:flex;align-items:center;gap:10px;padding:10px 16px;background:var(--card);border:1px solid var(--border);border-radius:8px;cursor:pointer;transition:border-color .15s"
                    onmouseover="this.style.borderColor='var(--accent)'"
                    onmouseout="this.style.borderColor='var(--border)'">
                    <span style="background:var(--accent);color:#0c0c0c;padding:6px 14px;border-radius:6px;font-size:12px;font-weight:600;flex-shrink:0">
                        📎 Pilih File
                    </span>
                    <span id="file-name" style="font-size:12px;color:var(--muted)">Belum ada file dipilih</span>
                </label>
                <div style="font-size:11px;color:var(--muted);margin-top:6px">
                    Upload foto/screenshot bukti transfer atau pembayaran. JPG/PNG, maks 2MB.
                </div>
                <div id="preview-bukti" style="display:none;margin-top:12px">
                    <img id="preview-img" src="" style="max-width:100%;max-height:200px;border-radius:8px;border:1px solid var(--border);object-fit:contain">
                    <button type="button" onclick="hapusBukti()"
                        style="margin-top:8px;display:flex;align-items:center;gap:6px;background:rgba(248,113,113,.1);border:1px solid rgba(248,113,113,.2);color:#f87171;padding:6px 14px;border-radius:6px;font-size:12px;cursor:pointer;font-family:var(--font)">
                        🗑 Hapus Gambar
                    </button>
                </div>
            </div>
        </div>
    </div>{{-- tutup KIRI --}}

    {{-- KANAN: Order Summary --}}
    <div style="position:sticky;top:72px">
        <div style="background:var(--card);border:1px solid var(--border);border-radius:10px;overflow:hidden">
            <div style="padding:16px 20px;border-bottom:1px solid var(--border);font-size:11px;font-family:monospace;color:var(--muted);letter-spacing:1px;text-transform:uppercase">
                Ringkasan Pesanan
            </div>
            <div style="padding:18px 20px">
                <div style="background:rgba(200,241,53,.06);border:1px solid rgba(200,241,53,.15);border-radius:8px;padding:10px 14px;display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;font-size:12px">
                    <span style="color:var(--muted)">Selesaikan dalam</span>
                    <span id="timer" style="font-family:monospace;color:var(--accent);font-weight:600">14:59</span>
                </div>
                <div style="font-size:14px;font-weight:600;margin-bottom:3px">{{ $pertandingan->tim_tuan_rumah }} vs {{ $pertandingan->tim_tamu }}</div>
                <div style="font-size:12px;color:var(--muted);margin-bottom:14px">
                    {{ \Carbon\Carbon::parse($pertandingan->tanggal_pertandingan)->format('D, d M Y') }}
                    · {{ $pertandingan->stadion->nama_stadion ?? '-' }}
                </div>
                <div style="height:1px;background:var(--border);margin-bottom:14px"></div>
                <div style="display:flex;justify-content:space-between;font-size:13px;margin-bottom:9px">
                    <span style="color:var(--muted)">Zona</span><span id="sum-zone">VIP</span>
                </div>
                <div style="display:flex;justify-content:space-between;font-size:13px;margin-bottom:9px">
                    <span style="color:var(--muted)">Kursi</span>
                    <span id="sum-seat" style="font-family:monospace;font-size:12px">Belum dipilih</span>
                </div>
                <div style="display:flex;justify-content:space-between;font-size:13px;margin-bottom:9px">
                    <span style="color:var(--muted)">Harga / kursi</span>
                    <span id="sum-price">Rp {{ number_format($pertandingan->harga_min * 2.5, 0, ',', '.') }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;font-size:13px;margin-bottom:9px">
                    <span style="color:var(--muted)">Biaya layanan</span><span>Rp 15.000</span>
                </div>
                <div style="height:1px;background:var(--border);margin:12px 0"></div>
                <div style="display:flex;justify-content:space-between;font-size:15px;font-weight:700">
                    <span>Total</span>
                    <span id="sum-total" style="color:var(--accent)">Rp 15.000</span>
                </div>
            </div>
            <div style="padding:16px 20px;border-top:1px solid var(--border);background:var(--surface)">
                <button type="button" id="btn-checkout" onclick="submitBooking()"
                    style="width:100%;padding:12px;border-radius:8px;background:var(--border);color:var(--muted);border:none;font-size:14px;font-weight:600;cursor:not-allowed;font-family:var(--font)">
                    Konfirmasi & Pesan
                </button>
                <div style="margin-top:10px;font-size:11px;color:var(--muted);text-align:center;line-height:1.5">
                    Tiket dikirim ke email setelah admin mengkonfirmasi pembayaran.
                </div>
            </div>
        </div>
    </div>{{-- tutup KANAN --}}

</div>{{-- tutup grid --}}
</form>{{-- tutup form --}}

<script>
const ZONES = {
    VIP:      { rows: ['A','B','C','D'],         cols: 10, color: '#c8a020', taken: {A:[2,5,9],B:[1,6],C:[3,8],D:[4,7]} },
    Tribune:  { rows: ['A','B','C','D','E'],      cols: 12, color: '#60a5fa', taken: {A:[3,7,11],B:[2,8],C:[5,10],D:[1,9],E:[4,12]} },
    Economy:  { rows: ['A','B','C','D','E','F'],  cols: 14, color: '#909090', taken: {A:[2,8,13],B:[5,10],C:[3,9],D:[6,11],E:[1,7],F:[4,12]} },
};

let currentZone = 'VIP';
let selectedSeats = [];
let currentPrice = {{ $pertandingan->harga_min * 2.5 }};

function selectZone(el) { selectZoneByName(el.dataset.zone); }

function selectZoneByName(zone) {
    currentZone = zone;
    selectedSeats = [];
    document.querySelectorAll('.zone-card').forEach(c => {
        c.style.border = '1px solid var(--border)';
        c.style.background = 'transparent';
        c.querySelector('div').style.color = 'var(--muted)';
    });
    const activeCard = document.querySelector(`.zone-card[data-zone="${zone}"]`);
    if (activeCard) {
        const color = ZONES[zone].color;
        activeCard.style.border = `1px solid ${color}`;
        activeCard.style.background = `${color}18`;
        activeCard.querySelector('div').style.color = color;
        currentPrice = parseFloat(activeCard.dataset.price);
    }
    ['VIP','Tribune','Economy'].forEach(z => {
        document.getElementById('ring-' + z).setAttribute('opacity', z === zone ? '0.9' : '0');
    });
    document.getElementById('legend-selected').style.background = ZONES[zone].color;
    document.getElementById('grid-label').textContent = 'Baris Kursi — ' + zone;
    document.getElementById('sum-zone').textContent = zone;
    document.getElementById('sum-price').textContent = 'Rp ' + currentPrice.toLocaleString('id-ID');
    document.getElementById('sum-seat').textContent = 'Belum dipilih';
    document.getElementById('input-zona').value = zone;
    document.getElementById('input-harga').value = currentPrice;
    updateTotal();
    buildGrid(zone);
}

function buildGrid(zone) {
    const z = ZONES[zone];
    const container = document.getElementById('seat-container');
    container.innerHTML = '';
    z.rows.forEach(row => {
        const line = document.createElement('div');
        line.style.cssText = 'display:flex;gap:3px;align-items:center;margin-bottom:2px';
        const lbl = document.createElement('div');
        lbl.style.cssText = 'font-size:9px;font-family:monospace;color:#555;min-width:14px;text-align:right;margin-right:4px';
        lbl.textContent = row;
        line.appendChild(lbl);
        for (let i = 1; i <= z.cols; i++) {
            const isTaken = (z.taken[row] || []).includes(i);
            const s = document.createElement('div');
            s.style.cssText = `width:22px;height:22px;border-radius:3px;border:1px solid ${isTaken ? '#2a2a2a' : '#2e2e2e'};background:${isTaken ? '#222' : '#1c1c1c'};font-size:8px;font-family:monospace;color:${isTaken ? '#333' : '#666'};cursor:${isTaken ? 'not-allowed' : 'pointer'};display:flex;align-items:center;justify-content:center;transition:all .1s;flex-shrink:0`;
            s.textContent = i;
            s.dataset.id = row + '-' + String(i).padStart(2, '0');
            if (!isTaken) {
                s.addEventListener('click', () => {
                    if (s.classList.contains('picked')) {
                        s.classList.remove('picked');
                        s.style.background = '#1c1c1c';
                        s.style.borderColor = '#2e2e2e';
                        s.style.color = '#666';
                        s.style.fontWeight = '400';
                        selectedSeats = selectedSeats.filter(id => id !== s.dataset.id);
                    } else {
                        if (selectedSeats.length >= 4) { alert('Maksimal 4 kursi!'); return; }
                        s.classList.add('picked');
                        s.style.background = ZONES[currentZone].color;
                        s.style.borderColor = ZONES[currentZone].color;
                        s.style.color = '#0c0c0c';
                        s.style.fontWeight = '700';
                        selectedSeats.push(s.dataset.id);
                    }
                    document.getElementById('sum-seat').textContent = selectedSeats.length ? selectedSeats.join(', ') : 'Belum dipilih';
                    document.getElementById('input-kursi').value = selectedSeats.join(',');
                    updateTotal();
                    updateCheckoutBtn();
                });
            }
            line.appendChild(s);
        }
        container.appendChild(line);
    });
}

function updateTotal() {
    const total = (selectedSeats.length * currentPrice) + 15000;
    document.getElementById('sum-total').textContent = 'Rp ' + total.toLocaleString('id-ID');
}

function updateCheckoutBtn() {
    const btn = document.getElementById('btn-checkout');
    if (selectedSeats.length > 0) {
        btn.style.background = 'var(--accent)';
        btn.style.color = '#0c0c0c';
        btn.style.cursor = 'pointer';
    } else {
        btn.style.background = '#242424';
        btn.style.color = '#585858';
        btn.style.cursor = 'not-allowed';
    }
}

function selectPay(el) {
    document.querySelectorAll('.pay-opt').forEach(o => {
        o.style.border = '1px solid var(--border)';
        o.style.background = 'var(--surface)';
    });
    el.style.border = '1px solid var(--accent)';
    el.style.background = 'rgba(200,241,53,.06)';
    document.getElementById('input-metode').value = el.dataset.pay;

    // Tampilkan instruksi sesuai metode yang dipilih
    ['QRIS','Transfer Bank','GoPay','Dana'].forEach(m => {
        document.getElementById('info-' + m).style.display = m === el.dataset.pay ? 'block' : 'none';
    });
}

function submitBooking() {
    if (selectedSeats.length === 0) { alert('Pilih kursi terlebih dahulu!'); return; }
    const nama    = document.getElementById('nama').value;
    const nik     = document.getElementById('nik').value;
    const email   = document.getElementById('email').value;
    const telepon = document.getElementById('telepon').value;
    const bukti   = document.getElementById('bukti_bayar').files.length;
    if (!nama || !nik || !email || !telepon) { alert('Lengkapi data penonton terlebih dahulu!'); return; }
    if (bukti === 0) { alert('Upload bukti pembayaran terlebih dahulu!'); return; }

    const btn = document.getElementById('btn-checkout');
    btn.disabled = true;
    btn.textContent = 'Memproses...';
    btn.style.opacity = '0.6';
    btn.style.cursor = 'not-allowed';

    console.log('id_kursi dikirim:', document.getElementById('input-kursi').value);
    
    document.getElementById('form-booking').submit();
}

function previewBukti(input) {
    const preview = document.getElementById('preview-bukti');
    const img = document.getElementById('preview-img');
    const fileName = document.getElementById('file-name');

    if (input.files && input.files[0]) {
        fileName.textContent = input.files[0].name;
        fileName.style.color = 'var(--text)';

        const reader = new FileReader();
        reader.onload = e => { img.src = e.target.result; preview.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
    }
}

function hapusBukti() {
    document.getElementById('bukti_bayar').value = '';
    document.getElementById('preview-img').src = '';
    document.getElementById('preview-bukti').style.display = 'none';
    document.getElementById('file-name').textContent = 'Belum ada file dipilih';
    document.getElementById('file-name').style.color = 'var(--muted)';
}



let timerSec = 14 * 60 + 59;
setInterval(() => {
    if (timerSec <= 0) return;
    timerSec--;
    const m = Math.floor(timerSec / 60);
    const s = timerSec % 60;
    document.getElementById('timer').textContent = String(m).padStart(2,'0') + ':' + String(s).padStart(2,'0');
}, 1000);

buildGrid('VIP');
</script>

@endsection