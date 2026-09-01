@php
    $onHome = request()->routeIs('home');
    $homeLink = $onHome ? '#home' : route('home');
    $sectionLink = fn (string $section) => ($onHome ? '' : route('home')) . '#' . $section;
    $contactLink = $whatsappUrl ?? $sectionLink('home');
@endphp

<header class="sticky top-0 z-20 border-b border-slate-200/80 bg-white/90 text-slate-900 backdrop-blur-xl dark:border-white/10 dark:bg-slate-950/90 dark:text-slate-50">
    <div class="mx-auto flex min-h-16 w-[min(1180px,calc(100%_-_32px))] items-center justify-between gap-3 md:min-h-[78px] md:w-[min(1180px,calc(100%_-_40px))] md:gap-5">
        <a class="flex shrink-0 items-center gap-2.5" href="{{ $homeLink }}" aria-label="Mandiri Dev Home">
            <img class="size-10 rounded-xl md:size-11" src="/mandiridevpng.png" alt="Mandiri Dev" width="44" height="44">
            <span class="grid"><strong class="text-sm font-bold md:text-base">Mandiri Dev</strong><small class="hidden text-[11px] text-slate-500 dark:text-slate-300 sm:block">Digital Innovation</small></span>
        </a>

        <nav class="desktop-nav hidden items-center gap-1 text-sm font-semibold md:flex" aria-label="Navigasi utama">
            <a class="rounded-xl px-3 py-2 transition hover:bg-slate-100 hover:text-blue-600 dark:hover:bg-white/10" href="{{ $homeLink }}">Home</a>
            <a class="rounded-xl px-3 py-2 transition hover:bg-slate-100 hover:text-blue-600 dark:hover:bg-white/10" href="{{ $sectionLink('tentang') }}">Tentang</a>
            <a class="rounded-xl px-3 py-2 transition hover:bg-slate-100 hover:text-blue-600 dark:hover:bg-white/10" href="{{ $sectionLink('layanan') }}">Layanan</a>
            <a class="rounded-xl px-3 py-2 transition hover:bg-slate-100 hover:text-blue-600 dark:hover:bg-white/10 {{ request()->routeIs('projects.*') ? 'bg-blue-50 text-blue-600 dark:bg-blue-500/15 dark:text-blue-200' : '' }}" href="{{ $sectionLink('showcase') }}">Showcase</a>
            <a class="rounded-xl px-3 py-2 transition hover:bg-slate-100 hover:text-blue-600 dark:hover:bg-white/10" href="{{ $sectionLink('testimoni') }}">Testimoni</a>
            <a class="rounded-xl px-3 py-2 transition hover:bg-slate-100 hover:text-blue-600 dark:hover:bg-white/10 {{ request()->routeIs('articles.*') ? 'bg-blue-50 text-blue-600 dark:bg-blue-500/15 dark:text-blue-200' : '' }}" href="{{ route('articles.index') }}">Artikel</a>
        </nav>

        <div class="flex items-center gap-2">
            <button class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-xs font-semibold text-slate-900 dark:border-white/10 dark:bg-slate-900 dark:text-slate-50" id="themeButton" type="button" aria-label="Ubah tema"><i class="size-4" data-lucide="moon"></i><span class="hidden lg:inline">Dark</span></button>
            <a class="magnetic hidden items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700 lg:inline-flex" href="{{ $contactLink }}" @if (str_starts_with($contactLink, 'http')) target="_blank" rel="noopener noreferrer" @endif><i class="size-4" data-lucide="message-circle"></i>Konsultasi</a>
            <button class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-xs font-semibold text-slate-900 dark:border-white/10 dark:bg-slate-900 dark:text-slate-50 md:hidden" id="menuButton" type="button" aria-label="Buka menu"><i class="size-4" data-lucide="menu"></i><span class="hidden sm:inline">Menu</span></button>
        </div>
    </div>

    <nav class="mx-auto hidden w-[min(1180px,calc(100%_-_32px))] grid-cols-2 gap-2 pb-4 md:hidden" id="mobileMenu" aria-label="Navigasi seluler">
        <a class="rounded-xl bg-slate-100 px-3 py-2.5 text-sm font-semibold dark:bg-slate-900" href="{{ $homeLink }}">Home</a>
        <a class="rounded-xl bg-slate-100 px-3 py-2.5 text-sm font-semibold dark:bg-slate-900" href="{{ $sectionLink('tentang') }}">Tentang</a>
        <a class="rounded-xl bg-slate-100 px-3 py-2.5 text-sm font-semibold dark:bg-slate-900" href="{{ $sectionLink('layanan') }}">Layanan</a>
        <a class="rounded-xl bg-slate-100 px-3 py-2.5 text-sm font-semibold dark:bg-slate-900" href="{{ $sectionLink('showcase') }}">Showcase</a>
        <a class="rounded-xl bg-slate-100 px-3 py-2.5 text-sm font-semibold dark:bg-slate-900" href="{{ route('articles.index') }}">Artikel</a>
        <a class="rounded-xl bg-blue-600 px-3 py-2.5 text-sm font-semibold text-white" href="{{ $contactLink }}" @if (str_starts_with($contactLink, 'http')) target="_blank" rel="noopener noreferrer" @endif>Konsultasi</a>
    </nav>
</header>
