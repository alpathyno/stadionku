@extends('layouts.user')

@section('title', 'Pertandingan — StadionKu')

@section('content')

<div style="margin-bottom:28px">
    <div style="font-size:11px;color:var(--accent);text-transform:uppercase;letter-spacing:1px;margin-bottom:6px">Jadwal Terdekat</div>
    <div style="font-size:22px;font-weight:700;letter-spacing:-.5px">Semua Pertandingan</div>
    <div style="font-size:13px;color:var(--muted);margin-top:4px">Temukan pertandingan dan beli tiketmu sekarang.</div>
</div>

{{-- FILTER --}}
<div style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:24px;align-items:center">
    <button onclick="filterStatus('semua')" id="btn-semua"
        style="padding:7px 16px;border-radius:100px;font-size:12px;cursor:pointer;background:var(--accent);color:#0c0c0c;border:1px solid var(--accent);font-family:var(--font);font-weight:600">
        Semua
    </button>
    <button onclick="filterStatus('Dijual')" id="btn-Dijual"
        style="padding:7px 16px;border-radius:100px;font-size:12px;cursor:pointer;background:transparent;color:var(--muted);border:1px solid var(--border);font-family:var(--font)">
        Dijual
    </button>
    <button onclick="filterStatus('Terjadwal')" id="btn-Terjadwal"
        style="padding:7px 16px;border-radius:100px;font-size:12px;cursor:pointer;background:transparent;color:var(--muted);border:1px solid var(--border);font-family:var(--font)">
        Terjadwal
    </button>
    <button onclick="filterStatus('Selesai')" id="btn-Selesai"
        style="padding:7px 16px;border-radius:100px;font-size:12px;cursor:pointer;background:transparent;color:var(--muted);border:1px solid var(--border);font-family:var(--font)">
        Selesai
    </button>
</div>

