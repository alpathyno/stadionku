<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <title>@yield('title', 'Admin — StadionKu')</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --bg: #0c0c0c;
            --surface: #111;
            --card: #1a1a1a;
            --border: #222;
            --text: #eaeaea;
            --muted: #555;
            --accent: #c8f135;
            --font: 'DM Sans', sans-serif;
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: var(--font);
            font-size: 14px;
            min-height: 100vh;
            display: grid;
            grid-template-columns: 220px 1fr;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            background: var(--surface);
            border-right: 1px solid var(--border);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
        }
        .sidebar-brand {
            padding: 24px 20px 20px;
            border-bottom: 1px solid var(--border);
            font-size: 16px;
            font-weight: 700;
            letter-spacing: -.3px;
        }
        .sidebar-brand span { color: var(--accent); }
        .sidebar-brand small {
            display: block;
            font-size: 10px;
            color: var(--muted);
            font-weight: 400;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-top: 3px;
        }
        .sidebar-nav {
            padding: 16px 0;
            flex: 1;
        }
        .sidebar-label {
            padding: 8px 20px;
            font-size: 10px;
            color: var(--muted);
            letter-spacing: 1.5px;
            text-transform: uppercase;
            font-family: monospace;
        }
        .sidebar-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 20px;
            font-size: 13px;
            color: var(--muted);
            text-decoration: none;
            transition: all .15s;
            border-right: 2px solid transparent;
        }
        .sidebar-item:hover {
            color: var(--text);
            background: rgba(255,255,255,.03);
        }
        .sidebar-item.active {
            color: var(--text);
            background: rgba(200,241,53,.06);
            border-right-color: var(--accent);
        }
        .sidebar-icon { font-size: 16px; opacity: .7; }
        .sidebar-footer {
            padding: 16px 0;
            border-top: 1px solid var(--border);
        }

        /* ── MAIN ── */
        .admin-main {
            min-height: 100vh;
            overflow-y: auto;
        }
        .admin-content {
            padding: 32px 36px 80px;
        }
        .admin-topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
        }
        .admin-page-title {
            font-size: 22px;
            font-weight: 700;
            letter-spacing: -.5px;
            margin-bottom: 3px;
        }
        .admin-page-sub {
            font-size: 13px;
            color: var(--muted);
        }
    </style>
    @stack('styles')
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar">
    <div class="sidebar-brand">
        <span>Stadion</span>Ku
        <small>Admin Panel</small>
    </div>

    <nav class="sidebar-nav">
        <div class="sidebar-label">Utama</div>
        <a href="/admin/dashboard" class="sidebar-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <span class="sidebar-icon"></span> Dashboard
        </a>
        <a href="/admin/pertandingan" class="sidebar-item {{ request()->is('admin/pertandingan*') ? 'active' : '' }}">
            <span class="sidebar-icon"></span> Pertandingan
        </a>
        <a href="/admin/transaksi" class="sidebar-item {{ request()->is('admin/transaksi*') ? 'active' : '' }}">
            <span class="sidebar-icon"></span> Transaksi
        </a>
        <a href="/admin/laporan" class="sidebar-item {{ request()->is('admin/laporan*') ? 'active' : '' }}">
            <span class="sidebar-icon"></span> Laporan
        </a>

        <div class="sidebar-label" style="margin-top:8px">Master Data</div>
        <a href="/admin/penonton" class="sidebar-item {{ request()->is('admin/penonton*') ? 'active' : '' }}">
            <span class="sidebar-icon"></span> Penonton
        </a>
        <a href="/admin/stadion" class="sidebar-item {{ request()->is('admin/stadion*') ? 'active' : '' }}">
            <span class="sidebar-icon"></span> Stadion
        </a>
        <a href="/admin/admins" class="sidebar-item {{ request()->is('admin/users*') ? 'active' : '' }}">
            <span class="sidebar-icon"></span> Kelola Admin
        </a>
    </nav>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="sidebar-item"
                style="width:100%;border:none;background:none;cursor:pointer;font-family:var(--font);color:#f87171">
                <span class="sidebar-icon"></span> Keluar
            </button>
        </form>
    </div>
</aside>

<!-- MAIN CONTENT -->
<main class="admin-main">
    <div class="admin-content">
        @yield('content')
    </div>
</main>

@stack('scripts')
</body>
</html>