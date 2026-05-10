<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
    <title>StadionKu — Tiket Sepakbola Eropa</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,900;1,400&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --accent: #c8f135;
            --accent-dim: rgba(200,241,53,.12);
            --bg: #080808;
            --card: #111111;
            --border: rgba(255,255,255,.07);
            --muted: #666;
            --text: #f0f0f0;
            --font: 'DM Sans', sans-serif;
            --display: 'DM Serif Display', serif;
        }

        html { scroll-behavior: smooth; }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: var(--font);
            overflow-x: hidden;
        }

        /* ── NOISE OVERLAY ── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 0;
            opacity: .4;
        }

        /* ── NAVBAR ── */
        nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 60px;
            background: rgba(8,8,8,.7);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border);
        }

        .nav-logo {
            font-family: var(--display);
            font-size: 22px;
            color: var(--accent);
            letter-spacing: -.3px;
        }

        .nav-links {
            display: flex;
            gap: 32px;
            list-style: none;
        }

        .nav-links a {
            color: var(--muted);
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            letter-spacing: .3px;
            transition: color .2s;
        }

        .nav-links a:hover { color: var(--text); }

        .nav-cta {
            background: var(--accent);
            color: #0a0a0a;
            padding: 9px 22px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: opacity .2s;
        }

        .nav-cta:hover { opacity: .85; }

        /* ── HERO ── */
        #hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            z-index: 0;
        }

        /* Ganti src dengan gambar stadion kamu */
        .hero-bg img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            opacity: .75;
        }

        .hero-bg::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to right, rgba(8,8,8,1) 35%, rgba(8,8,8,.4) 70%, rgba(8,8,8,.8) 100%),
                        linear-gradient(to top, rgba(8,8,8,1) 0%, transparent 40%);
        }

        /* Placeholder kalau belum ada gambar */
        .hero-bg-placeholder {
            width: 100%;
            height: 100%;
            background: radial-gradient(ellipse at 70% 50%, rgba(200,241,53,.06) 0%, transparent 60%),
                        linear-gradient(135deg, #0d0d0d 0%, #080808 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-bg-placeholder span {
            font-size: 11px;
            color: var(--muted);
            letter-spacing: 2px;
            text-transform: uppercase;
            border: 1px dashed rgba(255,255,255,.1);
            padding: 10px 20px;
            border-radius: 4px;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 680px;
            padding: 0 60px;
            animation: fadeUp .8s ease both;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--accent-dim);
            border: 1px solid rgba(200,241,53,.2);
            color: var(--accent);
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 6px 14px;
            border-radius: 100px;
            margin-bottom: 28px;
        }

        .hero-badge::before {
            content: '';
            width: 6px; height: 6px;
            background: var(--accent);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        .hero-title {
            font-family: var(--display);
            font-size: clamp(44px, 6vw, 78px);
            line-height: 1.05;
            letter-spacing: -1.5px;
            margin-bottom: 24px;
            color: #fff;
        }

        .hero-title em {
            font-style: italic;
            color: var(--accent);
        }

        .hero-desc {
            font-size: 16px;
            color: var(--muted);
            line-height: 1.7;
            max-width: 480px;
            margin-bottom: 40px;
            font-weight: 400;
        }

        .hero-actions {
            display: flex;
            gap: 14px;
            align-items: center;
        }

        .btn-primary {
            background: var(--accent);
            color: #080808;
            padding: 14px 32px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: all .2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary:hover {
            opacity: .9;
            transform: translateY(-1px);
        }

        .btn-ghost {
            color: var(--muted);
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: color .2s;
        }

        .btn-ghost:hover { color: var(--text); }

        .hero-stats {
            position: absolute;
            bottom: 60px;
            left: 60px;
            right: 60px;
            z-index: 1;
            display: flex;
            gap: 40px;
            animation: fadeUp .8s .3s ease both;
        }

        .stat-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .stat-num {
            font-family: var(--display);
            font-size: 32px;
            color: var(--accent);
            line-height: 1;
        }

        .stat-label {
            font-size: 11px;
            color: var(--muted);
            letter-spacing: .5px;
            text-transform: uppercase;
        }

        .stat-divider {
            width: 1px;
            background: var(--border);
            align-self: stretch;
        }

        /* ── SECTION COMMON ── */
        section {
            position: relative;
            z-index: 1;
        }

        .section-label {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 12px;
        }

        .section-title {
            font-family: var(--display);
            font-size: clamp(28px, 3.5vw, 46px);
            line-height: 1.1;
            letter-spacing: -.5px;
            color: #fff;
            margin-bottom: 16px;
        }

        .section-desc {
            font-size: 15px;
            color: var(--muted);
            line-height: 1.7;
            max-width: 500px;
        }

        /* ── GALERI STADION ── */
        #galeri {
            padding: 100px 60px;
        }

        .galeri-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 40px;
        }

        .galeri-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            grid-template-rows: 240px 200px;
            gap: 10px;
            border-radius: 12px;
            overflow: hidden;
        }

        .galeri-item {
            position: relative;
            overflow: hidden;
            background: var(--card);
            border: 1px dashed rgba(255,255,255,.08);
        }

        .galeri-item:first-child {
            grid-row: span 2;
        }

        /* Ganti src img di masing-masing galeri-item dengan gambar kamu */
        .galeri-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease;
        }

        .galeri-item:hover img { transform: scale(1.04); }

        .galeri-item-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .galeri-item-placeholder .icon {
            font-size: 28px;
            opacity: .3;
        }

        .galeri-item-placeholder span {
            font-size: 10px;
            color: var(--muted);
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .galeri-caption {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            padding: 10px 14px;
            background: linear-gradient(to top, rgba(0,0,0,.8), transparent);
            font-size: 11px;
            color: rgba(255,255,255,.6);
            letter-spacing: .3px;
        }

        /* ── FITUR ── */
        #fitur {
            padding: 100px 60px;
            background: linear-gradient(to bottom, transparent, rgba(200,241,53,.03), transparent);
        }

        .fitur-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1px;
            background: var(--border);
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
            margin-top: 56px;
        }

        .fitur-card {
            background: var(--bg);
            padding: 36px 32px;
            transition: background .2s;
        }

        .fitur-card:hover { background: var(--card); }

        .fitur-icon {
            width: 44px; height: 44px;
            background: var(--accent-dim);
            border: 1px solid rgba(200,241,53,.15);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .fitur-name {
            font-size: 15px;
            font-weight: 600;
            color: #fff;
            margin-bottom: 10px;
        }

        .fitur-desc {
            font-size: 13px;
            color: var(--muted);
            line-height: 1.6;
        }

        /* ── JADWAL ── */
        #jadwal {
            padding: 100px 60px;
        }

        .jadwal-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 32px;
        }

        .jadwal-list {
            display: flex;
            flex-direction: column;
            gap: 1px;
            background: var(--border);
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
        }

        .jadwal-row {
            background: var(--bg);
            padding: 20px 28px;
            display: grid;
            grid-template-columns: 120px 1fr 120px 100px;
            align-items: center;
            gap: 20px;
            transition: background .15s;
        }

        .jadwal-row:hover { background: var(--card); }

        .jadwal-date {
            font-size: 11px;
            color: var(--muted);
            font-family: monospace;
        }

        .jadwal-match {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .team-name {
            font-size: 14px;
            font-weight: 600;
            color: #fff;
        }

        .vs-badge {
            font-size: 10px;
            color: var(--muted);
            background: var(--card);
            border: 1px solid var(--border);
            padding: 2px 8px;
            border-radius: 4px;
            font-weight: 600;
            letter-spacing: .5px;
        }

        .jadwal-venue {
            font-size: 12px;
            color: var(--muted);
        }

        .jadwal-status {
            text-align: right;
        }

        .badge-available {
            display: inline-block;
            font-size: 10px;
            font-family: monospace;
            padding: 3px 10px;
            border-radius: 100px;
            background: var(--accent-dim);
            color: var(--accent);
            border: 1px solid rgba(200,241,53,.2);
        }

        .badge-soon {
            display: inline-block;
            font-size: 10px;
            font-family: monospace;
            padding: 3px 10px;
            border-radius: 100px;
            background: rgba(251,191,36,.1);
            color: #fbbf24;
            border: 1px solid rgba(251,191,36,.2);
        }

        .jadwal-empty {
            padding: 60px;
            text-align: center;
            color: var(--muted);
            font-size: 13px;
        }

        /* ── CARA PESAN ── */
        #cara-pesan {
            padding: 100px 60px;
            background: linear-gradient(to bottom, transparent, rgba(200,241,53,.02), transparent);
        }

        .cara-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-top: 56px;
        }

        .cara-card {
            position: relative;
            padding: 32px 24px;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 12px;
            transition: border-color .2s, transform .2s;
        }

        .cara-card:hover {
            border-color: rgba(200,241,53,.2);
            transform: translateY(-3px);
        }

        .cara-number {
            font-family: var(--display);
            font-size: 56px;
            color: rgba(200,241,53,.08);
            line-height: 1;
            position: absolute;
            top: 16px; right: 20px;
        }

        .cara-icon {
            font-size: 28px;
            margin-bottom: 16px;
        }

        .cara-title {
            font-size: 14px;
            font-weight: 600;
            color: #fff;
            margin-bottom: 8px;
        }

        .cara-desc {
            font-size: 12px;
            color: var(--muted);
            line-height: 1.6;
        }

        .cara-connector {
            position: absolute;
            top: 50%;
            right: -13px;
            width: 24px;
            height: 1px;
            background: var(--border);
            z-index: 2;
        }

        .cara-connector::after {
            content: '›';
            position: absolute;
            right: -4px;
            top: -9px;
            color: var(--muted);
            font-size: 14px;
        }

        .cara-card:last-child .cara-connector { display: none; }

        /* ── PEMAIN SECTION ── */
        #pemain {
            padding: 100px 60px;
        }

        .pemain-scroll {
            display: flex;
            gap: 16px;
            margin-top: 40px;
            overflow-x: auto;
            padding-bottom: 10px;
            scrollbar-width: none;
        }

        .pemain-scroll::-webkit-scrollbar { display: none; }

        .pemain-card {
            flex: 0 0 220px;
            border-radius: 10px;
            overflow: hidden;
            background: var(--card);
            border: 1px solid var(--border);
            position: relative;
        }

        .pemain-img {
            width: 100%;
            height: 280px;
            object-fit: cover;
            object-position: top;
            display: block;
        }

        /* Placeholder pemain */
        .pemain-placeholder {
            width: 100%;
            height: 280px;
            background: linear-gradient(to bottom, var(--card), #1a1a1a);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border-bottom: 1px solid var(--border);
        }

        .pemain-placeholder .icon { font-size: 40px; opacity: .2; }
        .pemain-placeholder span { font-size: 10px; color: var(--muted); letter-spacing: 1.5px; text-transform: uppercase; }

        .pemain-info {
            padding: 14px 16px;
        }

        .pemain-name {
            font-size: 13px;
            font-weight: 600;
            color: #fff;
            margin-bottom: 2px;
        }

        .pemain-club {
            font-size: 11px;
            color: var(--muted);
        }

        .pemain-accent {
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: var(--accent);
        }

        /* ── CTA SECTION ── */
        #cta {
            padding: 120px 60px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        #cta::before {
            content: '';
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(200,241,53,.06) 0%, transparent 70%);
            pointer-events: none;
        }

        .cta-title {
            font-family: var(--display);
            font-size: clamp(36px, 5vw, 64px);
            letter-spacing: -1px;
            line-height: 1.05;
            color: #fff;
            margin-bottom: 20px;
        }

        .cta-title em {
            font-style: italic;
            color: var(--accent);
        }

        .cta-desc {
            font-size: 15px;
            color: var(--muted);
            margin-bottom: 40px;
            line-height: 1.6;
        }

        /* ── FOOTER ── */
        footer {
            border-top: 1px solid var(--border);
            padding: 32px 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .footer-logo {
            font-family: var(--display);
            font-size: 18px;
            color: var(--accent);
        }

        .footer-copy {
            font-size: 12px;
            color: var(--muted);
        }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50%       { opacity: .3; }
        }

        .reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity .6s ease, transform .6s ease;
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<nav>
    <div class="nav-logo">StadionKu</div>
    <ul class="nav-links">
        <li><a href="#fitur">Fitur</a></li>
        <li><a href="#jadwal">Jadwal</a></li>
        <li><a href="#cara-pesan">Cara Pesan</a></li>
    </ul>
    <a href="/login" class="nav-cta">Masuk →</a>
