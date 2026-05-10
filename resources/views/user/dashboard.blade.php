@extends('layouts.user')

@section('title', 'Dashboard — StadionKu')

@section('content')

{{-- SAMBUTAN --}}
<div style="margin-bottom:32px">
    <div style="font-size:12px;color:var(--accent);font-weight:500;letter-spacing:1px;text-transform:uppercase;margin-bottom:8px">
        Selamat datang kembali
    </div>
    <div style="font-size:26px;font-weight:700;letter-spacing:-.5px">
        {{ auth()->user()->name }} !
    </div>
    <div style="font-size:13px;color:var(--muted);margin-top:4px">
        Temukan pertandingan favoritmu dan beli tiket sekarang.
    </div>
</div>

{{-- STATS --}}
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:36px">
    <div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:20px">
        <div style="font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:10px">Tiket Dimiliki</div>
        <div style="font-size:28px;font-weight:700;color:var(--accent)">{{ $totalTiket }}</div>
    </div>
    <div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:20px">
        <div style="font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:10px">Pertandingan Ditonton</div>
        <div style="font-size:28px;font-weight:700;">{{ $totalNonton }}</div>
    </div>
    <div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:20px">
        <div style="font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:10px">Total Pengeluaran</div>
        <div style="font-size:28px;font-weight:700;">Rp {{ number_format($totalBayar, 0, ',', '.') }}</div>
    </div>
</div>

{{-- PERTANDINGAN MENDATANG --}}
<div style="margin-bottom:36px">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px">
        <div>
            <div style="font-size:11px;color:var(--accent);text-transform:uppercase;letter-spacing:1px;margin-bottom:4px">Jadwal Terdekat</div>
            <div style="font-size:18px;font-weight:600;letter-spacing:-.3px">Pertandingan Mendatang</div>
        </div>
        <a href="/pertandingan" style="font-size:13px;color:var(--accent);text-decoration:none;font-weight:500">
            Lihat Semua →
        </a>
    </div>

    @forelse($pertandingan as $p)
    <div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:18px 22px;margin-bottom:10px;display:flex;align-items:center;gap:16px;transition:border-color .15s"
        onmouseover="this.style.borderColor='#2e2e2e'"
        onmouseout="this.style.borderColor='#242424'">

        <div style="font-size:12px;color:var(--muted);min-width:90px;font-family:monospace">
            {{ \Carbon\Carbon::parse($p->tanggal_pertandingan)->format('D, d M') }}
        </div>

        <div style="flex:1">
            <div style="font-size:15px;font-weight:600;margin-bottom:3px">
                {{ $p->tim_tuan_rumah }} <span style="color:var(--muted);font-weight:400;font-size:12px">vs</span> {{ $p->tim_tamu }}
            </div>
            <div style="font-size:12px;color:var(--muted)">
                {{ $p->stadion->nama_stadion ?? '-' }} · {{ \Carbon\Carbon::parse($p->jam_mulai)->format('H:i') }} WIB
            </div>
        </div>

        <span style="display:inline-flex;align-items:center;gap:5px;font-size:10px;font-family:monospace;padding:3px 10px;border-radius:100px;background:rgba(74,222,128,.1);color:#4ade80;border:1px solid rgba(74,222,128,.2)">
            ● Dijual
        </span>

        <div style="text-align:right">
            <div style="font-size:11px;color:var(--muted);margin-bottom:2px">mulai dari</div>
            <div style="font-size:15px;font-weight:700;color:var(--accent)">
                Rp {{ number_format($p->harga_min, 0, ',', '.') }}
            </div>
        </div>

        <a href="/pertandingan/{{ $p->id }}"
            style="background:var(--accent);color:#0c0c0c;padding:8px 16px;border-radius:6px;font-size:12px;font-weight:600;text-decoration:none;white-space:nowrap;transition:background .15s"
            onmouseover="this.style.background='#a8d420'"
            onmouseout="this.style.background='var(--accent)'">
            Beli Tiket
        </a>
    </div>
    @empty
    <div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:32px;text-align:center;color:var(--muted)">
        Belum ada pertandingan tersedia saat ini.
    </div>
    @endforelse
