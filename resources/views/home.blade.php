<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $seo['title'] }}</title>
    <meta name="description" content="{{ $seo['description'] }}">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <meta name="author" content="Mandiri Dev">
    <meta name="theme-color" content="#2563eb">
    <link rel="canonical" href="{{ $seo['canonical'] }}">
    <link rel="icon" href="/mandiridevpng.png" type="image/png">
    <link rel="apple-touch-icon" href="/mandiridevpng.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <meta property="og:site_name" content="Mandiri Dev">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="id_ID">
    <meta property="og:title" content="{{ $seo['title'] }}">
    <meta property="og:description" content="{{ $seo['description'] }}">
    <meta property="og:url" content="{{ $seo['canonical'] }}">
    <meta property="og:image" content="{{ $seo['image'] }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seo['title'] }}">
    <meta name="twitter:description" content="{{ $seo['description'] }}">
    <meta name="twitter:image" content="{{ $seo['image'] }}">

    <script type="application/ld+json">
        {!! json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'Organization',
            '@id' => $seo['canonical'] . '#organization',
            'name' => 'Mandiri Dev',
            'url' => $seo['canonical'],
            'logo' => $seo['image'],
            'description' => $seo['description'],
        ],
        [
            '@type' => 'ProfessionalService',
            '@id' => $seo['canonical'] . '#service',
            'name' => 'Mandiri Dev Software House',
            'url' => $seo['canonical'],
            'areaServed' => 'Indonesia',
            'serviceType' => array_column($content['services']['items'], 'title'),
        ],
        [
            '@type' => 'FAQPage',
            '@id' => $seo['canonical'] . '#faq',
            'mainEntity' => array_map(fn($faq) => [
                '@type' => 'Question',
                'name' => $faq[0],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq[1]],
            ], array_map(fn($faq) => [$faq['question'], $faq['answer']], $content['faqs']['items'])),
        ],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
</head>

