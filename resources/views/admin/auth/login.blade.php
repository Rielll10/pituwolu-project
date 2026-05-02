<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — Pituwolu Coffee</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #1a1109;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(193,125,46,.25) 0%, transparent 70%);
            top: -100px; right: -100px;
            border-radius: 50%;
        }
        body::after {
            content: '';
            position: absolute;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(193,125,46,.15) 0%, transparent 70%);
            bottom: -50px; left: -50px;
            border-radius: 50%;
        }

        .login-card {
            background: white;
            border-radius: 24px;
            padding: 48px;
            width: 100%;
            max-width: 420px;
            position: relative;
            z-index: 10;
            box-shadow: 0 24px 80px rgba(0,0,0,.4);
        }

        .login-logo {
            text-align: center;
            margin-bottom: 32px;
        }
        .login-logo h1 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 28px;
            font-weight: 800;
            color: #1a1109;
        }
        .login-logo p {
            font-size: 13px;
            color: #9c8c7a;
            margin-top: 4px;
        }
        .login-logo .coffee-icon {
            font-size: 48px;
            display: block;
            margin-bottom: 8px;
        }

        .form-group { margin-bottom: 18px; }
        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #1a1109;
            margin-bottom: 7px;
        }
        .form-control {
            width: 100%;
            padding: 13px 16px;
            border: 1.5px solid #e8e0d5;
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            color: #1a1109;
            outline: none;
            transition: border-color .2s;
        }
        .form-control:focus { border-color: #c17d2e; }

        .alert-error {
            background: #fee2e2;
            color: #c53030;
            padding: 12px 14px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 18px;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: #c17d2e;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            transition: background .2s, transform .1s;
            margin-top: 6px;
        }
        .btn-login:hover { background: #a3671f; transform: translateY(-1px); }
        .btn-login:active { transform: translateY(0); }

        .back-link {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: #9c8c7a;
        }
        .back-link a { color: #c17d2e; text-decoration: none; font-weight: 600; }
        .back-link a:hover { text-decoration: underline; }

        .remember-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }
        .remember-row input { width: 16px; height: 16px; accent-color: #c17d2e; cursor: pointer; }
        .remember-row label { font-size: 13px; color: #6b5d4e; cursor: pointer; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-logo">
            <span class="coffee-icon">☕</span>
            <h1>Pituwolu Coffee</h1>
            <p>Masuk ke panel admin</p>
        </div>

        @if ($errors->any())
            <div class="alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control"
                    value="{{ old('email') }}" placeholder="admin@pituwolu.com" required autofocus>
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control"
                    placeholder="••••••••" required>
            </div>

            <div class="remember-row">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Ingat saya</label>
            </div>

            <button type="submit" class="btn-login">Masuk ke Dashboard</button>
        </form>

        <div class="back-link">
            <a href="{{ url('/') }}">← Kembali ke website</a>
        </div>
    </div>
</body>
</html>