</nav>

{{-- HERO --}}
<section id="hero">
    <div class="hero-bg">
        {{--
            GANTI GAMBAR HERO:
            Hapus div.hero-bg-placeholder di bawah, ganti dengan:
            <img src="{{ asset('images/hero-stadion.jpg') }}" alt="Stadion">
        --}}
        <img src="{{ asset('images/Champions.jpg') }}" alt="Stadion">
    </div>

    <div class="hero-content">
        <div class="hero-badge">Tiket Resmi Tersedia</div>
        <h1 class="hero-title">
            Rasakan <em>Atmosfer</em><br>Sepakbola Eropa
        </h1>
        <p class="hero-desc">
            Pesan tiket pertandingan sepakbola Eropa favoritmu dengan mudah, aman, dan cepat. Kursi pilihan, harga terbaik.
        </p>
        <div class="hero-actions">
            <a href="/login" class="btn-primary">Pesan Tiket Sekarang →</a>
            <a href="#jadwal" class="btn-ghost">Lihat Jadwal ↓</a>
        </div>
    </div>

    <div class="hero-stats">
    </div>
</section>

{{-- GALERI STADION --}}
<section id="galeri">
    <div class="galeri-header reveal">
        <div>
            <div class="section-label">Venue</div>
            <h2 class="section-title">Stadion Ikonik Eropa</h2>
        </div>
        <p class="section-desc" style="text-align:right;max-width:300px">
            Dari Old Trafford hingga San Siro — saksikan langsung keajaiban sepakbola dunia.
        </p>
    </div>

    <div class="galeri-grid reveal">
        {{-- GAMBAR 1 (besar, kiri) — ganti dengan: <img src="{{ asset('images/stadion-1.jpg') }}" alt="Stadion 1"> --}}
        <div class="galeri-item">
            <img src="{{ asset('images/Old Trafford.jpg') }}" alt="Old Trafford">
            <div class="galeri-caption">Old Trafford · Manchester</div>
        </div>

        {{-- GAMBAR 2 --}}
        <div class="galeri-item">
            <img src="{{ asset('images/Camp Nou.jpg') }}" alt="Old Trafford">
            <div class="galeri-caption">Camp Nou · Barcelona</div>
        </div>

        {{-- GAMBAR 3 --}}
        <div class="galeri-item">
            <img src="{{ asset('images/San Siro.jpg') }}" alt="Old Trafford">
            <div class="galeri-caption">San Siro · Milan</div>
        </div>

        {{-- GAMBAR 4 --}}
        <div class="galeri-item">
            <img src="{{ asset('images/Allianz Arena.jpg') }}" alt="Old Trafford">
            <div class="galeri-caption">Allianz Arena · München</div>
        </div>

        {{-- GAMBAR 5 --}}
        <div class="galeri-item">
            <img src="{{ asset('images/Parc Des Princes.jpg') }}" alt="Old Trafford">
            <div class="galeri-caption">Parc des Princes · Paris</div>
        </div>
    </div>