<body class="bg-white pb-24 text-slate-900 antialiased transition-colors duration-300 dark:bg-slate-950 dark:text-slate-50 md:pb-0">
    @php
        $statIcons = ['briefcase-business', 'smartphone', 'headphones', 'layers-3'];
        $serviceIcons = ['globe-2', 'blocks', 'graduation-cap', 'bot', 'chart-no-axes-combined', 'settings'];
        $processIcons = ['messages-square', 'map', 'code-xml', 'rocket'];
    @endphp
    <div class="fixed inset-x-0 top-0 z-20 h-[3px] origin-left scale-x-0 bg-gradient-to-r from-blue-600 to-cyan-500 shadow-[0_0_18px_rgba(6,182,212,.6)]" id="scrollProgress"></div>
    <div class="pointer-events-none fixed left-0 top-0 -z-10 hidden h-[360px] w-[360px] rounded-full bg-[radial-gradient(circle,rgba(37,99,235,.14),transparent_68%)] transition-transform duration-150 md:block" id="pointerGlow"></div>
    <div class="fixed -left-24 -top-24 -z-10 h-80 w-80 rounded-full bg-blue-400/30 blur-3xl"></div>
    <div class="fixed -right-32 top-64 -z-10 h-96 w-96 rounded-full bg-cyan-300/30 blur-3xl"></div>

    <header class="sticky top-0 z-10 border-b border-slate-200/80 bg-white/85 shadow-sm backdrop-blur-xl dark:border-white/10 dark:bg-slate-950/85">
        <div class="mx-auto flex min-h-16 w-[min(1180px,calc(100%_-_32px))] items-center justify-between gap-3 md:min-h-[78px] md:w-[min(1180px,calc(100%_-_40px))] md:gap-5">
            <a class="flex items-center gap-2.5" href="#home" aria-label="Mandiri Dev Home">
                <img class="size-11 rounded-2xl md:size-12" src="/mandiridevpng.png" alt="Mandiri Dev" width="48" height="48">
                <span class="grid"><strong class="text-sm md:text-base">Mandiri Dev</strong><small class="hidden text-[11px] text-slate-500 dark:text-slate-300 sm:block">Digital Innovation</small></span>
            </a>
            <nav class="desktop-nav hidden gap-2 text-sm font-bold md:flex" aria-label="Navigasi utama">
                <a class="inline-flex items-center gap-2 rounded-full px-3 py-2 transition hover:bg-blue-50 hover:text-blue-600 dark:hover:bg-white/10" href="#home"><i class="size-4" data-lucide="home"></i>Home</a><a class="inline-flex items-center gap-2 rounded-full px-3 py-2 transition hover:bg-blue-50 hover:text-blue-600 dark:hover:bg-white/10" href="#tentang"><i class="size-4" data-lucide="users"></i>Tentang</a><a class="inline-flex items-center gap-2 rounded-full px-3 py-2 transition hover:bg-blue-50 hover:text-blue-600 dark:hover:bg-white/10" href="#layanan"><i class="size-4" data-lucide="layout-grid"></i>Layanan</a><a class="inline-flex items-center gap-2 rounded-full px-3 py-2 transition hover:bg-blue-50 hover:text-blue-600 dark:hover:bg-white/10" href="#showcase"><i class="size-4"
                        data-lucide="panels-top-left"></i>Showcase</a><a class="inline-flex items-center gap-2 rounded-full px-3 py-2 transition hover:bg-blue-50 hover:text-blue-600 dark:hover:bg-white/10" href="#testimoni"><i class="size-4"
                        data-lucide="message-square-quote"></i>Testimoni</a><a class="inline-flex items-center gap-2 rounded-full px-3 py-2 transition hover:bg-blue-50 hover:text-blue-600 dark:hover:bg-white/10" href="#artikel"><i class="size-4" data-lucide="newspaper"></i>Artikel</a>
            </nav>
            <div class="flex items-center gap-2.5">
                <button class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-3 py-2.5 text-xs font-extrabold text-slate-900 dark:border-white/10 dark:bg-slate-900 dark:text-slate-50" id="themeButton" type="button" aria-label="Ubah tema"><i class="size-4"
                        data-lucide="moon"></i><span class="hidden sm:inline">Dark</span></button>
                <a class="magnetic hidden items-center justify-center gap-2 rounded-2xl bg-blue-600 px-4 py-2.5 text-sm font-extrabold text-white shadow-lg shadow-blue-600/20 transition hover:-translate-y-0.5 hover:bg-blue-700 md:inline-flex" href="{{ $whatsappUrl }}" target="_blank"
                    rel="noopener noreferrer"><i class="size-4" data-lucide="message-circle"></i>Konsultasi</a>
                <button class="hidden items-center gap-2 rounded-2xl border border-slate-200 bg-white px-3 py-2.5 text-xs font-extrabold text-slate-900 dark:border-white/10 dark:bg-slate-900 dark:text-slate-50" id="menuButton" type="button" aria-label="Buka menu"><i class="size-4"
                        data-lucide="menu"></i><span>Menu</span></button>
            </div>
        </div>
        <nav class="mx-auto hidden w-[min(1180px,calc(100%_-_40px))] gap-2 pb-4 md:hidden" id="mobileMenu" aria-label="Navigasi seluler">
            <a class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-3 py-2 text-sm font-extrabold dark:bg-slate-900" href="#layanan"><i class="size-4" data-lucide="layout-grid"></i>Layanan</a><a class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-3 py-2 text-sm font-extrabold dark:bg-slate-900" href="#showcase"><i class="size-4"
                    data-lucide="panels-top-left"></i>Showcase</a><a class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-3 py-2 text-sm font-extrabold dark:bg-slate-900" href="#proses"><i class="size-4"
                    data-lucide="route"></i>Proses</a><a class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-3 py-2 text-sm font-extrabold dark:bg-slate-900" href="#faq"><i class="size-4" data-lucide="circle-help"></i>FAQ</a>
        </nav>
    </header>

    <main id="home">
        <section class="relative overflow-hidden px-0 py-14 pt-10 md:py-20 md:pt-20">
            @include('partials.admin-edit', ['section' => 'hero'])
            <div class="absolute inset-x-0 top-0 -z-10 h-full bg-[linear-gradient(180deg,rgba(239,246,255,.9),transparent_62%)] dark:bg-[linear-gradient(180deg,rgba(15,23,42,.95),rgba(2,6,23,.6)_62%)]"></div>
            <div class="mx-auto grid w-[min(1180px,calc(100%_-_32px))] items-center gap-8 md:w-[min(1180px,calc(100%_-_40px))] md:gap-12 lg:grid-cols-[1fr_430px]">
                <div class="reveal translate-y-4 opacity-0 transition duration-700">
                    <p class="mb-5 inline-flex items-center gap-2 rounded-full border border-blue-100 bg-white px-3.5 py-2 text-[13px] font-extrabold text-blue-700 shadow-lg shadow-slate-900/5 dark:border-white/10 dark:bg-white/5 dark:text-blue-200"><i class="size-4" data-lucide="sparkles"></i>Partner build website, sistem, dan SEO teknis</p>
                    <h1 class="m-0 max-w-[760px] text-4xl font-black leading-[1.05] tracking-tight sm:text-[46px] md:text-6xl">{{ $content['hero']['title'] }} <span class="text-blue-600">{{ $content['hero']['highlight'] }}</span></h1>
                    <p class="my-6 max-w-[680px] text-[17px] leading-8 text-slate-500 dark:text-slate-300">{{ $content['hero']['description'] }}</p>
                    <div class="flex flex-col gap-3 sm:flex-row">
                        <a class="magnetic group inline-flex items-center justify-center gap-2 rounded-2xl bg-slate-950 px-5 py-3.5 text-sm font-extrabold text-white shadow-xl shadow-slate-900/20 transition hover:-translate-y-0.5 hover:bg-blue-600 dark:bg-blue-600" href="{{ $whatsappUrl }}" target="_blank"
                            rel="noopener noreferrer"><i class="size-4 transition group-hover:rotate-12" data-lucide="message-circle"></i>Konsultasi Project</a>
                        <a class="group inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-5 py-3.5 text-sm font-extrabold text-slate-900 transition hover:-translate-y-0.5 hover:border-blue-200 hover:bg-blue-50 dark:border-white/10 dark:bg-slate-900 dark:text-slate-50" href="#showcase"><i class="size-4 transition group-hover:translate-x-1" data-lucide="arrow-down-right"></i>Lihat
                            Showcase</a>
                    </div>
                    <div class="mt-8 grid gap-3 sm:grid-cols-3">
                        <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm dark:border-white/10 dark:bg-slate-900"><i class="mb-3 size-5 text-blue-600" data-lucide="clipboard-check"></i><b>Scope jelas</b><p class="mb-0 mt-1 text-sm text-slate-500 dark:text-slate-300">Fitur, halaman, dan prioritas disusun sebelum development.</p></div>
                        <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm dark:border-white/10 dark:bg-slate-900"><i class="mb-3 size-5 text-blue-600" data-lucide="smartphone"></i><b>Mobile siap</b><p class="mb-0 mt-1 text-sm text-slate-500 dark:text-slate-300">Tampilan ringan, responsive, dan nyaman digunakan harian.</p></div>
                        <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm dark:border-white/10 dark:bg-slate-900"><i class="mb-3 size-5 text-blue-600" data-lucide="search-check"></i><b>SEO dasar</b><p class="mb-0 mt-1 text-sm text-slate-500 dark:text-slate-300">Struktur teknis, sitemap, metadata, dan konten dibuat rapi.</p></div>
                    </div>
                </div>
                <div class="reveal rounded-[2rem] border border-slate-200 bg-white p-5 shadow-2xl shadow-slate-900/10 dark:border-white/10 dark:bg-slate-900">
                    <div class="rounded-3xl bg-slate-950 p-5 text-white">
                        <p class="m-0 text-xs font-black uppercase tracking-widest text-cyan-300">Alur Kerja</p>
                        <h2 class="mt-2 text-2xl font-black">Dari ide ke sistem siap pakai.</h2>
                    </div>
                    <div class="mt-4 grid gap-3">
                        <div class="flex gap-3 rounded-2xl bg-slate-50 p-4 dark:bg-slate-950"><span class="grid size-9 shrink-0 place-items-center rounded-full bg-blue-600 text-sm font-black text-white">1</span><div><b>Audit kebutuhan</b><p class="mb-0 mt-1 text-sm text-slate-500 dark:text-slate-300">Kita petakan masalah, alur pengguna, dan target hasil.</p></div></div>
                        <div class="flex gap-3 rounded-2xl bg-slate-50 p-4 dark:bg-slate-950"><span class="grid size-9 shrink-0 place-items-center rounded-full bg-blue-600 text-sm font-black text-white">2</span><div><b>Build bertahap</b><p class="mb-0 mt-1 text-sm text-slate-500 dark:text-slate-300">UI, database, fitur, dan admin panel dibuat sesuai prioritas.</p></div></div>
                        <div class="flex gap-3 rounded-2xl bg-slate-50 p-4 dark:bg-slate-950"><span class="grid size-9 shrink-0 place-items-center rounded-full bg-blue-600 text-sm font-black text-white">3</span><div><b>Rilis & optimasi</b><p class="mb-0 mt-1 text-sm text-slate-500 dark:text-slate-300">Deploy, testing, SEO teknis, dan maintenance awal disiapkan.</p></div></div>
                    </div>
                    <div class="mt-4 grid grid-cols-3 gap-2 text-center">
                        @foreach ($content['hero']['stats'] as $stat)
                            <div class="rounded-2xl border border-slate-200 p-3 dark:border-white/10">
                                <strong class="block text-lg text-blue-600">{{ $stat['value'] }}</strong>
                                <span class="text-[11px] font-bold text-slate-500 dark:text-slate-300">{{ $stat['label'] }}</span>
                            </div>
                            @if ($loop->iteration === 3) @break @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="relative px-0 py-12 md:py-20" id="tentang">
            <div class="mx-auto grid w-[min(1180px,calc(100%_-_32px))] gap-8 md:w-[min(1180px,calc(100%_-_40px))] lg:grid-cols-[.9fr_1.1fr] lg:items-center">
                <div class="reveal">
                    <p class="m-0 font-black text-blue-600">Tentang Kami</p>
                    <h2 class="my-3 text-3xl font-black leading-tight tracking-tight md:text-5xl">Kami bukan sekadar bikin tampilan, tapi membangun alat kerja digital.</h2>
                    <p class="text-slate-500 dark:text-slate-300">Mandiri Dev fokus membantu pemilik bisnis, sekolah, dan organisasi mengubah proses manual menjadi sistem web yang mudah dipakai, terukur, dan siap dikembangkan.</p>
                </div>
                <div class="grid gap-3 sm:grid-cols-2">
                    <div class="reveal rounded-3xl border border-slate-200 bg-white p-5 shadow-sm dark:border-white/10 dark:bg-slate-900"><i class="mb-4 size-6 text-blue-600" data-lucide="layout-dashboard"></i><h3 class="m-0 font-black">Sistem yang berguna</h3><p class="mb-0 mt-2 text-sm text-slate-500 dark:text-slate-300">Setiap fitur dibuat untuk menyelesaikan pekerjaan nyata, bukan cuma terlihat ramai.</p></div>
                    <div class="reveal rounded-3xl border border-slate-200 bg-white p-5 shadow-sm dark:border-white/10 dark:bg-slate-900"><i class="mb-4 size-6 text-blue-600" data-lucide="shield-check"></i><h3 class="m-0 font-black">Struktur rapi</h3><p class="mb-0 mt-2 text-sm text-slate-500 dark:text-slate-300">Kode, database, halaman, dan konten disusun agar mudah dirawat.</p></div>
                    <div class="reveal rounded-3xl border border-slate-200 bg-white p-5 shadow-sm dark:border-white/10 dark:bg-slate-900"><i class="mb-4 size-6 text-blue-600" data-lucide="rocket"></i><h3 class="m-0 font-black">Siap online</h3><p class="mb-0 mt-2 text-sm text-slate-500 dark:text-slate-300">Deploy, domain, SSL, sitemap, dan testing disiapkan sampai bisa digunakan.</p></div>
                    <div class="reveal rounded-3xl border border-slate-200 bg-white p-5 shadow-sm dark:border-white/10 dark:bg-slate-900"><i class="mb-4 size-6 text-blue-600" data-lucide="messages-square"></i><h3 class="m-0 font-black">Komunikasi jelas</h3><p class="mb-0 mt-2 text-sm text-slate-500 dark:text-slate-300">Progress, revisi, dan prioritas dibicarakan dengan bahasa yang mudah dipahami.</p></div>
                </div>
            </div>
        </section>

        <section class="relative bg-slate-50/80 px-0 py-12 md:py-20 dark:bg-white/[.03]" id="layanan">
            @include('partials.admin-edit', ['section' => 'services'])
            <div class="mx-auto w-[min(1180px,calc(100%_-_32px))] md:w-[min(1180px,calc(100%_-_40px))]">
                <div class="reveal mx-auto mb-10 max-w-3xl text-center">
                    <p class="m-0 font-black text-blue-600">Layanan</p>
                    <h2 class="my-2 text-3xl font-black leading-tight tracking-tight md:text-5xl">{{ $content['services']['heading'] }}</h2><span class="text-slate-500 dark:text-slate-300">{{ $content['services']['description'] }}</span>
                </div>
                <div class="grid gap-4 md:grid-cols-3">
                    @foreach ($content['services']['items'] as $service)
                        <article class="reveal tilt-card relative overflow-hidden rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1.5 hover:shadow-2xl hover:shadow-slate-900/10 dark:border-white/10 dark:bg-slate-900">
                            <div class="grid size-12 place-items-center rounded-2xl bg-gradient-to-br from-blue-50 to-cyan-50 text-blue-600 ring-1 ring-blue-100 dark:bg-blue-600/15 dark:ring-blue-300/20"><i class="size-6"
                                    data-lucide="{{ $serviceIcons[$loop->index % count($serviceIcons)] }}"></i></div>
                            <b class="mt-4 block text-blue-600">{{ $service['code'] }}</b>
                            <h3 class="mt-2 text-xl font-extrabold">{{ $service['title'] }}</h3>
                            <p class="mb-0 text-sm text-slate-500 dark:text-slate-300">{{ $service['description'] }}</p><span class="absolute right-5 top-6 text-blue-300"><i class="size-5"
                                    data-lucide="arrow-up-right"></i></span>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="relative px-0 py-12 md:py-20" id="showcase">
            @include('partials.admin-edit', ['section' => 'showcases'])
            <div class="mx-auto w-[min(1180px,calc(100%_-_32px))] md:w-[min(1180px,calc(100%_-_40px))]">
                <div class="reveal mb-8 flex flex-col gap-5 md:mb-10 md:flex-row md:items-end md:justify-between">
                    <div class="max-w-3xl">
                        <p class="m-0 font-black text-blue-600">Showcase Project</p>
                        <h2 class="my-2 text-3xl font-black leading-tight tracking-tight md:text-5xl">{{ $content['showcases']['heading'] }}</h2>
                        <span class="text-slate-500 dark:text-slate-300">Beberapa project pilihan. Untuk daftar lengkap, buka halaman portofolio.</span>
                    </div>
                    <a class="inline-flex items-center justify-center gap-2 rounded-full bg-blue-600 px-5 py-3 text-sm font-black text-white shadow-lg shadow-blue-600/20 transition hover:-translate-y-0.5 hover:bg-blue-700" href="{{ route('projects.index') }}">Lihat Semua Portofolio <i class="size-4" data-lucide="arrow-up-right"></i></a>
                </div>
                <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    @foreach (array_slice($content['showcases']['items'], 0, 6) as $showcase)
                        <article class="reveal tilt-card group relative overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-2 hover:border-blue-200 hover:shadow-2xl hover:shadow-blue-600/10 dark:border-white/10 dark:bg-slate-900">
                            <div class="absolute inset-x-6 -top-10 h-24 rounded-full bg-blue-500/20 blur-3xl transition group-hover:bg-cyan-400/30"></div>
                            <div class="relative flex min-h-[230px] flex-col justify-end overflow-hidden p-5 text-white {{ !$showcase['thumbnail'] ? 'bg-[radial-gradient(circle_at_20%_20%,rgba(255,255,255,.26),transparent_28%),linear-gradient(135deg,#0f172a,#2563eb,#06b6d4)]' : '' }}">
                                @if ($showcase['thumbnail'])
                                    <img class="absolute inset-0 h-full w-full object-cover" src="{{ str_starts_with($showcase['thumbnail'], 'http') ? $showcase['thumbnail'] : asset('storage/' . $showcase['thumbnail']) }}" alt="{{ $showcase['title'] }}">
                                    <div class="absolute inset-0 bg-gradient-to-b from-slate-900/15 to-slate-900/60"></div>
                                @endif
                                <div class="absolute right-4 top-4 grid size-11 place-items-center rounded-2xl border border-white/20 bg-white/15 backdrop-blur transition group-hover:rotate-6 group-hover:scale-110"><i class="size-5" data-lucide="code-2"></i></div>
                                <small class="relative rounded-full bg-white/15 px-3 py-1 text-[11px] font-black uppercase tracking-wider backdrop-blur">{{ $showcase['category'] }}</small>
                                <h3 class="relative my-2 text-2xl font-extrabold">{{ $showcase['title'] }}</h3>
                            </div>
                            <div class="p-5">
                                <p class="mb-0 text-sm text-slate-500 dark:text-slate-300">{{ $showcase['description'] }}</p>
                                <div class="mt-4 flex flex-wrap gap-2">
                                    @foreach (array_filter(array_map('trim', explode(',', $showcase['tags']))) as $tag)<span class="rounded-full bg-blue-50 px-2.5 py-1 text-[11px] font-extrabold text-blue-700 dark:bg-blue-600/15 dark:text-blue-200">{{ $tag }}</span>@endforeach
                                </div>
                                <div class="mt-5 flex flex-wrap gap-3"><a class="group/btn inline-flex items-center gap-2 rounded-full bg-slate-950 px-4 py-2.5 text-xs font-black text-white transition hover:bg-blue-600 dark:bg-blue-600" href="{{ route('projects.show', $showcase['slug']) }}">Lihat Detail<i class="size-4 transition group-hover/btn:translate-x-1"
                                            data-lucide="arrow-right"></i></a>@if ($showcase['website_url'])<a
                                                class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-4 py-2.5 text-xs font-black text-slate-600 transition hover:bg-blue-50 hover:text-blue-700 dark:bg-white/10 dark:text-slate-200" href="{{ $showcase['website_url'] }}" target="_blank"
                                            rel="noopener noreferrer"><i class="size-4" data-lucide="external-link"></i>Lihat Website</a>@endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="relative bg-slate-50/80 px-0 py-12 md:py-20 dark:bg-white/[.03]" id="proses">
            @include('partials.admin-edit', ['section' => 'processes'])
            <div class="mx-auto w-[min(1180px,calc(100%_-_32px))] md:w-[min(1180px,calc(100%_-_40px))]">
                <div class="reveal mx-auto mb-10 max-w-3xl text-center">
                    <p class="m-0 font-black text-blue-600">Proses Kerja</p>
                    <h2 class="my-2 text-3xl font-black leading-tight tracking-tight md:text-5xl">{{ $content['processes']['heading'] }}</h2>
                </div>
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($content['processes']['items'] as $process)
                        <article class="reveal tilt-card relative rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition dark:border-white/10 dark:bg-slate-900">
                            <div class="grid size-12 place-items-center rounded-2xl bg-gradient-to-br from-blue-50 to-cyan-50 text-blue-600 ring-1 ring-blue-100 dark:bg-blue-600/15 dark:ring-blue-300/20"><i class="size-6"
                                    data-lucide="{{ $processIcons[$loop->index % count($processIcons)] }}"></i></div>
                            <b class="absolute right-5 top-4 text-3xl text-blue-200">{{ $process['number'] }}</b>
                            <h3 class="mt-3 text-xl font-extrabold">{{ $process['title'] }}</h3>
                            <p class="mb-0 text-sm text-slate-500 dark:text-slate-300">{{ $process['description'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="relative px-0 py-12 md:py-20" id="testimoni">
            <div class="mx-auto w-[min(1180px,calc(100%_-_32px))] md:w-[min(1180px,calc(100%_-_40px))]">
                <div class="reveal mx-auto mb-10 max-w-3xl text-center">
                    <p class="m-0 font-black text-blue-600">Testimoni</p>
                    <h2 class="my-2 text-3xl font-black leading-tight tracking-tight md:text-5xl">Dipakai untuk kebutuhan yang benar-benar operasional.</h2>
                    <span class="text-slate-500 dark:text-slate-300">Project yang baik bukan cuma selesai, tapi membantu tim bekerja lebih mudah.</span>
                </div>
                <div class="grid gap-4 md:grid-cols-3">
                    <article class="reveal rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-white/10 dark:bg-slate-900">
                        <div class="mb-4 flex text-yellow-400"><i class="size-4" data-lucide="star"></i><i class="size-4" data-lucide="star"></i><i class="size-4" data-lucide="star"></i><i class="size-4" data-lucide="star"></i><i class="size-4" data-lucide="star"></i></div>
                        <p class="text-sm leading-7 text-slate-600 dark:text-slate-300">"Dashboard jadi lebih enak dipakai. Data yang sebelumnya tersebar sekarang bisa dipantau dari satu tempat."</p>
                        <div class="mt-5 flex items-center gap-3"><div class="grid size-11 place-items-center rounded-full bg-blue-100 font-black text-blue-700">R</div><div><b>Raka Pratama</b><small class="block text-xs text-slate-500">Owner UMKM</small></div></div>
                    </article>
                    <article class="reveal rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-white/10 dark:bg-slate-900">
                        <div class="mb-4 flex text-yellow-400"><i class="size-4" data-lucide="star"></i><i class="size-4" data-lucide="star"></i><i class="size-4" data-lucide="star"></i><i class="size-4" data-lucide="star"></i><i class="size-4" data-lucide="star"></i></div>
                        <p class="text-sm leading-7 text-slate-600 dark:text-slate-300">"Alur sistem sekolahnya jelas. Admin, guru, dan operator tidak bingung saat mulai menggunakan."</p>
                        <div class="mt-5 flex items-center gap-3"><div class="grid size-11 place-items-center rounded-full bg-blue-100 font-black text-blue-700">A</div><div><b>Ayu Lestari</b><small class="block text-xs text-slate-500">Staf Akademik</small></div></div>
                    </article>
                    <article class="reveal rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-white/10 dark:bg-slate-900">
                        <div class="mb-4 flex text-yellow-400"><i class="size-4" data-lucide="star"></i><i class="size-4" data-lucide="star"></i><i class="size-4" data-lucide="star"></i><i class="size-4" data-lucide="star"></i><i class="size-4" data-lucide="star"></i></div>
                        <p class="text-sm leading-7 text-slate-600 dark:text-slate-300">"Yang paling membantu adalah scope dan komunikasinya. Fitur yang penting dikerjakan dulu, jadi cepat bisa dipakai."</p>
                        <div class="mt-5 flex items-center gap-3"><div class="grid size-11 place-items-center rounded-full bg-blue-100 font-black text-blue-700">D</div><div><b>Dimas Ananda</b><small class="block text-xs text-slate-500">Project Lead</small></div></div>
                    </article>
                </div>
            </div>
        </section>

        <section class="relative px-0 py-12 md:py-20" id="faq">
            @include('partials.admin-edit', ['section' => 'faqs'])
            <div class="mx-auto w-[min(850px,calc(100%_-_32px))] md:w-[min(850px,calc(100%_-_40px))]">
                <div class="reveal mx-auto mb-10 max-w-3xl text-center">
                    <p class="m-0 font-black text-blue-600">FAQ</p>
                    <h2 class="my-2 text-3xl font-black leading-tight tracking-tight md:text-5xl">{{ $content['faqs']['heading'] }}</h2>
                </div>
                <div class="grid gap-3">
                    @foreach ($content['faqs']['items'] as $faq)
                        <details class="reveal group rounded-2xl border border-slate-200 bg-white px-5 py-4 shadow-sm transition hover:border-blue-200 hover:shadow-lg hover:shadow-blue-600/10 dark:border-white/10 dark:bg-slate-900" @if ($loop->first) open @endif>
                            <summary class="flex cursor-pointer items-center justify-between gap-3 font-extrabold"><span class="inline-flex items-center gap-2"><i class="size-4 text-blue-600" data-lucide="circle-help"></i>{{ $faq['question'] }}</span><i
                                    data-lucide="plus" class="size-4 text-blue-600 transition group-open:rotate-45"></i></summary>
                            <p class="mb-0 text-sm text-slate-500 dark:text-slate-300">{{ $faq['answer'] }}</p>
                        </details>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="relative bg-slate-950 px-0 py-12 text-white md:py-20" id="artikel">
            <div class="mx-auto w-[min(1180px,calc(100%_-_32px))] md:w-[min(1180px,calc(100%_-_40px))]">
                <div class="reveal mb-10 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
                    <div>
                        <p class="m-0 font-black text-cyan-300">Artikel SEO</p>
                        <h2 class="my-2 max-w-2xl text-3xl font-black leading-tight tracking-tight md:text-5xl">Insight development yang ikut bantu ranking.</h2>
                        <span class="text-slate-300">Artikel publish dari admin otomatis masuk sitemap dan siap dibaca mesin pencari.</span>
                    </div>
                    <a class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-3 text-sm font-black text-slate-950" href="{{ route('articles.index') }}">Semua Artikel <i class="size-4" data-lucide="arrow-up-right"></i></a>
                </div>
                <div class="grid gap-4 md:grid-cols-3">
                    @forelse ($articles as $article)
                        <article class="reveal group rounded-3xl border border-white/10 bg-white/[.05] p-5 transition hover:-translate-y-1.5 hover:bg-white/[.08]">
                            <a class="mb-4 block overflow-hidden rounded-2xl bg-slate-900" href="{{ route('articles.show', $article) }}">
                                @if ($article->image)
                                    <img class="h-40 w-full object-cover transition duration-500 group-hover:scale-105" src="{{ str_starts_with($article->image, 'http') ? $article->image : asset('storage/'.$article->image) }}" alt="{{ $article->title }}">
                                @else
                                    <div class="grid h-40 place-items-center bg-gradient-to-br from-blue-600 to-cyan-400 text-sm font-black">Mandiri Dev Insight</div>
                                @endif
                            </a>
                            <div class="mb-4 flex items-center justify-between gap-3">
                                <span class="rounded-full bg-blue-500/15 px-3 py-1 text-[11px] font-black text-blue-200">{{ $article->category }}</span>
                                <span class="text-[11px] font-bold text-slate-400">{{ $article->published_at?->format('d M Y') }}</span>
                            </div>
                            <h3 class="text-xl font-black leading-tight">{{ $article->title }}</h3>
                            <p class="text-sm leading-7 text-slate-300">{{ $article->excerpt }}</p>
                            <a class="mt-4 inline-flex items-center gap-2 text-xs font-black text-cyan-300" href="{{ route('articles.show', $article) }}">Baca Artikel <i class="size-4 transition group-hover:translate-x-1" data-lucide="arrow-right"></i></a>
                        </article>
                    @empty
                        <div class="rounded-3xl border border-white/10 p-6 text-slate-300 md:col-span-3">Artikel akan tampil setelah dibuat dari admin.</div>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="relative px-0 py-12 md:py-20">
            @include('partials.admin-edit', ['section' => 'cta'])
            <div class="reveal mx-auto w-[min(1180px,calc(100%_-_32px))] overflow-hidden rounded-3xl bg-gradient-to-r from-blue-700 via-blue-600 to-cyan-500 p-8 text-center text-white shadow-2xl shadow-slate-900/10 md:w-[min(1180px,calc(100%_-_40px))] md:p-12">
                <p class="m-0 inline-flex items-center gap-2 font-extrabold text-blue-100"><i class="size-4" data-lucide="sparkles"></i>{{ $content['cta']['eyebrow'] }}</p>
                <h2 class="mx-auto my-6 max-w-3xl text-3xl font-black leading-tight md:text-5xl">{{ $content['cta']['heading'] }}</h2>
                <a class="magnetic inline-flex items-center justify-center gap-2 rounded-2xl bg-white px-5 py-3.5 text-sm font-extrabold text-blue-700 shadow-lg transition hover:-translate-y-0.5 hover:bg-blue-50" href="{{ $whatsappUrl }}" target="_blank"
                    rel="noopener noreferrer"><i class="size-4" data-lucide="send"></i>{{ $content['cta']['button'] }}</a>
            </div>
        </section>
    </main>

    <footer class="border-t border-slate-200 py-8 text-sm text-slate-500 dark:border-white/10 dark:text-slate-300">
        <div class="mx-auto flex w-[min(1180px,calc(100%_-_40px))] flex-col items-center justify-between gap-3 text-center md:flex-row md:text-left"><span>&copy; {{ date('Y') }} Mandiri Dev. Digital Innovation &
                Development.</span><span>Website | Web App | Dashboard | AI Integration | SEO</span></div>
    </footer>
    <nav class="fixed inset-x-3 bottom-3 z-30 grid grid-cols-5 items-end rounded-[2rem] border border-slate-200/80 bg-white/95 p-2 text-[10px] font-extrabold text-slate-500 shadow-2xl shadow-slate-900/20 backdrop-blur-xl dark:border-white/10 dark:bg-slate-900/95 dark:text-slate-300 md:hidden" data-bottom-nav aria-label="Navigasi bawah">
        <a class="flex flex-col items-center gap-1 rounded-2xl px-2 py-2 text-blue-600 transition active:scale-95" href="#home"><i class="size-5" data-lucide="home"></i><span>Home</span></a>
        <a class="flex flex-col items-center gap-1 rounded-2xl px-2 py-2 transition active:scale-95" href="#tentang"><i class="size-5" data-lucide="users"></i><span>Tentang</span></a>
        <a class="-mt-8 flex flex-col items-center gap-1 rounded-[1.7rem] bg-gradient-to-br from-blue-600 to-cyan-400 px-3 py-3 text-white shadow-xl shadow-blue-600/30 ring-4 ring-white transition active:scale-95 dark:ring-slate-900" href="#showcase"><span class="grid size-10 place-items-center rounded-2xl bg-white/15"><i class="size-5" data-lucide="panels-top-left"></i></span><span>Project</span></a>
        <a class="flex flex-col items-center gap-1 rounded-2xl px-2 py-2 transition active:scale-95" href="#artikel"><i class="size-5" data-lucide="newspaper"></i><span>Artikel</span></a>
        <a class="flex flex-col items-center gap-1 rounded-2xl bg-green-500 px-2 py-2 text-white shadow-lg shadow-green-500/20 transition active:scale-95" href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer"><i class="size-5" data-lucide="message-circle"></i><span>Chat</span></a>
    </nav>
    <a class="fixed bottom-5 right-5 hidden size-14 place-items-center rounded-full bg-green-500 text-white shadow-2xl shadow-slate-900/15 md:grid" href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer"
        aria-label="Chat WhatsApp Mandiri Dev"><i class="size-5" data-lucide="message-circle"></i></a>
    <button class="fixed bottom-24 left-5 hidden size-12 place-items-center rounded-full border-0 bg-blue-600 text-white shadow-2xl shadow-slate-900/15 md:bottom-5 md:size-14" id="topButton" type="button" aria-label="Kembali ke atas"><i
            class="size-5" data-lucide="arrow-up"></i></button>
    <script src="/js/site.js" defer></script>
    <script src="https://unpkg.com/lucide@latest" defer></script>
</body>

</html>
