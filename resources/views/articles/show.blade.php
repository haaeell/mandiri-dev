<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $seo['title'] }}</title>
    <meta name="description" content="{{ $seo['description'] }}">
    <link rel="canonical" href="{{ $seo['canonical'] }}">
    <link rel="icon" href="/mandiridevpng.png" type="image/png">
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $seo['title'] }}">
    <meta property="og:description" content="{{ $seo['description'] }}">
    <meta property="og:url" content="{{ $seo['canonical'] }}">
    <meta property="og:image" content="{{ $seo['image'] }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest" defer></script>
</head>
<body class="bg-white text-slate-900 antialiased">
    <header class="sticky top-0 z-10 border-b border-slate-200/80 bg-white/90 backdrop-blur-xl">
        <div class="mx-auto flex min-h-16 w-[min(980px,calc(100%_-_32px))] items-center justify-between gap-3">
            <a class="flex items-center gap-2.5" href="{{ route('articles.index') }}"><img class="size-11 rounded-2xl" src="/mandiridevpng.png" alt="Mandiri Dev"><span class="grid"><strong>Mandiri Dev</strong><small class="text-[11px] text-slate-500">Artikel</small></span></a>
            <a class="inline-flex items-center gap-2 rounded-full bg-blue-50 px-3 py-2 text-xs font-black text-blue-700" href="{{ route('articles.index') }}"><i class="size-4" data-lucide="arrow-left"></i>Artikel</a>
        </div>
    </header>

    <main>
        <article class="mx-auto w-[min(860px,calc(100%_-_32px))] py-10 md:py-16">
            <div class="mb-6 flex flex-wrap items-center gap-2">
                <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-black text-blue-700">{{ $article->category }}</span>
                <span class="text-xs font-bold text-slate-500">{{ $article->published_at?->format('d M Y') }}</span>
            </div>
            <h1 class="m-0 text-4xl font-black leading-tight md:text-6xl">{{ $article->title }}</h1>
            <p class="mt-5 text-lg leading-8 text-slate-600">{{ $article->excerpt }}</p>
            <div class="mt-8 overflow-hidden rounded-3xl bg-slate-100">
                @if ($article->image)
                    <img class="h-[260px] w-full object-cover md:h-[420px]" src="{{ str_starts_with($article->image, 'http') ? $article->image : asset('storage/'.$article->image) }}" alt="{{ $article->title }}">
                @else
                    <div class="grid h-[260px] place-items-center bg-gradient-to-br from-blue-600 to-cyan-400 text-lg font-black text-white md:h-[420px]">Mandiri Dev Insight</div>
                @endif
            </div>
            <div class="my-8 h-px bg-slate-200"></div>
            <div class="prose prose-slate max-w-none leading-8 prose-headings:font-black prose-headings:text-slate-950 prose-a:font-bold prose-a:text-blue-600 prose-blockquote:rounded-2xl prose-blockquote:border-blue-600 prose-blockquote:bg-blue-50 prose-blockquote:px-5 prose-blockquote:py-3">
                {!! $contentHtml !!}
            </div>
            <div class="mt-10 rounded-3xl bg-slate-950 p-6 text-white">
                <p class="m-0 text-sm font-bold text-blue-200">Butuh sistem seperti ini?</p>
                <h2 class="mt-2 text-2xl font-black">Diskusikan kebutuhan website, dashboard, atau sistem custom Anda.</h2>
                <a class="mt-4 inline-flex items-center gap-2 rounded-full bg-white px-4 py-3 text-sm font-black text-slate-950" href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer"><i class="size-4" data-lucide="message-circle"></i>Konsultasi</a>
            </div>
        </article>
    </main>
    <script>window.addEventListener('DOMContentLoaded', () => window.lucide && window.lucide.createIcons());</script>
</body>
</html>
