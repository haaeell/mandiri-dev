<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - Mandiri Dev</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest" defer></script><script src="/js/admin.js" defer></script>
</head>
<body class="grid min-h-screen place-items-center bg-gradient-to-br from-blue-50 to-slate-50 text-slate-900 antialiased">
    <main class="w-[min(420px,calc(100%_-_32px))] rounded-[22px] border border-slate-200 bg-white p-7 shadow-2xl shadow-slate-900/10">
        <img class="rounded-2xl" src="/mandiridevpng.png" alt="Mandiri Dev" width="62" height="62">
        <p class="mb-0 mt-4 text-[11px] font-black tracking-widest text-blue-600">MANDIRI DEV</p><h1 class="mb-1 mt-1 text-2xl font-extrabold">Masuk ke Admin Panel</h1><span class="text-[13px] text-slate-500">Kelola konten landing page dari satu tempat.</span>
        <form class="mt-6 grid gap-3" action="{{ route('admin.login.store') }}" method="POST">@csrf
            <label class="grid gap-1.5 text-xs font-black text-slate-700">Email<input class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100" type="email" name="email" value="{{ old('email') }}" required autofocus></label>
            <label class="grid gap-1.5 text-xs font-black text-slate-700">Password<input class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100" type="password" name="password" required></label>
            <label class="flex items-center gap-2 text-xs font-black text-slate-700"><input class="size-4" type="checkbox" name="remember"> Ingat saya</label>
            @error('email')<div class="rounded-lg bg-red-100 p-2.5 text-xs font-extrabold text-red-800">{{ $message }}</div>@enderror
            <button class="inline-flex items-center justify-center gap-2 rounded-xl border-0 bg-blue-600 px-4 py-3 text-[13px] font-black text-white hover:bg-blue-700" type="submit"><i class="size-4" data-lucide="log-in"></i> Masuk</button>
        </form>
    </main>
</body>
</html>
