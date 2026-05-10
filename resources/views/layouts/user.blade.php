<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>@yield('title', 'StadionKu')</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --bg: #0c0c0c;
            --surface: #141414;
            --card: #1a1a1a;
            --border: #242424;
            --text: #eaeaea;
            --muted: #585858;
            --accent: #c8f135;
            --accent2: #a8d420;
            --font: 'DM Sans', sans-serif;
            --sidebar-w: 280px;
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: var(--font);
            font-size: 14px;
            min-height: 100vh;
        }

        /* ── TOPBAR ── */
        .topbar {
            position: sticky;
            top: 0;
            z-index: 50;
            height: 56px;
            background: rgba(12,12,12,.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        /* ── HAMBURGER ── */
        .hamburger {
            width: 38px;
            height: 38px;
            background: var(--accent);
            border: none;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 5px;
            flex-shrink: 0;
            transition: opacity .15s;
        }
        .hamburger:hover { opacity: .85; }
        .hamburger span {
            display: block;
            width: 16px;
            height: 2px;
            background: #0a0a0a;
            border-radius: 2px;
            transition: all .25s;
        }

        .topbar-brand {
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .topbar-brand em {
            color: var(--accent);
            font-style: normal;
        }

        /* Dropdown user di topbar */
        .topbar-right {
            display: flex;
            align-items: center;
        }
        .dropdown { position: relative; }
        .navbar-user {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: var(--muted);
            cursor: pointer;
        }
        .navbar-avatar {
            width: 32px; height: 32px;
            border-radius: 50%;
            background: var(--surface);
            border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            font-size: 14px;
        }
        .dropdown-menu {
            display: none;
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 6px;
            min-width: 180px;
            z-index: 300;
        }
        .dropdown-menu.show { display: block; }
        .dropdown-item {
            display: block;
            padding: 9px 14px;
            font-size: 13px;
            color: var(--text);
            text-decoration: none;
            border-radius: 6px;
            transition: background .15s;
        }
        .dropdown-item:hover { background: var(--surface); }
        .dropdown-item.danger { color: #f87171; }
        .dropdown-divider { height: 1px; background: var(--border); margin: 4px 0; }

        /* ── OVERLAY ── */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 99;
            background: rgba(0,0,0,.5);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }
        .sidebar-overlay.show { display: block; }

        /* ── SIDEBAR ── */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--surface);
            border-right: 1px solid var(--border);
            z-index: 100;
            display: flex;
            flex-direction: column;
            transform: translateX(-100%);
            transition: transform .3s cubic-bezier(.4,0,.2,1);
            overflow: hidden;
        }
        .sidebar.open { transform: translateX(0); }

        .sidebar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 20px;
            border-bottom: 1px solid var(--border);
            flex-shrink: 0;
        }
        .sidebar-logo {
            font-size: 17px;
            font-weight: 600;
            text-decoration: none;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .sidebar-logo em {
            color: var(--accent);
            font-style: normal;
        }
        .sidebar-close {
            width: 30px; height: 30px;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            color: var(--muted);
            display: flex; align-items: center; justify-content: center;
            transition: color .15s, background .15s;
        }
        .sidebar-close:hover { background: var(--border); color: var(--text); }

        /* User info di sidebar */
        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px 20px;
            border-bottom: 1px solid var(--border);
            flex-shrink: 0;
        }
        .sidebar-avatar {
            width: 40px; height: 40px;
            border-radius: 50%;
            background: var(--accent);
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }
        .sidebar-user-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--text);
        }
        .sidebar-user-role {
            font-size: 11px;
            color: var(--muted);
            margin-top: 1px;
        }

        /* Nav links */
        .sidebar-nav {
            flex: 1;
            padding: 12px 10px;
            overflow-y: auto;
        }
        .sidebar-section-label {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: var(--muted);
            padding: 8px 10px 6px;
            margin-top: 4px;
        }
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            color: var(--muted);
            text-decoration: none;
            transition: background .15s, color .15s;
            margin-bottom: 2px;
        }
        .sidebar-link:hover {
            background: var(--card);
            color: var(--text);
        }
        .sidebar-link.active {
            background: rgba(200,241,53,.1);
            color: var(--accent);
            border: 1px solid rgba(200,241,53,.12);
        }
        .sidebar-link .link-icon {
            width: 32px; height: 32px;
            border-radius: 7px;
            background: var(--card);
            display: flex; align-items: center; justify-content: center;
            font-size: 15px;
            flex-shrink: 0;
            transition: background .15s;
        }
        .sidebar-link.active .link-icon {
            background: rgba(200,241,53,.15);
        }

        /* Logout di bawah */
        .sidebar-footer {
            padding: 12px 10px;
            border-top: 1px solid var(--border);
            flex-shrink: 0;
        }

        /* ── MAIN CONTENT ── */
        .main-content {
            max-width: 1100px;
            margin: 0 auto;
            padding: 36px 36px 80px;
        }

        /* ── FOOTER ── */
        footer {
            border-top: 1px solid var(--border);
            padding: 28px 36px;
            text-align: center;
            font-size: 12px;
            color: var(--muted);
        }
    </style>
    @stack('styles')
