<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portofolio Project - Mandiri Dev</title>
    <meta name="description" content="Kumpulan portofolio website, web app, dashboard, sistem sekolah, dan integrasi digital Mandiri Dev.">
    <link rel="icon" href="/mandiridevpng.png" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest" defer></script>
</head>
<body class="bg-slate-50 text-slate-900 antialiased dark:bg-slate-950 dark:text-slate-50">
<header class="sticky top-0 z-10 border-b border-slate-200/80 bg-white/90 shadow-sm backdrop-blur-xl dark:border-white/10 dark:bg-slate-950/90">
    <div class="mx-auto flex min-h-16 w-[min(1180px,calc(100%_-_32px))] items-center justify-between gap-3 md:min-h-[78px] md:w-[min(1180px,calc(100%_-_40px))]">
        <a class="flex items-center gap-2.5" href="{{ route('home') }}">
            <img class="size-11 rounded-2xl md:size-12" src="/mandiridevpng.png" alt="Mandiri Dev" width="48" height="48">
            <span class="grid"><strong class="text-sm md:text-base">Mandiri Dev</strong><small class="hidden text-[11px] text-slate-500 dark:text-slate-300 sm:block">Digital Innovation</small></span>
        </a>
        <a class="inline-flex items-center gap-1.5 rounded-full bg-blue-50 px-3 py-2 text-[11px] font-black text-blue-600 dark:bg-blue-500/15 dark:text-blue-200 md:gap-2 md:text-xs" href="{{ route('home') }}#showcase">
            <i class="size-4" data-lucide="arrow-left"></i>
            <span class="hidden sm:inline">Kembali ke Home</span>
            <span class="sm:hidden">Kembali</span>
        </a>
    </div>
</header>

<main>
    <section class="px-0 py-10 md:py-16">
        <div class="mx-auto w-[min(1180px,calc(100%_-_32px))] md:w-[min(1180px,calc(100%_-_40px))]">
            <div class="mb-8 max-w-3xl md:mb-10">
                <p class="m-0 font-black text-blue-600">Portofolio</p>
                <h1 class="my-2 text-3xl font-black leading-tight tracking-tight md:text-5xl">{{ $heading }}</h1>
                <span class="text-slate-500 dark:text-slate-300">Semua project yang ditampilkan admin, lengkap dalam satu halaman.</span>
            </div>

            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($projects as $project)
                    <article class="group relative overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-2 hover:border-blue-200 hover:shadow-2xl hover:shadow-blue-600/10 dark:border-white/10 dark:bg-slate-900">
                        <div class="absolute inset-x-6 -top-10 h-24 rounded-full bg-blue-500/20 blur-3xl transition group-hover:bg-cyan-400/30"></div>
                        <div class="relative flex min-h-[230px] flex-col justify-end overflow-hidden p-5 text-white {{ !$project['thumbnail'] ? 'bg-[radial-gradient(circle_at_20%_20%,rgba(255,255,255,.26),transparent_28%),linear-gradient(135deg,#0f172a,#2563eb,#06b6d4)]' : '' }}">
                            @if ($project['thumbnail'])
                                <img class="absolute inset-0 h-full w-full object-cover transition duration-500 group-hover:scale-105" src="{{ str_starts_with($project['thumbnail'], 'http') ? $project['thumbnail'] : asset('storage/' . $project['thumbnail']) }}" alt="{{ $project['title'] }}">
                                <div class="absolute inset-0 bg-gradient-to-b from-slate-900/15 to-slate-900/60"></div>
                            @endif
                            <div class="absolute right-4 top-4 grid size-11 place-items-center rounded-2xl border border-white/20 bg-white/15 backdrop-blur transition group-hover:rotate-6 group-hover:scale-110"><i class="size-5" data-lucide="code-2"></i></div>
                            <small class="relative rounded-full bg-white/15 px-3 py-1 text-[11px] font-black uppercase tracking-wider backdrop-blur">{{ $project['category'] }}</small>
                            <h2 class="relative my-2 text-2xl font-extrabold">{{ $project['title'] }}</h2>
                        </div>
                        <div class="p-5">
                            <p class="mb-0 text-sm text-slate-500 dark:text-slate-300">{{ $project['description'] }}</p>
                            <div class="mt-4 flex flex-wrap gap-2">
                                @foreach (array_filter(array_map('trim', explode(',', $project['tags']))) as $tag)
                                    <span class="rounded-full bg-blue-50 px-2.5 py-1 text-[11px] font-extrabold text-blue-700 dark:bg-blue-600/15 dark:text-blue-200">{{ $tag }}</span>
                                @endforeach
                            </div>
                            <div class="mt-5 flex flex-wrap gap-3">
                                <a class="group/btn inline-flex items-center gap-2 rounded-full bg-slate-950 px-4 py-2.5 text-xs font-black text-white transition hover:bg-blue-600 dark:bg-blue-600" href="{{ route('projects.show', $project['slug']) }}">Lihat Detail<i class="size-4 transition group-hover/btn:translate-x-1" data-lucide="arrow-right"></i></a>
                                @if ($project['website_url'])
                                    <a class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-4 py-2.5 text-xs font-black text-slate-600 transition hover:bg-blue-50 hover:text-blue-700 dark:bg-white/10 dark:text-slate-200" href="{{ $project['website_url'] }}" target="_blank" rel="noopener noreferrer"><i class="size-4" data-lucide="external-link"></i>Lihat Website</a>
                                @endif
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
</main>

<footer class="border-t border-slate-200 py-8 text-sm text-slate-500 dark:border-white/10 dark:text-slate-300">
    <div class="mx-auto flex w-[min(1180px,calc(100%_-_40px))] flex-col items-center justify-between gap-3 text-center md:flex-row md:text-left">
        <span>&copy; {{ date('Y') }} Mandiri Dev.</span>
        <span>Website | Web App | Dashboard | AI Integration</span>
    </div>
</footer>
<script src="/js/site.js" defer></script>
</body>
</html>
