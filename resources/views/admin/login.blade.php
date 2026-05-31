<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - Mandiri Dev</title>
    <link rel="stylesheet" href="/css/admin.css">
    <script src="https://unpkg.com/lucide@latest" defer></script><script src="/js/admin.js" defer></script>
</head>
<body class="login-page">
    <main class="login-card">
        <img src="/logo.png" alt="Mandiri Dev" width="62" height="62">
        <p class="login-label">MANDIRI DEV</p><h1>Masuk ke Admin Panel</h1><span>Kelola konten landing page dari satu tempat.</span>
        <form action="{{ route('admin.login.store') }}" method="POST">@csrf
            <label>Email<input type="email" name="email" value="{{ old('email') }}" required autofocus></label>
            <label>Password<input type="password" name="password" required></label>
            <label class="check"><input type="checkbox" name="remember"> Ingat saya</label>
            @error('email')<div class="form-error">{{ $message }}</div>@enderror
            <button class="primary-action" type="submit"><i data-lucide="log-in"></i> Masuk</button>
        </form>
    </main>
</body>
</html>
