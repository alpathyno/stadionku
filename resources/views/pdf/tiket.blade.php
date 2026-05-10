<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
        font-family: 'DejaVu Sans', sans-serif;
        background: #0c0c0c;
        color: #eaeaea;
        padding: 20px;
        font-size: 12px;
    }

    .ticket {
        background: #1a1a1a;
        border: 1px solid #2a2a2a;
        border-radius: 12px;
        overflow: hidden;
        max-width: 400px;
        margin: 0 auto;
    }

    /* Header */
    .ticket-header {
        background: #141a0a;
        padding: 18px 22px;
        border-bottom: 1px solid rgba(200,241,53,.2);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .ticket-brand {
        font-size: 16px;
        font-weight: 700;
        color: #eaeaea;
    }
    .ticket-brand span { color: #c8f135; }
    .ticket-type {
        font-size: 10px;
        color: #c8f135;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    /* Body */
    .ticket-body { padding: 22px; }

    /* Match */
    .match-section {
        text-align: center;
        padding-bottom: 18px;
        border-bottom: 1px dashed #2a2a2a;
        margin-bottom: 18px;
    }
    .match-teams {
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 5px;
        letter-spacing: -0.5px;
    }
    .match-vs { color: #555; font-weight: 400; }
    .match-date {
        font-size: 11px;
        color: #666;
    }

    /* Info Grid */
    .info-grid {
        display: table;
        width: 100%;
        margin-bottom: 18px;
    }
    .info-row {
        display: table-row;
    }
    .info-label {
        display: table-cell;
        font-size: 9px;
        color: #555;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding-bottom: 12px;
        width: 33%;
        text-align: center;
        vertical-align: top;
    }
    .info-val {
        display: block;
        font-size: 13px;
        font-weight: 700;
        color: #eaeaea;
        margin-top: 4px;
    }
    .info-val.accent { color: #c8f135; }

    /* Tear line */
    .tear-line {
        border-top: 1px dashed #2a2a2a;
        margin: 0 -22px 18px;
        position: relative;
    }

    /* QR Section */
    .qr-section {
        text-align: center;
        padding: 14px 0;
    }
    .qr-box {
        width: 100px;
        height: 100px;
        background: #111;
        border: 1px solid #2a2a2a;
        border-radius: 8px;
        margin: 0 auto 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 50px;
    }
    .qr-code {
        font-size: 13px;
        color: #555;
        letter-spacing: 2px;
        font-family: monospace;
    }
    .qr-note {
        font-size: 10px;
        color: #444;
        margin-top: 5px;
    }

    /* Footer */
    .ticket-footer {
        background: #111;
        padding: 14px 22px;
        border-top: 1px solid #222;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .footer-note {
        font-size: 10px;
        color: #444;
        line-height: 1.5;
    }
    .footer-price {
        font-size: 17px;
        font-weight: 700;
        color: #c8f135;
    }

    /* Status badge */
    .status-badge {
        display: inline-block;
        background: rgba(74,222,128,.1);
        border: 1px solid rgba(74,222,128,.2);
        color: #4ade80;
        font-size: 9px;
        padding: 2px 8px;
        border-radius: 100px;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-top: 6px;
    }
</style>
</head>
<body>

<div class="ticket">

    {{-- HEADER --}}
    <div class="ticket-header">
        <div class="ticket-brand">⚽ <span>Stadion</span>Ku</div>
        <div class="ticket-type">E-Ticket</div>
    </div>

    {{-- BODY --}}
    <div class="ticket-body">

        {{-- MATCH --}}
        <div class="match-section">
            <div class="match-teams">
                {{ $tiket->pertandingan->tim_tuan_rumah }}
                <span class="match-vs"> vs </span>
                {{ $tiket->pertandingan->tim_tamu }}
            </div>
            <div class="match-date">
                {{ \Carbon\Carbon::parse($tiket->pertandingan->tanggal_pertandingan)->format('l, d F Y') }}
                · {{ \Carbon\Carbon::parse($tiket->pertandingan->jam_mulai)->format('H:i') }} WIB
            </div>
            <div class="match-date" style="margin-top:3px">
                {{ $tiket->pertandingan->stadion->nama_stadion ?? '-' }},
                {{ $tiket->pertandingan->stadion->kota ?? '-' }}
            </div>
            <div class="status-badge">✓ Confirmed</div>
        </div>

        {{-- INFO --}}
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">
                    Tribun
                    <span class="info-val accent">{{ $tiket->zona ?? 'VIP' }}</span>
                </div>
                <div class="info-label">
                    Kursi
                    <span class="info-val" style="font-family:monospace">{{ $tiket->kode_tiket }}</span>
                </div>
                <div class="info-label">
                    Atas Nama
                    <span class="info-val">{{ $tiket->penonton->name ?? '-' }}</span>
                </div>
            </div>
        </div>

        {{-- TEAR LINE --}}
        <div class="tear-line"></div>

        {{-- QR --}}
        <div class="qr-section">
            <div class="qr-box">▦</div>
            <div class="qr-code">{{ $tiket->kode_tiket }}</div>
            <div class="qr-note">Tunjukkan QR ini di pintu masuk stadion</div>
        </div>

    </div>

    {{-- FOOTER --}}
    <div class="ticket-footer">
        <div class="footer-note">
            Tiket berlaku untuk 1 orang.<br>
            Dilarang dipindahtangankan.
        </div>
        <div class="footer-price">
            Rp {{ number_format($tiket->transaksi->total_bayar ?? 0, 0, ',', '.') }}
        </div>
    </div>

</div>

</body>
</html>