</head>
<body>

{{-- TOPBAR --}}
<nav class="topbar">
    <div class="topbar-left">
        <button class="hamburger" id="hamburger-btn" onclick="openSidebar()">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <a href="/dashboard" class="topbar-brand"><em>Stadion</em>Ku</a>
    </div>

    <div class="topbar-right">
        <div class="dropdown">
            <div class="navbar-user" id="dropdown-toggle">
                <div class="navbar-avatar">👤</div>
                <span>{{ auth()->user()->name }}</span>
                <span style="font-size:10px;opacity:.5">▼</span>
            </div>
            <div class="dropdown-menu" id="dropdown-menu">
                <a href="/profil" class="dropdown-item">👤 Profil Saya</a>
                <a href="/riwayat" class="dropdown-item">🎫 Riwayat Tiket</a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item danger"
                        style="width:100%;text-align:left;border:none;background:none;cursor:pointer;font-family:var(--font)">
                        🚪 Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

{{-- OVERLAY --}}
<div class="sidebar-overlay" id="sidebar-overlay" onclick="closeSidebar()"></div>

{{-- SIDEBAR --}}
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <a href="/dashboard" class="sidebar-logo">⚽ <em>Stadion</em>Ku</a>
        <button class="sidebar-close" onclick="closeSidebar()">✕</button>
    </div>

    <div class="sidebar-user">
        <div class="sidebar-avatar">👤</div>
        <div>
            <div class="sidebar-user-name">{{ auth()->user()->name }}</div>
            <div class="sidebar-user-role">Penonton</div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="sidebar-section-label">Menu</div>

        <a href="/dashboard" class="sidebar-link {{ request()->is('dashboard') ? 'active' : '' }}">
            <span class="link-icon">🏠</span>
            Beranda
        </a>
        <a href="/pertandingan" class="sidebar-link {{ request()->is('pertandingan*') ? 'active' : '' }}">
            <span class="link-icon">⚽</span>
            Pertandingan
        </a>
        <a href="/riwayat" class="sidebar-link {{ request()->is('riwayat*') ? 'active' : '' }}">
            <span class="link-icon">🎫</span>
            Tiket Saya
        </a>

        <div class="sidebar-section-label" style="margin-top:8px">Akun</div>

        <a href="/profil" class="sidebar-link {{ request()->is('profil*') ? 'active' : '' }}">
            <span class="link-icon">👤</span>
            Profil Saya
        </a>
    </nav>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="sidebar-link danger"
                style="width:100%;text-align:left;border:none;background:none;cursor:pointer;font-family:var(--font);color:#f87171">
                <span class="link-icon" style="background:rgba(248,113,113,.1)">🚪</span>
                Keluar
            </button>
        </form>
    </div>
</aside>

{{-- CONTENT --}}
<div class="main-content">
    @yield('content')
</div>

{{-- FOOTER --}}
<footer>
    © {{ date('Y') }} StadionKu. All rights reserved.
</footer>

<script>
    // ── SIDEBAR ──
    function openSidebar() {
        document.getElementById('sidebar').classList.add('open');
        document.getElementById('sidebar-overlay').classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('sidebar-overlay').classList.remove('show');
        document.body.style.overflow = '';
    }

    // Tutup sidebar dengan Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeSidebar();
    });

    // ── DROPDOWN USER ──
    document.getElementById('dropdown-toggle').addEventListener('click', function(e) {
        e.stopPropagation();
        document.getElementById('dropdown-menu').classList.toggle('show');
    });

    document.addEventListener('click', function() {
        document.getElementById('dropdown-menu').classList.remove('show');
    });

    document.getElementById('dropdown-menu').addEventListener('click', function(e) {
        e.stopPropagation();
    });
</script>

@stack('scripts')   {{-- ← tambah di sini --}}
</body>
</html>