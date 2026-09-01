<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $seo['title'] }}</title>
    <meta name="description" content="{{ $seo['description'] }}">
    <link rel="canonical" href="{{ $seo['canonical'] }}">
    <link rel="icon" href="/mandiridevpng.png" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,700&family=Caveat:wght@600&family=IBM+Plex+Mono:wght@500;600&family=Instrument+Serif:ital@0;1&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest" defer></script>
</head>
<body class="bg-slate-950 text-white antialiased">
    @include('partials.public-navbar')

    <main>
        <section class="relative overflow-hidden py-16">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_10%,rgba(37,99,235,.35),transparent_32%),radial-gradient(circle_at_80%_0%,rgba(6,182,212,.22),transparent_26%)]"></div>
            <div class="relative mx-auto w-[min(980px,calc(100%_-_32px))] text-center">
                <p class="font-handwritten mb-3 text-2xl font-semibold text-blue-200">Artikel SEO</p>
                <h1 class="font-display m-0 text-4xl font-bold leading-tight md:text-6xl">Catatan developer untuk website yang <span class="font-editorial font-normal italic text-blue-300">lebih siap tumbuh.</span></h1>
                <p class="mx-auto mt-5 max-w-2xl text-slate-300">{{ $seo['description'] }}</p>
            </div>
        </section>

        <section class="pb-16">
            <div class="mx-auto grid w-[min(1180px,calc(100%_-_32px))] gap-4 md:grid-cols-3">
                @forelse ($articles as $article)
                    <article class="group overflow-hidden rounded-3xl border border-white/10 bg-white/[.04] p-5 shadow-2xl shadow-black/20 transition hover:-translate-y-1 hover:border-blue-300/40 hover:bg-white/[.07]">
                        <a class="mb-5 block overflow-hidden rounded-2xl bg-slate-900" href="{{ route('articles.show', $article) }}">
                            @if ($article->image)
                                <img class="h-44 w-full object-cover transition duration-500 group-hover:scale-105" src="{{ str_starts_with($article->image, 'http') ? $article->image : asset('storage/'.$article->image) }}" alt="{{ $article->title }}">
                            @else
                                <div class="grid h-44 place-items-center bg-blue-600 text-sm font-black">Mandiri Dev Insight</div>
                            @endif
                        </a>
                        <div class="mb-4 flex items-center justify-between gap-3">
                            <span class="font-code rounded-full bg-blue-500/15 px-3 py-1 text-[10px] font-semibold text-blue-200">{{ $article->category }}</span>
                            <span class="font-code text-[10px] font-medium text-slate-400">{{ $article->published_at?->format('d M Y') }}</span>
                        </div>
                        <h2 class="font-display text-xl font-bold leading-tight">{{ $article->title }}</h2>
                        <p class="text-sm leading-7 text-slate-300">{{ $article->excerpt }}</p>
                        <a class="mt-4 inline-flex items-center gap-2 rounded-full bg-white px-4 py-2.5 text-xs font-black text-slate-950 transition group-hover:bg-blue-500 group-hover:text-white" href="{{ route('articles.show', $article) }}">Baca Artikel <i class="size-4" data-lucide="arrow-up-right"></i></a>
                    </article>
                @empty
                    <div class="rounded-3xl border border-white/10 p-8 text-center text-slate-300 md:col-span-3">Belum ada artikel.</div>
                @endforelse
            </div>
            <div class="mx-auto mt-8 w-[min(1180px,calc(100%_-_32px))]">{{ $articles->links() }}</div>
        </section>
    </main>
    <script src="/js/site.js" defer></script>
</body>
</html>
