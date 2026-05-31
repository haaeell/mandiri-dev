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
    <link rel="icon" href="/logo.png" type="image/png">
    <link rel="apple-touch-icon" href="/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/css/site.css">
    <link rel="stylesheet" href="/css/showcase.css">
    <link rel="stylesheet" href="/css/landing-wow.css">
    @if ($adminPreview)
    <link rel="stylesheet" href="/css/admin-preview.css">@endif

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

<body>
    @php
        $statIcons = ['briefcase-business', 'smartphone', 'headphones', 'layers-3'];
        $serviceIcons = ['globe-2', 'blocks', 'graduation-cap', 'bot', 'chart-no-axes-combined', 'settings'];
        $processIcons = ['messages-square', 'map', 'code-xml', 'rocket'];
    @endphp
    <div class="scroll-progress" id="scrollProgress"></div>
    <div class="pointer-glow" id="pointerGlow"></div>
    <div class="ambient ambient-one"></div>
    <div class="ambient ambient-two"></div>

    <header class="site-header">
        <div class="container nav-wrap">
            <a class="brand" href="#home" aria-label="Mandiri Dev Home">
                <img src="/logo.png" alt="Mandiri Dev" width="48" height="48">
                <span><strong>Mandiri Dev</strong><small>Digital Innovation</small></span>
            </a>
            <nav class="desktop-nav" aria-label="Navigasi utama">
                <a href="#layanan"><i data-lucide="layout-grid"></i>Layanan</a><a href="#showcase"><i
                        data-lucide="panels-top-left"></i>Showcase</a><a href="#proses"><i
                        data-lucide="route"></i>Proses</a><a href="#faq"><i data-lucide="circle-help"></i>FAQ</a>
            </nav>
            <div class="nav-actions">
                <button class="icon-button" id="themeButton" type="button" aria-label="Ubah tema"><i
                        data-lucide="moon"></i><span>Dark</span></button>
                <a class="button button-small desktop-cta magnetic" href="{{ $whatsappUrl }}" target="_blank"
                    rel="noopener noreferrer"><i data-lucide="message-circle"></i>Konsultasi</a>
                <button class="icon-button mobile-only" id="menuButton" type="button" aria-label="Buka menu"><i
                        data-lucide="menu"></i><span>Menu</span></button>
            </div>
        </div>
        <nav class="mobile-nav container" id="mobileMenu" aria-label="Navigasi seluler">
            <a href="#layanan"><i data-lucide="layout-grid"></i>Layanan</a><a href="#showcase"><i
                    data-lucide="panels-top-left"></i>Showcase</a><a href="#proses"><i
                    data-lucide="route"></i>Proses</a><a href="#faq"><i data-lucide="circle-help"></i>FAQ</a>
        </nav>
    </header>

    <main id="home">
        <section class="hero section">
            @include('partials.admin-edit', ['section' => 'hero'])
            <div class="container hero-grid">
                <div class="reveal">
                    <p class="pill"><i data-lucide="sparkles"></i>{{ $content['hero']['eyebrow'] }}</p>
                    <h1>{{ $content['hero']['title'] }} <span>{{ $content['hero']['highlight'] }}</span></h1>
                    <p class="lead">{{ $content['hero']['description'] }}</p>
                    <div class="button-row">
                        <a class="button magnetic" href="{{ $whatsappUrl }}" target="_blank"
                            rel="noopener noreferrer"><i data-lucide="message-circle"></i>Konsultasi Project</a>
                        <a class="button button-muted" href="#showcase"><i data-lucide="arrow-down-right"></i>Lihat
                            Showcase</a>
                    </div>
                    <div class="stats">
                        @foreach ($content['hero']['stats'] as $stat)
                            <div class="stat tilt-card"><i
                                    data-lucide="{{ $statIcons[$loop->index % count($statIcons)] }}"></i><strong>{{ $stat['value'] }}</strong><span>{{ $stat['label'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="dashboard reveal tilt-card">
                    <div class="dashboard-head"><small><i data-lucide="activity"></i> Mandiri Dev Dashboard</small>
                        <h2>Digital Control Center</h2>
                    </div>
                    <div class="dashboard-grid">
                        <div class="metric"><i data-lucide="gauge"></i><small>Website
                                Performance</small><strong>99%</strong></div>
                        <div class="metric"><i data-lucide="bot"></i><small>AI Automation</small><strong>AI+</strong>
                        </div>
                    </div>
                    <div class="dashboard-note">
                        <h3>Web App | Dashboard | AI | SEO</h3>
                        <p>Dibangun dengan struktur rapi, UI profesional, mobile-first, dan siap dikembangkan sesuai
                            kebutuhan bisnis.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section section-soft" id="layanan">
            @include('partials.admin-edit', ['section' => 'services'])
            <div class="container">
                <div class="section-title reveal">
                    <p>Layanan</p>
                    <h2>{{ $content['services']['heading'] }}</h2><span>{{ $content['services']['description'] }}</span>
                </div>
                <div class="card-grid">
                    @foreach ($content['services']['items'] as $service)
                        <article class="card reveal tilt-card">
                            <div class="service-icon"><i
                                    data-lucide="{{ $serviceIcons[$loop->index % count($serviceIcons)] }}"></i></div>
                            <b>{{ $service['code'] }}</b>
                            <h3>{{ $service['title'] }}</h3>
                            <p>{{ $service['description'] }}</p><span class="card-arrow"><i
                                    data-lucide="arrow-up-right"></i></span>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="section" id="showcase">
            @include('partials.admin-edit', ['section' => 'showcases'])
            <div class="container">
                <div class="section-title reveal">
                    <p>Showcase Project</p>
                    <h2>{{ $content['showcases']['heading'] }}</h2>
                </div>
                <div class="showcase-grid">
                    @foreach ($content['showcases']['items'] as $showcase)
                        <article class="showcase reveal tilt-card">
                            <div class="showcase-cover cover-{{ $loop->iteration }}" @if ($showcase['thumbnail'])
                                style="background-image:linear-gradient(rgba(15,23,42,.14),rgba(15,23,42,.58)),url('{{ str_starts_with($showcase['thumbnail'], 'http') ? $showcase['thumbnail'] : asset('storage/' . $showcase['thumbnail']) }}')"
                            @endif><small>{{ $showcase['category'] }}</small>
                                <h3>{{ $showcase['title'] }}</h3>
                            </div>
                            <div class="showcase-body">
                                <p>{{ $showcase['description'] }}</p>
                                <div class="tags">
                                    @foreach (array_filter(array_map('trim', explode(',', $showcase['tags']))) as $tag)<span>{{ $tag }}</span>@endforeach
                                </div>
                                <div class="project-actions"><a href="{{ route('projects.show', $showcase['slug']) }}"><i
                                            data-lucide="arrow-right"></i>Lihat Detail</a>@if ($showcase['website_url'])<a
                                                class="project-link-muted" href="{{ $showcase['website_url'] }}" target="_blank"
                                            rel="noopener noreferrer"><i data-lucide="external-link"></i>Lihat Website</a>@endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="section section-soft" id="proses">
            @include('partials.admin-edit', ['section' => 'processes'])
            <div class="container">
                <div class="section-title reveal">
                    <p>Proses Kerja</p>
                    <h2>{{ $content['processes']['heading'] }}</h2>
                </div>
                <div class="process-grid">
                    @foreach ($content['processes']['items'] as $process)
                        <article class="process reveal tilt-card">
                            <div class="process-icon"><i
                                    data-lucide="{{ $processIcons[$loop->index % count($processIcons)] }}"></i></div>
                            <b>{{ $process['number'] }}</b>
                            <h3>{{ $process['title'] }}</h3>
                            <p>{{ $process['description'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="section" id="faq">
            @include('partials.admin-edit', ['section' => 'faqs'])
            <div class="container narrow">
                <div class="section-title reveal">
                    <p>FAQ</p>
                    <h2>{{ $content['faqs']['heading'] }}</h2>
                </div>
                <div class="faq-list">
                    @foreach ($content['faqs']['items'] as $faq)
                        <details class="faq reveal" @if ($loop->first) open @endif>
                            <summary><span><i data-lucide="circle-help"></i>{{ $faq['question'] }}</span><i
                                    data-lucide="plus" class="faq-toggle"></i></summary>
                            <p>{{ $faq['answer'] }}</p>
                        </details>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="section">
            @include('partials.admin-edit', ['section' => 'cta'])
            <div class="container cta reveal">
                <p><i data-lucide="sparkles"></i>{{ $content['cta']['eyebrow'] }}</p>
                <h2>{{ $content['cta']['heading'] }}</h2>
                <a class="button button-white magnetic" href="{{ $whatsappUrl }}" target="_blank"
                    rel="noopener noreferrer"><i data-lucide="send"></i>{{ $content['cta']['button'] }}</a>
            </div>
        </section>
    </main>

    <footer>
        <div class="container footer-wrap"><span>&copy; {{ date('Y') }} Mandiri Dev. Digital Innovation &
                Development.</span><span>Website | Web App | Dashboard | AI Integration | SEO</span></div>
    </footer>
    <a class="whatsapp" href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer"
        aria-label="Chat WhatsApp Mandiri Dev"><i data-lucide="message-circle"></i></a>
    <button class="top-button" id="topButton" type="button" aria-label="Kembali ke atas"><i
            data-lucide="arrow-up"></i></button>
    <script src="/js/site.js" defer></script>
    <script src="https://unpkg.com/lucide@latest" defer></script>
</body>

</html>