</div>

{{-- RIWAYAT TIKET TERAKHIR --}}
<div>
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px">
        <div>
            <div style="font-size:11px;color:var(--accent);text-transform:uppercase;letter-spacing:1px;margin-bottom:4px">Aktivitas</div>
            <div style="font-size:18px;font-weight:600;letter-spacing:-.3px">Tiket Terakhir</div>
        </div>
        <a href="/riwayat" style="font-size:13px;color:var(--accent);text-decoration:none;font-weight:500">
            Lihat Semua →
        </a>
    </div>

    @forelse($riwayat as $t)
    <div style="background:var(--card);border:1px solid var(--border);border-radius:10px;overflow:hidden;margin-bottom:10px">
        <div style="padding:16px 22px;display:flex;justify-content:space-between;align-items:start">
            <div>
                <div style="font-size:15px;font-weight:600;margin-bottom:4px">
                    {{ $t->pertandingan->tim_tuan_rumah }} vs {{ $t->pertandingan->tim_tamu }}
                </div>
                <div style="font-size:12px;color:var(--muted)">
                    {{ \Carbon\Carbon::parse($t->pertandingan->tanggal_pertandingan)->format('D, d M Y') }}
                    · {{ $t->pertandingan->stadion->nama_stadion ?? '-' }}
                </div>
            </div>
            <div style="text-align:right">
                <div style="font-size:15px;font-weight:600;color:var(--accent);margin-bottom:6px">
                    Rp {{ number_format($t->transaksi->total_bayar ?? 0, 0, ',', '.') }}
                </div>
                @if($t->status_tiket === 'Aktif')
                    <span style="font-size:10px;font-family:monospace;padding:3px 9px;border-radius:100px;background:rgba(74,222,128,.1);color:#4ade80;border:1px solid rgba(74,222,128,.2)">● Aktif</span>
                @elseif($t->status_tiket === 'Digunakan')
                    <span style="font-size:10px;font-family:monospace;padding:3px 9px;border-radius:100px;background:rgba(96,96,96,.15);color:#888;border:1px solid #2e2e2e">● Digunakan</span>
                @else
                    <span style="font-size:10px;font-family:monospace;padding:3px 9px;border-radius:100px;background:rgba(248,113,113,.1);color:#f87171;border:1px solid rgba(248,113,113,.2)">● Dibatalkan</span>
                @endif
            </div>
        </div>
        <div style="padding:12px 22px;background:var(--surface);border-top:1px solid var(--border);display:flex;gap:20px;align-items:center">
            <div style="font-size:12px;color:var(--muted)">
                Kursi: <strong style="color:var(--text);font-family:monospace">{{ $t->kursi->nomor_kursi ?? '-' }}</strong>
            </div>
            <div style="font-size:12px;color:var(--muted)">
                Kategori: <strong style="color:var(--accent)">{{ $t->kursi->kategori ?? '-' }}</strong>
            </div>
            <div style="margin-left:auto">
                <a href="/riwayat/{{ $t->id }}"
                    style="font-size:12px;color:var(--text);text-decoration:none;border:1px solid var(--border);padding:6px 14px;border-radius:6px;transition:border-color .15s"
                    onmouseover="this.style.borderColor='var(--muted)'"
                    onmouseout="this.style.borderColor='var(--border)'">
                    Lihat Tiket
                </a>
            </div>
        </div>
    </div>
    @empty
    <div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:32px;text-align:center;color:var(--muted)">
        Belum ada tiket yang dibeli.
        <a href="/pertandingan" style="color:var(--accent);text-decoration:none;font-weight:500;margin-left:6px">Beli sekarang →</a>
    </div>
    @endforelse
</div>

@endsection