</section>

{{-- FITUR --}}
<section id="fitur">
    <div style="text-align:center" class="reveal">
        <div class="section-label">Keunggulan</div>
        <h2 class="section-title">Kenapa StadionKu?</h2>
        <p class="section-desc" style="margin: 0 auto">Platform tiket sepakbola yang dirancang untuk pengalaman terbaik kamu.</p>
    </div>

    <div class="fitur-grid">
        <div class="fitur-card reveal">
            <div class="fitur-icon">🎫</div>
            <div class="fitur-name">Pilih Kursi Interaktif</div>
            <p class="fitur-desc">Pilih kursi favoritmu langsung dari peta stadion — zona VIP, Tribune, atau Ekonomi.</p>
        </div>
        <div class="fitur-card reveal">
            <div class="fitur-icon">🔒</div>
            <div class="fitur-name">Transaksi Aman</div>
            <p class="fitur-desc">Upload bukti pembayaran dan tunggu konfirmasi admin. Tiket hanya terbit setelah diverifikasi.</p>
        </div>
        <div class="fitur-card reveal">
            <div class="fitur-icon">📄</div>
            <div class="fitur-name">Tiket PDF Otomatis</div>
            <p class="fitur-desc">Setelah transaksi disetujui, tiket PDF langsung bisa diunduh dan dibawa ke stadion.</p>
        </div>
        <div class="fitur-card reveal">
            <div class="fitur-icon">📅</div>
            <div class="fitur-name">Jadwal Terkini</div>
            <p class="fitur-desc">Semua jadwal pertandingan selalu diperbarui oleh admin secara real-time.</p>
        </div>
        <div class="fitur-card reveal">
            <div class="fitur-icon">📜</div>
            <div class="fitur-name">Riwayat Pemesanan</div>
            <p class="fitur-desc">Pantau semua transaksimu — dari menunggu hingga tiket sudah di tangan.</p>
        </div>
        <div class="fitur-card reveal">
            <div class="fitur-icon">⚡</div>
            <div class="fitur-name">Proses Cepat</div>
            <p class="fitur-desc">Dari pilih kursi hingga tiket jadi — cukup beberapa langkah mudah.</p>
        </div>
    </div>
