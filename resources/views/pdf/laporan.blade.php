<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'DejaVu Sans', sans-serif; font-size: 11px; color: #1a1a1a; padding: 20px; }
    .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #c8f135; padding-bottom: 14px; }
    .header h1 { font-size: 18px; font-weight: 700; margin-bottom: 4px; }
    .header p { font-size: 11px; color: #666; }
    .summary { display: flex; gap: 16px; margin-bottom: 16px; }
    .summary-box { flex: 1; background: #f5f5f5; border-radius: 6px; padding: 10px 14px; }
    .summary-label { font-size: 9px; color: #888; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px; }
    .summary-val { font-size: 15px; font-weight: 700; }
    table { width: 100%; border-collapse: collapse; }
    thead th { background: #1a1a1a; color: #fff; padding: 8px 10px; text-align: left; font-size: 9px; text-transform: uppercase; letter-spacing: .5px; }
    tbody td { padding: 8px 10px; border-bottom: 1px solid #eee; font-size: 10px; }
    tbody tr:nth-child(even) td { background: #f9f9f9; }
    .accent { color: #2a7a00; font-weight: 600; }
    .footer { margin-top: 20px; text-align: right; font-size: 10px; color: #888; }
</style>
</head>
<body>

<div class="header">
    <h1>⚽ StadionKu — Laporan Transaksi</h1>
    <p>Digenerate pada {{ now()->format('d F Y, H:i') }} WIB</p>
</div>

<div class="summary">
    <div class="summary-box">
        <div class="summary-label">Total Transaksi</div>
        <div class="summary-val">{{ $transaksi->count() }}</div>
    </div>
    <div class="summary-box">
        <div class="summary-label">Total Pendapatan (Lunas)</div>
        <div class="summary-val">Rp {{ number_format($totalLunas, 0, ',', '.') }}</div>
    </div>
    <div class="summary-box">
        <div class="summary-label">Transaksi Lunas</div>
        <div class="summary-val">{{ $transaksi->where('status_bayar','Lunas')->count() }}</div>
    </div>
    <div class="summary-box">
        <div class="summary-label">Transaksi Pending</div>
        <div class="summary-val">{{ $transaksi->where('status_bayar','Pending')->count() }}</div>
    </div>
</div>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Tiket</th>
            <th>Penonton</th>
            <th>Pertandingan</th>
            <th>Metode</th>
            <th>Total</th>
            <th>Tanggal</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transaksi as $i => $t)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td style="font-family:monospace">{{ $t->tiket->kode_tiket ?? '-' }}</td>
            <td>{{ $t->tiket->penonton->name ?? '-' }}</td>
            <td>{{ ($t->tiket->pertandingan->tim_tuan_rumah ?? '-') }} vs {{ ($t->tiket->pertandingan->tim_tamu ?? '-') }}</td>
            <td>{{ $t->metode_bayar }}</td>
            <td class="accent">Rp {{ number_format($t->total_bayar, 0, ',', '.') }}</td>
            <td>{{ \Carbon\Carbon::parse($t->tgl_transaksi)->format('d M Y') }}</td>
            <td>{{ $t->status_bayar }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="footer">StadionKu — Platform Tiket Sepakbola</div>

</body>
</html>