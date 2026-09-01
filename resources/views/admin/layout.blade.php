<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel') - Mandiri Dev</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <script src="https://unpkg.com/lucide@latest" defer></script>
    @stack('scripts')
    <script src="/js/admin.js" defer></script>
</head>
<body class="bg-slate-100 text-slate-900 antialiased">
    <aside class="fixed inset-y-0 left-0 flex w-[238px] flex-col bg-slate-950 p-5 px-3.5 text-slate-300 max-md:static max-md:w-auto">
        <a class="mb-8 flex items-center gap-2.5 px-1" href="{{ route('admin.content.index') }}"><img class="rounded-xl" src="/mandiridevpng.png" alt="" width="42" height="42"><span class="grid"><b class="text-sm text-white">Mandiri Dev</b><small class="text-[11px] text-slate-400">Admin Panel</small></span></a>
        <nav class="grid gap-1 max-md:grid-cols-2">
            <p class="mx-2 mb-2 text-[10px] font-black tracking-widest text-slate-500">MENU UTAMA</p>
            <a class="{{ request()->routeIs('admin.content.*') ? 'bg-blue-500/20 text-white' : '' }} flex items-center gap-2.5 rounded-xl px-3 py-2.5 text-[13px] font-extrabold hover:bg-blue-500/20 hover:text-white" href="{{ route('admin.content.index') }}"><i class="size-4" data-lucide="file-pen-line"></i><span>Kelola Konten</span></a>
            <a class="{{ request()->routeIs('admin.articles.*') ? 'bg-blue-500/20 text-white' : '' }} flex items-center gap-2.5 rounded-xl px-3 py-2.5 text-[13px] font-extrabold hover:bg-blue-500/20 hover:text-white" href="{{ route('admin.articles.index') }}"><i class="size-4" data-lucide="newspaper"></i><span>Artikel SEO</span></a>
            <a class="flex items-center gap-2.5 rounded-xl px-3 py-2.5 text-[13px] font-extrabold hover:bg-blue-500/20 hover:text-white" href="{{ route('home') }}" target="_blank"><i class="size-4" data-lucide="external-link"></i><span>Lihat Website</span></a>
        </nav>
        <form class="mt-auto max-md:hidden" action="{{ route('admin.logout') }}" method="POST">@csrf<button class="flex w-full items-center gap-2.5 rounded-xl px-3 py-2.5 text-[13px] font-extrabold hover:bg-red-500/15 hover:text-red-200" type="submit"><i class="size-4" data-lucide="log-out"></i><span>Keluar</span></button></form>
    </aside>
    <main class="ml-[238px] p-6 max-md:ml-0 max-md:p-4">
        <header class="mb-5 flex items-center justify-between gap-4">
            <div><h1 class="m-0 text-2xl font-extrabold">@yield('heading', 'Kelola Konten')</h1><p class="mt-1 text-[13px] text-slate-500">@yield('subheading', 'Atur isi landing page dengan mudah.')</p></div>
            <div class="flex items-center gap-2.5 text-[13px] font-extrabold text-slate-600"><span class="max-sm:hidden">{{ auth()->user()->name }}</span><div class="grid size-9 place-items-center rounded-full bg-blue-100 text-blue-700">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div></div>
        </header>
        @yield('content')
    </main>
</body>
</html>
