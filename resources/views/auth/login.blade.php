<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — StadionKu</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            height: 100vh;
            overflow: hidden;
            display: flex;
            background: #0a0a0a;
        }

        /* ── KIRI: Foto Pemain ── */
        .left-panel {
            width: 38%;
            position: relative;
            overflow: hidden;
            flex-shrink: 0;
        }
        .left-panel img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center 60%;
            filter: brightness(0.25) grayscale(100%);
        }
        .left-panel-top {
            position: absolute;
            top: 32px;
            left: 32px;
        }
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 1.5px solid #c8f135;
            color: #c8f135;
            padding: 8px 20px;
            border-radius: 100px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: all .15s;
        }
        .back-btn:hover {
            background: #c8f135;
            color: #0a0a0a;
        }
        .tagline {
            position: absolute;
            top: 20%;
            left: 150px;
            right: 32px;
            font-size: 17px;
            color: #a8a8a8;
            font-style: bold;
            font-family: 'Crimson Text';
            font-weight: 300;
            line-height: 1.6;
            filter: brightness(0.5);
        }

        /* ── KANAN: Foto Stadion + Form ── */
        .right-panel {
            width: 62%;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 60px;
        }
        .right-panel .bg-img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center 70%;
            filter: brightness(0.30)  grayscale(100%);
            z-index: 0;
        }

        /* ── FORM CARD ── */
        .form-card {
            position: relative;
            z-index: 1;
            background: #c8f135;
            border-radius: 24px;
            padding: 36px 40px;
            width: 100%;
            max-width: 400px;
            margin-left: -40px;
        }
        .form-card-tab {
            display: block;
            background: #0a0a0a;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            padding: 8px 28px;
            border-radius: 100px;
            margin-bottom: 22px;
            text-align: center;
            width: fit-content;
            margin-left: auto;
            margin-right: auto;
        }
        .form-card h2 {
            font-size: 22px;
            font-weight: 700;
            color: #0a0a0a;
            margin-bottom: 5px;
            line-height: 1.3;
        }
        .form-card .subtitle {
            font-size: 13px;
            color: #3a3a3a;
            margin-bottom: 24px;
        }

        /* ── FORM ELEMENTS ── */
        .form-group {
            margin-bottom: 14px;
        }
        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 5px;
            letter-spacing: .3px;
        }
        .input-wrap {
            position: relative;
        }
        .input-wrap .input-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 14px;
            opacity: 0.45;
        }
        .form-group input {
            width: 100%;
            padding: 11px 13px 11px 38px;
            border-radius: 10px;
            border: none;
            background: rgba(0,0,0,0.1);
            font-size: 14px;
            font-family: 'DM Sans', sans-serif;
            color: #1a1a1a;
            outline: none;
            transition: background .15s;
        }
        .form-group input:focus {
            background: rgba(0,0,0,0.16);
        }
        .form-group input::placeholder { color: #777; }

        .input-error {
            font-size: 11px;
            color: #c0392b;
            margin-top: 4px;
            font-weight: 500;
        }

        .toggle-pw {
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            font-size: 15px;
            opacity: 0.45;
            padding: 0;
            line-height: 1;
            transition: opacity .15s;
        
        }
        .toggle-pw:hover { opacity: 0.8; }

        /* ── SUBMIT ── */
        .btn-submit {
            width: 100%;
            padding: 13px;
            border-radius: 10px;
            background: #0a0a0a;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            transition: background .15s;
            margin-top: 6px;
        }
        .btn-submit:hover { background: #222; }

        /* ── DIVIDER ── */
        .divider {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 16px 0;
            font-size: 12px;
            color: #555;
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(0,0,0,0.18);
        }

        /* ── BOTTOM ── */
        .bottom-links {
            text-align: center;
            font-size: 12px;
            color: #333;
            line-height: 2;
        }
        .bottom-links a {
            color: #1a1a1a;
            font-weight: 600;
            text-decoration: none;
        }
        .bottom-links a:hover { text-decoration: underline; }

        .alert-error {
            background: rgba(192,57,43,0.12);
            border: 1px solid rgba(192,57,43,0.3);
            color: #c0392b;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 12px;
            margin-bottom: 14px;
        }
    </style>
</head>
<body>

<!-- Foto Pemain -->
<div class="left-panel">
    <img src="{{ asset('images/bg-pemain.png') }}" alt="Pemain">
    </div>
    <div class="tagline">
        Les grandes équipes! The champions!
    </div>
</div>

<!-- Foto Stadion + Form -->
<div class="right-panel">
    <img class="bg-img" src="{{ asset('images/bg-stadion.png') }}" alt="Stadion">

    <div class="form-card">
        <div class="form-card-tab">Masuk</div>
        <h2>Selamat datang kembali !</h2>
        <p class="subtitle">Masuk ke akun StadionKu kamu.</p>

        @if (session('status'))
            <div class="alert-error">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email Address</label>
                <div class="input-wrap">
                    <span class="input-icon">✉</span>
                    <input id="email" type="email" name="email"
                        value="{{ old('email') }}"
                        placeholder="email@domain.com"
                        required autofocus autocomplete="username">
                </div>
                @error('email')
                    <div class="input-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrap">
                    <span class="input-icon">🔒</span>
                    <input id="password" type="password" name="password"
                        placeholder="••••••••"
                        required autocomplete="current-password">
                        <style="padding-right: 38px">
                    <button type="button" class="toggle-pw" onclick="togglePassword()" id="toggle-btn">
                    👁
                    </button>
                </div>
                @error('password')
                    <div class="input-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-submit">
                Masuk ke StadionKu
            </button>
        </form>

        <div class="divider">atau</div>

        <div class="bottom-links">
            Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a><br>
        </div>
    </div>
</div>


<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const btn = document.getElementById('toggle-btn');
        if (input.type === 'password') {
            input.type = 'text';
            btn.textContent = '🙈';
        } else {
            input.type = 'password';
            btn.textContent = '👁';
        }
    }
</script>

</body>
</html>