</section>

{{-- JADWAL --}}
<section id="jadwal">
    <div class="jadwal-header reveal">
        <div>
            <div class="section-label">Upcoming</div>
            <h2 class="section-title">Jadwal Pertandingan</h2>
        </div>
        <a href="/login" class="btn-primary" style="font-size:13px;padding:10px 22px">Lihat Semua →</a>
    </div>

    <div class="jadwal-list reveal">
        @forelse($pertandingan as $p)
        <div class="jadwal-row">
            <div class="jadwal-date">
                {{ \Carbon\Carbon::parse($p->tanggal_pertandingan)->format('d M Y') }} · {{ \Carbon\Carbon::parse($p->jam_mulai)->format('H:i') }}
            </div>
            <div class="jadwal-match">
                <span class="team-name">{{ $p->tim_tuan_rumah }}</span>
                <span class="vs-badge">VS</span>
                <span class="team-name">{{ $p->tim_tamu }}</span>
            </div>
            <div class="jadwal-venue">🏟 {{ $p->stadion->nama_stadion ?? '-' }}</div>
            <div class="jadwal-status">
                @if($p->status === 'Dijual')
                    <span class="badge-available">● Dijual</span>
                @else
                    <span class="badge-soon">● {{ $p->status }}</span>
                @endif
            </div>
        </div>
        @empty
        <div class="jadwal-empty">
            Jadwal pertandingan akan segera hadir.
        </div>
        @endforelse
    </div>