{{-- LIST PERTANDINGAN --}}
<div id="list-pertandingan">
    @forelse($pertandingan as $p)
    <div class="match-card" data-status="{{ $p->status }}"
        style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:20px 24px;margin-bottom:12px;display:grid;grid-template-columns:1fr auto;gap:20px;align-items:center;transition:border-color .15s"
        onmouseover="this.style.borderColor='#2e2e2e'"
        onmouseout="this.style.borderColor='var(--border)'">

        <div>
            {{-- Status & Badge --}}
            <div style="display:flex;align-items:center;gap:8px;margin-bottom:10px">
                @if($p->status === 'Dijual')
                    <span style="font-size:10px;font-family:monospace;padding:3px 10px;border-radius:100px;background:rgba(74,222,128,.1);color:#4ade80;border:1px solid rgba(74,222,128,.2)">● Dijual</span>
                @elseif($p->status === 'Terjadwal')
                    <span style="font-size:10px;font-family:monospace;padding:3px 10px;border-radius:100px;background:rgba(251,191,36,.1);color:#fbbf24;border:1px solid rgba(251,191,36,.2)">● Terjadwal</span>
                @elseif($p->status === 'Selesai')
                    <span style="font-size:10px;font-family:monospace;padding:3px 10px;border-radius:100px;background:rgba(96,96,96,.15);color:#888;border:1px solid #2e2e2e">● Selesai</span>
                @elseif($p->status === 'Berlangsung')
                    <span style="font-size:10px;font-family:monospace;padding:3px 10px;border-radius:100px;background:rgba(96,165,250,.1);color:#60a5fa;border:1px solid rgba(96,165,250,.2)">● Berlangsung</span>
                @else
                    <span style="font-size:10px;font-family:monospace;padding:3px 10px;border-radius:100px;background:rgba(248,113,113,.1);color:#f87171;border:1px solid rgba(248,113,113,.2)">● {{ $p->status }}</span>
                @endif
            </div>

            {{-- Nama Pertandingan --}}
            <div style="font-size:16px;font-weight:700;letter-spacing:-.3px;margin-bottom:6px">
                <span style="color:var(--text)">{{ $p->tim_tuan_rumah }}</span>
                <span style="color:var(--muted);font-weight:400;font-size:13px;margin:0 6px">vs</span>
                <span style="color:var(--text)">{{ $p->tim_tamu }}</span>
            </div>

            {{-- Info --}}
            <div style="display:flex;gap:0;flex-wrap:wrap">
                <span style="font-size:12px;color:var(--muted);padding-right:14px;margin-right:14px;border-right:1px solid var(--border)">
                    {{ \Carbon\Carbon::parse($p->tanggal_pertandingan)->format('D, d M Y') }}
                </span>
                <span style="font-size:12px;color:var(--muted);padding-right:14px;margin-right:14px;border-right:1px solid var(--border)">
                    {{ \Carbon\Carbon::parse($p->jam_mulai)->format('H:i') }} WIB
                </span>
                <span style="font-size:12px;color:var(--muted);padding-right:14px;margin-right:14px;border-right:1px solid var(--border)">
                    {{ $p->stadion->nama_stadion ?? '-' }}
                </span>
                <span style="font-size:12px;color:var(--muted)">
                    Kapasitas {{ number_format($p->stadion->kapasitas ?? 0) }}
                </span>
            </div>
        </div>

        {{-- KANAN --}}
        <div style="text-align:right;min-width:140px">
            @if($p->status === 'Dijual')
                <div style="font-size:10px;color:var(--muted);font-family:monospace;letter-spacing:.5px;margin-bottom:3px">MULAI DARI</div>
                <div style="font-size:20px;font-weight:700;color:var(--accent);letter-spacing:-1px;margin-bottom:8px">
                    Rp {{ number_format($p->harga_min, 0, ',', '.') }}
                </div>
                <a href="/pertandingan/{{ $p->id_pertandingan }}"
                    style="display:inline-block;background:var(--accent);color:#0c0c0c;padding:8px 18px;border-radius:6px;font-size:12px;font-weight:600;text-decoration:none;transition:background .15s"
                    onmouseover="this.style.background='#a8d420'"
                    onmouseout="this.style.background='var(--accent)'">
                    Beli Tiket
                </a>
            @elseif($p->status === 'Selesai')
                <div style="font-size:13px;color:var(--muted)">Pertandingan Selesai</div>
            @elseif($p->status === 'Terjadwal')
                <div style="font-size:10px;color:var(--muted);margin-bottom:3px">MULAI DARI</div>
                <div style="font-size:20px;font-weight:700;letter-spacing:-1px;margin-bottom:8px">
                    Rp {{ number_format($p->harga_min, 0, ',', '.') }}
                </div>
                <button style="display:inline-block;background:transparent;color:var(--text);padding:8px 18px;border-radius:6px;font-size:12px;font-weight:500;border:1px solid var(--border);cursor:pointer;font-family:var(--font)">
                    Ingatkan Saya
                </button>
            @else
                <div style="font-size:13px;color:var(--muted)">Tiket Tidak Tersedia</div>
            @endif
        </div>
    </div>
    @empty
    <div style="background:var(--card);border:1px solid var(--border);border-radius:10px;padding:40px;text-align:center;color:var(--muted)">
        Belum ada pertandingan tersedia.
    </div>
    @endforelse
</div>

@endsection

@push('scripts')
<script>
function filterStatus(status) {
    // Reset semua tombol
    document.querySelectorAll('[id^="btn-"]').forEach(btn => {
        btn.style.background = 'transparent';
        btn.style.color = 'var(--muted)';
        btn.style.borderColor = 'var(--border)';
        btn.style.fontWeight = '400';
    });

    // Aktifkan tombol yang diklik
    const activeBtn = document.getElementById('btn-' + status);
    activeBtn.style.background = 'var(--accent)';
    activeBtn.style.color = '#0c0c0c';
    activeBtn.style.borderColor = 'var(--accent)';
    activeBtn.style.fontWeight = '600';

    // Filter card
    document.querySelectorAll('.match-card').forEach(card => {
        if (status === 'semua') {
            card.style.display = 'grid';
        } else {
            card.style.display = card.dataset.status === status ? 'grid' : 'none';
        }
    });
}
</script>
@endpush