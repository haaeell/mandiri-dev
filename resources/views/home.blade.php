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
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,700&family=Caveat:wght@600&family=IBM+Plex+Mono:wght@500;600&family=Instrument+Serif:ital@0;1&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
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
    <div class="fixed inset-x-0 top-0 z-20 h-[3px] origin-left scale-x-0 bg-blue-600" id="scrollProgress"></div>

    @include('partials.public-navbar')

    <main id="home">
        <section class="hero-showcase relative isolate overflow-hidden px-0 py-14 md:min-h-[calc(100svh-78px)] md:py-10">
            @include('partials.admin-edit', ['section' => 'hero'])
            <div class="hero-showcase__glow absolute inset-0 -z-20"></div>
            <svg class="hero-wave hero-wave--left" viewBox="0 0 700 1050" fill="none" aria-hidden="true">
                @foreach (range(0, 9) as $line)
                    <path d="M -40 {{ 40 + ($line * 27) }} C 15 430, 90 690, 390 740 C 510 760, 585 810, 700 900" />
                @endforeach
            </svg>
            <svg class="hero-wave hero-wave--right" viewBox="0 0 700 1050" fill="none" aria-hidden="true">
                @foreach (range(0, 9) as $line)
                    <path d="M -40 {{ 40 + ($line * 27) }} C 15 430, 90 690, 390 740 C 510 760, 585 810, 700 900" />
                @endforeach
            </svg>
            <div class="hero-orb hero-orb--top" aria-hidden="true"></div>
            <div class="hero-orb hero-orb--bottom" aria-hidden="true"></div>
            <div class="hero-tile hero-tile--left" aria-hidden="true"></div>
            <div class="hero-tile hero-tile--right" aria-hidden="true"></div>
            <div class="hero-dots hero-dots--left" aria-hidden="true"></div>
            <div class="hero-dots hero-dots--right" aria-hidden="true"></div>

            <div class="reveal relative z-10 mx-auto flex w-[min(1180px,calc(100%_-_32px))] translate-y-4 flex-col items-center text-center opacity-0 transition duration-700 md:w-[min(1180px,calc(100%_-_40px))]">
                <p class="hero-eyebrow font-code"><span class="size-2.5 rounded-full bg-blue-600 shadow-[0_0_12px_rgba(37,99,235,.55)]"></span>{{ str_replace('|', '  •  ', $content['hero']['eyebrow']) }}</p>
                <h1 class="hero-title">{{ $content['hero']['title'] }} <span>{{ $content['hero']['highlight'] }}</span></h1>
                <p class="hero-description">{{ $content['hero']['description'] }}</p>
                <div class="mt-7 flex w-full flex-col justify-center gap-4 sm:w-auto sm:flex-row">
                    <a class="magnetic group inline-flex min-h-14 items-center justify-center gap-3 rounded-xl bg-gradient-to-br from-blue-500 to-blue-700 px-8 text-base font-semibold text-white shadow-[0_14px_28px_rgba(37,99,235,.28)] transition hover:-translate-y-0.5 hover:brightness-105" href="{{ $whatsappUrl }}" target="_blank"
                        rel="noopener noreferrer"><i class="size-5 transition group-hover:rotate-12" data-lucide="message-circle"></i>Konsultasi Project</a>
                    <a class="group inline-flex min-h-14 items-center justify-center gap-3 rounded-xl border border-slate-200/80 bg-white/80 px-8 text-base font-semibold text-slate-900 shadow-[0_12px_30px_rgba(15,23,42,.07)] backdrop-blur transition hover:-translate-y-0.5 hover:border-blue-200 hover:bg-white dark:border-white/10 dark:bg-slate-900/80 dark:text-slate-50" href="#showcase"><i class="size-5 transition group-hover:translate-x-1 group-hover:-translate-y-1" data-lucide="arrow-up-right"></i>Lihat Showcase</a>
                </div>
                <div class="hero-stats mt-12 grid w-full max-w-[1060px] grid-cols-1 divide-y divide-slate-200/80 sm:grid-cols-3 sm:divide-x sm:divide-y-0 dark:divide-white/10">
                    @foreach ($content['hero']['stats'] as $stat)
                        <div class="flex items-center justify-center gap-5 px-6 py-6 text-left">
                            <span class="grid size-[74px] shrink-0 place-items-center rounded-full bg-slate-50/90 text-blue-600 dark:bg-white/5"><i class="size-8" data-lucide="{{ ['folder', 'badge-check', 'headphones'][$loop->index] }}"></i></span>
                            <span>
                                <strong class="block text-[28px] font-bold leading-none text-blue-600">{{ $stat['value'] }}</strong>
                                <span class="mt-3 block text-sm font-medium text-slate-500 dark:text-slate-300">{{ $stat['label'] }}</span>
                            </span>
                        </div>
                        @if ($loop->iteration === 3) @break @endif
                    @endforeach
                </div>
            </div>
        </section>

        <section class="home-section home-section--about relative px-0 py-12 md:py-20" id="tentang">
            <div class="mx-auto grid w-[min(1180px,calc(100%_-_32px))] gap-8 md:w-[min(1180px,calc(100%_-_40px))] lg:grid-cols-[.9fr_1.1fr] lg:items-center">
                <div class="reveal">
                    <p class="font-handwritten m-0 text-2xl font-semibold text-blue-600">Tentang Kami</p>
                    <h2 class="font-display my-3 text-3xl font-bold leading-tight tracking-tight md:text-5xl">Kami bukan sekadar bikin tampilan, tapi membangun alat kerja digital.</h2>
                    <p class="text-slate-500 dark:text-slate-300">Mandiri Dev fokus membantu pemilik bisnis, sekolah, dan organisasi mengubah proses manual menjadi sistem web yang mudah dipakai, terukur, dan siap dikembangkan.</p>
                </div>
                <div class="grid gap-3 sm:grid-cols-2">
                    <div class="reveal rounded-2xl border border-slate-200 bg-white p-5 dark:border-white/10 dark:bg-slate-900"><i class="mb-4 size-5 text-blue-600" data-lucide="layout-dashboard"></i><h3 class="m-0 font-black">Sistem yang berguna</h3><p class="mb-0 mt-2 text-sm text-slate-500 dark:text-slate-300">Setiap fitur dibuat untuk menyelesaikan pekerjaan nyata, bukan cuma terlihat ramai.</p></div>
                    <div class="reveal rounded-2xl border border-slate-200 bg-white p-5 dark:border-white/10 dark:bg-slate-900"><i class="mb-4 size-5 text-blue-600" data-lucide="shield-check"></i><h3 class="m-0 font-black">Struktur rapi</h3><p class="mb-0 mt-2 text-sm text-slate-500 dark:text-slate-300">Kode, database, halaman, dan konten disusun agar mudah dirawat.</p></div>
                    <div class="reveal rounded-2xl border border-slate-200 bg-white p-5 dark:border-white/10 dark:bg-slate-900"><i class="mb-4 size-5 text-blue-600" data-lucide="rocket"></i><h3 class="m-0 font-black">Siap online</h3><p class="mb-0 mt-2 text-sm text-slate-500 dark:text-slate-300">Deploy, domain, SSL, sitemap, dan testing disiapkan sampai bisa digunakan.</p></div>
                    <div class="reveal rounded-2xl border border-slate-200 bg-white p-5 dark:border-white/10 dark:bg-slate-900"><i class="mb-4 size-5 text-blue-600" data-lucide="messages-square"></i><h3 class="m-0 font-black">Komunikasi jelas</h3><p class="mb-0 mt-2 text-sm text-slate-500 dark:text-slate-300">Progress, revisi, dan prioritas dibicarakan dengan bahasa yang mudah dipahami.</p></div>
                </div>
            </div>
        </section>

        <section class="home-section home-section--services relative px-0 py-12 md:py-20" id="layanan">
            @include('partials.admin-edit', ['section' => 'services'])
            <div class="mx-auto w-[min(1180px,calc(100%_-_32px))] md:w-[min(1180px,calc(100%_-_40px))]">
                <div class="reveal mx-auto mb-10 max-w-3xl text-center">
                    <p class="font-handwritten m-0 text-2xl font-semibold text-blue-600">Layanan</p>
                    <h2 class="font-display my-2 text-3xl font-bold leading-tight tracking-tight md:text-5xl">{{ $content['services']['heading'] }}</h2><span class="text-slate-500 dark:text-slate-300">{{ $content['services']['description'] }}</span>
                </div>
                <div class="grid gap-4 md:grid-cols-3">
                    @foreach ($content['services']['items'] as $service)
                        <article class="reveal rounded-2xl border border-slate-200 bg-white p-5 transition hover:border-blue-200 dark:border-white/10 dark:bg-slate-900">
                            <div class="grid size-11 place-items-center rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-600/15"><i class="size-5"
                                    data-lucide="{{ $serviceIcons[$loop->index % count($serviceIcons)] }}"></i></div>
                            <h3 class="mt-4 text-xl font-extrabold">{{ $service['title'] }}</h3>
                            <p class="mb-0 text-sm text-slate-500 dark:text-slate-300">{{ $service['description'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="home-section home-section--showcase relative px-0 py-12 md:py-20" id="showcase">
            @include('partials.admin-edit', ['section' => 'showcases'])
            <div class="mx-auto w-[min(1180px,calc(100%_-_32px))] md:w-[min(1180px,calc(100%_-_40px))]">
                <div class="reveal mb-8 flex flex-col gap-5 md:mb-10 md:flex-row md:items-end md:justify-between">
                    <div class="max-w-3xl">
                        <p class="font-handwritten m-0 text-2xl font-semibold text-blue-600">Showcase Project</p>
                        <h2 class="font-display my-2 text-3xl font-bold leading-tight tracking-tight md:text-5xl">{{ $content['showcases']['heading'] }}</h2>
                        <span class="text-slate-500 dark:text-slate-300">Beberapa project pilihan. Untuk daftar lengkap, buka halaman portofolio.</span>
                    </div>
                    <a class="inline-flex items-center justify-center gap-2 rounded-full bg-blue-600 px-5 py-3 text-sm font-black text-white shadow-lg shadow-blue-600/20 transition hover:-translate-y-0.5 hover:bg-blue-700" href="{{ route('projects.index') }}">Lihat Semua Portofolio <i class="size-4" data-lucide="arrow-up-right"></i></a>
                </div>
                <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    @foreach (array_slice($content['showcases']['items'], 0, 6) as $showcase)
                        <article class="reveal group overflow-hidden rounded-2xl border border-slate-200 bg-white transition hover:border-blue-200 dark:border-white/10 dark:bg-slate-900">
                            <div class="relative flex min-h-[230px] flex-col justify-end overflow-hidden bg-slate-900 p-5 text-white">
                                @if ($showcase['thumbnail'])
                                    <img class="absolute inset-0 h-full w-full object-cover" src="{{ str_starts_with($showcase['thumbnail'], 'http') ? $showcase['thumbnail'] : asset('storage/' . $showcase['thumbnail']) }}" alt="{{ $showcase['title'] }}">
                                    <div class="absolute inset-0 bg-gradient-to-b from-slate-900/15 to-slate-900/60"></div>
                                @endif
                                <small class="font-code relative rounded-full bg-white/15 px-3 py-1 text-[10px] font-semibold uppercase tracking-wider backdrop-blur">{{ $showcase['category'] }}</small>
                                <h3 class="font-display relative my-2 text-2xl font-semibold">{{ $showcase['title'] }}</h3>
                            </div>
                            <div class="p-5">
                                <p class="mb-0 text-sm text-slate-500 dark:text-slate-300">{{ $showcase['description'] }}</p>
                                <div class="mt-4 flex flex-wrap gap-2">
                                    @foreach (array_filter(array_map('trim', explode(',', $showcase['tags']))) as $tag)<span class="font-code rounded-full bg-blue-50 px-2.5 py-1 text-[10px] font-medium text-blue-700 dark:bg-blue-600/15 dark:text-blue-200">{{ $tag }}</span>@endforeach
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

        <section class="home-section home-section--process relative px-0 py-12 md:py-20" id="proses">
            @include('partials.admin-edit', ['section' => 'processes'])
            <div class="mx-auto w-[min(1180px,calc(100%_-_32px))] md:w-[min(1180px,calc(100%_-_40px))]">
                <div class="reveal mx-auto mb-10 max-w-3xl text-center">
                    <p class="font-handwritten m-0 text-2xl font-semibold text-blue-600">Proses Kerja</p>
                    <h2 class="font-display my-2 text-3xl font-bold leading-tight tracking-tight md:text-5xl">{{ $content['processes']['heading'] }}</h2>
                </div>
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($content['processes']['items'] as $process)
                        <article class="reveal relative rounded-2xl border border-slate-200 bg-white p-5 dark:border-white/10 dark:bg-slate-900">
                            <div class="grid size-11 place-items-center rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-600/15"><i class="size-5"
                                    data-lucide="{{ $processIcons[$loop->index % count($processIcons)] }}"></i></div>
                            <b class="font-code absolute right-5 top-4 text-2xl text-blue-200">{{ $process['number'] }}</b>
                            <h3 class="mt-3 text-xl font-extrabold">{{ $process['title'] }}</h3>
                            <p class="mb-0 text-sm text-slate-500 dark:text-slate-300">{{ $process['description'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="home-section home-section--testimonials relative px-0 py-12 md:py-20" id="testimoni">
            <div class="mx-auto w-[min(1180px,calc(100%_-_32px))] md:w-[min(1180px,calc(100%_-_40px))]">
                <div class="reveal mx-auto mb-10 max-w-3xl text-center">
                    <p class="font-handwritten m-0 text-2xl font-semibold text-blue-600">Testimoni</p>
                    <h2 class="font-display my-2 text-3xl font-bold leading-tight tracking-tight md:text-5xl">Dipakai untuk kebutuhan yang benar-benar operasional.</h2>
                    <span class="text-slate-500 dark:text-slate-300">Project yang baik bukan cuma selesai, tapi membantu tim bekerja lebih mudah.</span>
                </div>
                <div class="grid gap-4 md:grid-cols-3">
                    <article class="reveal rounded-2xl border border-slate-200 bg-white p-5 dark:border-white/10 dark:bg-slate-900">
                        <div class="mb-4 flex text-yellow-400"><i class="size-4" data-lucide="star"></i><i class="size-4" data-lucide="star"></i><i class="size-4" data-lucide="star"></i><i class="size-4" data-lucide="star"></i><i class="size-4" data-lucide="star"></i></div>
                        <p class="font-editorial text-lg leading-7 text-slate-600 dark:text-slate-300">“Dashboard jadi lebih enak dipakai. Data yang sebelumnya tersebar sekarang bisa dipantau dari satu tempat.”</p>
                        <div class="mt-5 flex items-center gap-3"><div class="grid size-11 place-items-center rounded-full bg-blue-100 font-black text-blue-700">R</div><div><b>Raka Pratama</b><small class="block text-xs text-slate-500">Owner UMKM</small></div></div>
                    </article>
                    <article class="reveal rounded-2xl border border-slate-200 bg-white p-5 dark:border-white/10 dark:bg-slate-900">
                        <div class="mb-4 flex text-yellow-400"><i class="size-4" data-lucide="star"></i><i class="size-4" data-lucide="star"></i><i class="size-4" data-lucide="star"></i><i class="size-4" data-lucide="star"></i><i class="size-4" data-lucide="star"></i></div>
                        <p class="font-editorial text-lg leading-7 text-slate-600 dark:text-slate-300">“Alur sistem sekolahnya jelas. Admin, guru, dan operator tidak bingung saat mulai menggunakan.”</p>
                        <div class="mt-5 flex items-center gap-3"><div class="grid size-11 place-items-center rounded-full bg-blue-100 font-black text-blue-700">A</div><div><b>Ayu Lestari</b><small class="block text-xs text-slate-500">Staf Akademik</small></div></div>
                    </article>
                    <article class="reveal rounded-2xl border border-slate-200 bg-white p-5 dark:border-white/10 dark:bg-slate-900">
                        <div class="mb-4 flex text-yellow-400"><i class="size-4" data-lucide="star"></i><i class="size-4" data-lucide="star"></i><i class="size-4" data-lucide="star"></i><i class="size-4" data-lucide="star"></i><i class="size-4" data-lucide="star"></i></div>
                        <p class="font-editorial text-lg leading-7 text-slate-600 dark:text-slate-300">“Yang paling membantu adalah scope dan komunikasinya. Fitur yang penting dikerjakan dulu, jadi cepat bisa dipakai.”</p>
                        <div class="mt-5 flex items-center gap-3"><div class="grid size-11 place-items-center rounded-full bg-blue-100 font-black text-blue-700">D</div><div><b>Dimas Ananda</b><small class="block text-xs text-slate-500">Project Lead</small></div></div>
                    </article>
                </div>
            </div>
        </section>

        <section class="home-section home-section--faq relative px-0 py-12 md:py-20" id="faq">
            @include('partials.admin-edit', ['section' => 'faqs'])
            <div class="mx-auto w-[min(850px,calc(100%_-_32px))] md:w-[min(850px,calc(100%_-_40px))]">
                <div class="reveal mx-auto mb-10 max-w-3xl text-center">
                    <p class="font-handwritten m-0 text-2xl font-semibold text-blue-600">FAQ</p>
                    <h2 class="font-display my-2 text-3xl font-bold leading-tight tracking-tight md:text-5xl">{{ $content['faqs']['heading'] }}</h2>
                </div>
                <div class="grid gap-3">
                    @foreach ($content['faqs']['items'] as $faq)
                        <details class="reveal group rounded-2xl border border-slate-200 bg-white px-5 py-4 transition hover:border-blue-200 dark:border-white/10 dark:bg-slate-900" @if ($loop->first) open @endif>
                            <summary class="flex cursor-pointer items-center justify-between gap-3 font-extrabold"><span class="inline-flex items-center gap-2"><i class="size-4 text-blue-600" data-lucide="circle-help"></i>{{ $faq['question'] }}</span><i
                                    data-lucide="plus" class="size-4 text-blue-600 transition group-open:rotate-45"></i></summary>
                            <p class="mb-0 text-sm text-slate-500 dark:text-slate-300">{{ $faq['answer'] }}</p>
                        </details>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="home-section home-section--articles relative px-0 py-12 text-white md:py-20" id="artikel">
            <div class="mx-auto w-[min(1180px,calc(100%_-_32px))] md:w-[min(1180px,calc(100%_-_40px))]">
                <div class="reveal mb-10 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
                    <div>
                        <p class="font-handwritten m-0 text-2xl font-semibold text-blue-300">Artikel SEO</p>
                        <h2 class="font-display my-2 max-w-2xl text-3xl font-bold leading-tight tracking-tight md:text-5xl">Insight development yang ikut bantu ranking.</h2>
                        <span class="text-slate-300">Artikel publish dari admin otomatis masuk sitemap dan siap dibaca mesin pencari.</span>
                    </div>
                    <a class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-3 text-sm font-black text-slate-950" href="{{ route('articles.index') }}">Semua Artikel <i class="size-4" data-lucide="arrow-up-right"></i></a>
                </div>
                <div class="grid gap-4 md:grid-cols-3">
                    @forelse ($articles as $article)
                        <article class="reveal group rounded-2xl border border-white/10 bg-white/[.05] p-5 transition hover:bg-white/[.08]">
                            <a class="mb-4 block overflow-hidden rounded-2xl bg-slate-900" href="{{ route('articles.show', $article) }}">
                                @if ($article->image)
                                    <img class="h-40 w-full object-cover transition duration-500 group-hover:scale-105" src="{{ str_starts_with($article->image, 'http') ? $article->image : asset('storage/'.$article->image) }}" alt="{{ $article->title }}">
                                @else
                                    <div class="grid h-40 place-items-center bg-blue-600 text-sm font-black">Mandiri Dev Insight</div>
                                @endif
                            </a>
                            <div class="mb-4 flex items-center justify-between gap-3">
                                <span class="font-code rounded-full bg-blue-500/15 px-3 py-1 text-[10px] font-semibold text-blue-200">{{ $article->category }}</span>
                                <span class="font-code text-[10px] font-medium text-slate-400">{{ $article->published_at?->format('d M Y') }}</span>
                            </div>
                            <h3 class="font-display text-xl font-bold leading-tight">{{ $article->title }}</h3>
                            <p class="text-sm leading-7 text-slate-300">{{ $article->excerpt }}</p>
                            <a class="mt-4 inline-flex items-center gap-2 text-xs font-black text-blue-300" href="{{ route('articles.show', $article) }}">Baca Artikel <i class="size-4 transition group-hover:translate-x-1" data-lucide="arrow-right"></i></a>
                        </article>
                    @empty
                        <div class="rounded-2xl border border-white/10 p-5 text-slate-300 md:col-span-3">Artikel akan tampil setelah dibuat dari admin.</div>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="home-section home-section--cta relative px-0 py-12 md:py-20">
            @include('partials.admin-edit', ['section' => 'cta'])
            <div class="reveal mx-auto w-[min(1180px,calc(100%_-_32px))] rounded-2xl bg-blue-600 p-8 text-center text-white md:w-[min(1180px,calc(100%_-_40px))] md:p-12">
                <p class="font-handwritten m-0 inline-flex items-center gap-2 text-2xl font-semibold text-blue-100"><i class="size-4" data-lucide="sparkles"></i>{{ $content['cta']['eyebrow'] }}</p>
                <h2 class="font-display mx-auto my-6 max-w-3xl text-3xl font-bold leading-tight md:text-5xl">{{ $content['cta']['heading'] }}</h2>
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
        <a class="-mt-8 flex flex-col items-center gap-1 rounded-[1.7rem] bg-blue-600 px-3 py-3 text-white shadow-xl shadow-blue-600/30 ring-4 ring-white transition active:scale-95 dark:ring-slate-900" href="#showcase"><span class="grid size-10 place-items-center rounded-2xl bg-white/15"><i class="size-5" data-lucide="panels-top-left"></i></span><span>Project</span></a>
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