</section>

{{-- PEMAIN --}}
<section id="pemain">
    <div class="reveal">
        <div class="section-label">Bintang Lapangan</div>
        <h2 class="section-title">Pemain Eropa Terbaik</h2>
        <p class="section-desc">Saksikan langsung para bintang dunia beraksi di atas rumput.</p>
    </div>

    <div class="pemain-scroll">
        {{--
            CARA GANTI GAMBAR PEMAIN:
            Ganti div.pemain-placeholder dengan:
            <img class="pemain-img" src="{{ asset('images/pemain-1.jpg') }}" alt="Nama Pemain">
        --}}
        @php
        $pemain = [
            ['nama' => 'Lamine Yamal', 'klub' => 'Barcelona'],
            ['nama' => 'Harry Kane', 'klub' => 'Bayern Munchen'],
            ['nama' => 'Kylian Mbappe', 'klub' => 'Real Madrid'],
            ['nama' => 'Erling Haaland', 'klub' => 'Manchester City'],
            ['nama' => 'Ousmane Dembélé', 'klub' => 'PSG'],
            ['nama' => 'Julián Alvarez', 'klub' => 'Atletico Madrid'],
        ];
        @endphp

        @foreach($pemain as $i => $p)
        <div class="pemain-card">
            <div class="pemain-accent"></div>
            {{-- Ganti dengan <img class="pemain-img" src="{{ asset('images/pemain-' . ($i+1) . '.jpg') }}" alt="{{ $p['nama'] }}"> --}}
            <img class="pemain-img" src="{{ asset('images/pemain-' . ($i+1) . '.jpg') }}" alt="{{ $p['nama'] }}">
            <div class="pemain-info">
                <div class="pemain-name">{{ $p['nama'] }}</div>
                <div class="pemain-club">{{ $p['klub'] }}</div>
            </div>
        </div>
        @endforeach
    </div>
