<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel') - Mandiri Dev</title>
    <link rel="stylesheet" href="/css/admin.css">
    <link rel="stylesheet" href="/css/admin-repeater.css">
    <link rel="stylesheet" href="/css/admin-thumbnail.css">
    @stack('styles')
    <script src="https://unpkg.com/lucide@latest" defer></script>
    @stack('scripts')
    <script src="/js/admin.js" defer></script>
</head>
<body>
    <aside class="sidebar">
        <a class="admin-brand" href="{{ route('admin.content.index') }}"><img src="/logo.png" alt="" width="42" height="42"><span><b>Mandiri Dev</b><small>Admin Panel</small></span></a>
        <nav>
            <p>MENU UTAMA</p>
            <a class="{{ request()->routeIs('admin.content.*') ? 'active' : '' }}" href="{{ route('admin.content.index') }}"><i data-lucide="file-pen-line"></i><span>Kelola Konten</span></a>
            <a href="{{ route('home') }}" target="_blank"><i data-lucide="external-link"></i><span>Lihat Website</span></a>
        </nav>
        <form action="{{ route('admin.logout') }}" method="POST">@csrf<button class="logout" type="submit"><i data-lucide="log-out"></i><span>Keluar</span></button></form>
    </aside>
    <main class="admin-main">
        <header class="admin-header">
            <div><h1>@yield('heading', 'Kelola Konten')</h1><p>@yield('subheading', 'Atur isi landing page dengan mudah.')</p></div>
            <div class="admin-user"><span>{{ auth()->user()->name }}</span><div>{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div></div>
        </header>
        @yield('content')
    </main>
</body>
</html>