</section>

{{-- CARA PESAN --}}
<section id="cara-pesan">
    <div style="text-align:center" class="reveal">
        <div class="section-label">Panduan</div>
        <h2 class="section-title">Cara Pesan Tiket</h2>
        <p class="section-desc" style="margin:0 auto">Empat langkah mudah untuk duduk di tribun stadion impianmu.</p>
    </div>

    <div class="cara-grid">
        <div class="cara-card reveal">
            <div class="cara-number">01</div>
            <div class="cara-icon">🔑</div>
            <div class="cara-title">Daftar & Masuk</div>
            <p class="cara-desc">Buat akun atau langsung login ke StadionKu.</p>
            <div class="cara-connector"></div>
        </div>
        <div class="cara-card reveal">
            <div class="cara-number">02</div>
            <div class="cara-icon">📅</div>
            <div class="cara-title">Pilih Pertandingan</div>
            <p class="cara-desc">Telusuri jadwal dan pilih laga yang ingin kamu tonton.</p>
            <div class="cara-connector"></div>
        </div>
        <div class="cara-card reveal">
            <div class="cara-number">03</div>
            <div class="cara-icon">💺</div>
            <div class="cara-title">Pilih Zona Kursi</div>
            <p class="cara-desc">Pilih zona VIP, Tribune, atau Ekonomi sesuai budget.</p>
            <div class="cara-connector"></div>
        </div>
        <div class="cara-card reveal">
            <div class="cara-number">04</div>
            <div class="cara-icon">📄</div>
            <div class="cara-title">Unduh Tiket</div>
            <p class="cara-desc">Bayar, upload bukti, dan tiket PDF siap diunduh setelah disetujui.</p>
        </div>
    </div>
</section>

{{-- CTA --}}
<section id="cta">
    <div class="reveal">
        <h2 class="cta-title">Siap Rasakan<br><em>Atmosfernya?</em></h2>
        <p class="cta-desc">Ribuan kursi menunggu. Jangan sampai kehabisan.</p>
        <a href="/login" class="btn-primary" style="font-size:15px;padding:16px 40px">
            Pesan Tiket Sekarang →
        </a>
    </div>
</section>

{{-- FOOTER --}}
<footer>
    <div class="footer-logo">StadionKu</div>
    <div class="footer-copy">© {{ date('Y') }} StadionKu. All rights reserved.</div>
</footer>

<script>
    // Scroll reveal
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                setTimeout(() => entry.target.classList.add('visible'), i * 80);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>

</body>
</html>