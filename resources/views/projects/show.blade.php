<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $project['title'] }} - Mandiri Dev</title>
    <meta name="description" content="{{ $project['description'] }}">

    <link rel="icon" href="/mandiridevpng.png" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest" defer></script>
</head>

<body class="bg-slate-50 text-slate-900 antialiased dark:bg-slate-950 dark:text-slate-50">
@php
    $mainImage = $project['thumbnail'] ?? '';
    $supportingImages = array_values(array_filter($project['gallery'] ?? []));
    $projectImages = array_values(array_filter(array_merge([$mainImage], $supportingImages)));

    $imageUrl = fn(string $image) => str_starts_with($image, 'http')
        ? $image
        : asset('storage/' . $image);
    $projectImageUrls = array_map($imageUrl, $projectImages);
@endphp

<header class="sticky top-0 z-10 border-b border-slate-200/80 bg-white/90 shadow-sm backdrop-blur-xl dark:border-white/10 dark:bg-slate-950/90">
    <div class="mx-auto flex min-h-14 w-[min(1180px,calc(100%_-_24px))] items-center justify-between gap-3 md:min-h-[78px] md:w-[min(1180px,calc(100%_-_40px))] md:gap-5">
        <a class="flex items-center gap-2.5" href="{{ route('home') }}">
            <img class="size-10 rounded-2xl md:size-12" src="/mandiridevpng.png" alt="Mandiri Dev" width="48" height="48">
            <span class="grid">
                <strong class="text-sm md:text-base">Mandiri Dev</strong>
                <small class="hidden text-[11px] text-slate-500 dark:text-slate-300 sm:block">Digital Innovation</small>
            </span>
        </a>

        <a class="inline-flex shrink-0 items-center gap-1.5 rounded-full bg-blue-50 px-3 py-2 text-[11px] font-black text-blue-600 dark:bg-blue-500/15 dark:text-blue-200 md:gap-2 md:text-xs" href="{{ route('home') }}#showcase">
            <i class="size-4" data-lucide="arrow-left"></i>
            <span class="hidden sm:inline">Kembali ke Showcase</span>
            <span class="sm:hidden">Kembali</span>
        </a>
    </div>
</header>

<main class="min-h-[calc(100vh-150px)]">
    <section class="px-0 py-4 md:py-20">
        <div class="mx-auto grid w-[min(1180px,calc(100%_-_24px))] items-start gap-4 md:w-[min(1180px,calc(100%_-_40px))] md:gap-8 lg:grid-cols-[1.05fr_.95fr]">
            <aside class="order-2 rounded-3xl border border-slate-200 bg-white p-2.5 shadow-xl shadow-slate-900/10 dark:border-white/10 dark:bg-slate-900 md:rounded-[1.875rem] md:p-4 md:shadow-2xl lg:sticky lg:top-24 lg:order-1" data-project-gallery>
                <div class="relative flex min-h-[190px] items-center justify-center overflow-hidden rounded-2xl border border-blue-600/10 bg-gradient-to-br from-blue-50 to-white dark:from-blue-950/40 dark:to-slate-950 md:min-h-[420px] md:rounded-3xl">
                    @if (count($projectImages))
                        <button class="absolute left-2 top-1/2 z-[5] grid size-9 -translate-y-1/2 place-items-center rounded-full border-0 bg-white/95 text-blue-700 shadow-xl shadow-slate-900/15 md:left-3 md:size-11" type="button" data-gallery-prev>
                            <i class="size-4" data-lucide="chevron-left"></i>
                        </button>

                        <button class="group relative grid place-items-center border-0 bg-transparent p-0" type="button" data-gallery-open aria-label="Lihat gambar lebih besar">
                        <img
                            class="block h-auto max-h-[180px] w-auto max-w-[92%] rounded-2xl bg-white object-contain shadow-2xl shadow-slate-900/15 transition group-hover:scale-[1.02] md:max-h-[390px] md:max-w-[88%]"
                            src="{{ $imageUrl($projectImages[0]) }}"
                            alt="{{ $project['title'] }}"
                            data-main-image
                        >
                        <span class="absolute bottom-2 right-2 inline-flex items-center gap-1.5 rounded-full bg-slate-950/80 px-3 py-2 text-[10px] font-black text-white backdrop-blur md:bottom-3 md:right-3 md:text-[11px]"><i class="size-3" data-lucide="maximize-2"></i>Perbesar</span>
                        </button>

                        <button class="absolute right-2 top-1/2 z-[5] grid size-9 -translate-y-1/2 place-items-center rounded-full border-0 bg-white/95 text-blue-700 shadow-xl shadow-slate-900/15 md:right-3 md:size-11" type="button" data-gallery-next data-slider-next>
                            <i class="size-4" data-lucide="chevron-right"></i>
                        </button>
                    @else
                        <div class="text-xl font-extrabold text-blue-600">
                            {{ $project['category'] }}
                        </div>
                    @endif
                </div>

                @if (count($supportingImages) > 0)
                    <div class="mx-0.5 mb-2 mt-4 flex items-center justify-between gap-2 text-[13px] font-bold text-slate-600">
                        <span class="inline-flex items-center gap-2">
                        <i class="size-4" data-lucide="images"></i>
                        Foto Pendukung
                        </span>
                        <span class="rounded-full bg-blue-50 px-2 py-1 text-[11px] font-black text-blue-700 dark:bg-blue-500/15 dark:text-blue-200">{{ count($supportingImages) }} foto</span>
                    </div>

                    <div class="relative">
                        <div class="grid grid-flow-col auto-cols-[84px] gap-2 overflow-x-auto px-0.5 pb-2 pt-1 scroll-smooth [scrollbar-width:none] md:auto-cols-[112px] [&::-webkit-scrollbar]:hidden" data-thumb-strip>
                            @foreach ($projectImages as $image)
                                <button
                                    class="h-[60px] overflow-hidden rounded-2xl border-2 border-transparent bg-blue-50 p-0 opacity-70 transition md:h-[78px] {{ $loop->first ? 'active border-blue-600 opacity-100 shadow-lg shadow-blue-600/20' : '' }}"
                                    type="button"
                                    data-thumb-index="{{ $loop->index }}"
                                    data-image="{{ $imageUrl($image) }}"
                                    aria-label="Tampilkan foto {{ $loop->iteration }}"
                                >
                                    <span class="sr-only">{{ $loop->first ? 'Thumbnail utama' : 'Foto pendukung ' . $loop->index }}</span>
                                    <img class="block h-full w-full object-cover" src="{{ $imageUrl($image) }}" alt="{{ $project['title'] }} - thumbnail {{ $loop->iteration }}">
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif
            </aside>

            <article class="order-1 overflow-hidden rounded-3xl border border-slate-200 bg-white p-4 shadow-xl shadow-slate-900/10 dark:border-white/10 dark:bg-slate-900 md:rounded-[1.875rem] md:p-8 md:shadow-2xl lg:order-2">
                <div class="mb-4 inline-flex max-w-full items-center gap-2 rounded-full bg-blue-50 px-3.5 py-2 text-[11px] font-black uppercase tracking-wider text-blue-700 dark:bg-blue-500/15 dark:text-blue-200 md:mb-5 md:text-[13px]">
                    <i class="size-4" data-lucide="layers-3"></i>
                    <span class="truncate">{{ $project['category'] }}</span>
                </div>

                <h1 class="mb-4 mt-0 break-words text-2xl font-black leading-tight md:text-5xl">{{ $project['title'] }}</h1>

                <div class="mb-5 flex flex-wrap gap-2 md:mb-7">
                    @foreach (array_filter(array_map('trim', explode(',', $project['tags']))) as $tag)
                        <span class="max-w-full break-words rounded-full bg-blue-50 px-3 py-2 text-[11px] font-bold text-blue-700 dark:bg-blue-500/15 dark:text-blue-200 md:text-xs">{{ $tag }}</span>
                    @endforeach
                </div>

                <div class="mb-6 rounded-3xl border border-blue-100 bg-blue-50 p-4 dark:border-blue-400/20 dark:bg-blue-500/10 md:mb-7">
                    <h2 class="mb-2 mt-0 text-lg font-black text-slate-950 dark:text-white md:mb-3 md:text-xl">Tertarik membuat project seperti ini?</h2>
                    <p class="mt-0 text-sm leading-7 text-slate-600 dark:text-slate-300">Lihat referensi websitenya atau konsultasikan kebutuhan sistem Anda langsung dengan tim Mandiri Dev.</p>
                    <div class="flex flex-col gap-3 sm:flex-row">
                        @if ($project['website_url'])
                            <a class="inline-flex w-full items-center justify-center gap-2 rounded-full bg-blue-600 px-5 py-3 text-sm font-extrabold text-white shadow-lg shadow-blue-600/20 sm:w-auto" href="{{ $project['website_url'] }}" target="_blank" rel="noopener noreferrer">
                                <i class="size-4" data-lucide="external-link"></i>
                                Lihat Website
                            </a>
                        @endif

                        <a class="inline-flex w-full items-center justify-center gap-2 rounded-full bg-white px-5 py-3 text-sm font-extrabold text-blue-700 shadow-sm dark:bg-slate-950 dark:text-blue-200 sm:w-auto" href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer">
                            <i class="size-4" data-lucide="message-circle"></i>
                            Konsultasi
                        </a>
                    </div>
                </div>

                <h2 class="mb-3 mt-0 text-xl font-extrabold md:text-2xl">Tentang Project</h2>

                <div class="prose prose-slate max-w-none break-words text-sm leading-7 text-slate-600 prose-headings:text-slate-900 prose-a:font-bold prose-a:text-blue-600 prose-blockquote:border-blue-600 prose-blockquote:bg-blue-50 prose-blockquote:px-4 prose-blockquote:py-2 prose-li:my-1 prose-img:max-w-full dark:prose-invert dark:text-slate-300 dark:prose-a:text-blue-200 md:text-[15px] md:leading-8 [&_*]:max-w-full">
                    {!! $detailsHtml !!}
                </div>

            </article>
        </div>
    </section>
</main>

<div class="fixed inset-0 z-40 hidden items-center justify-center bg-slate-950/85 p-3 backdrop-blur-sm md:p-4" data-image-modal>
    <button class="absolute right-3 top-3 grid size-10 place-items-center rounded-full bg-white/10 text-white md:right-4 md:top-4 md:size-11" type="button" data-image-close aria-label="Tutup preview"><i class="size-5" data-lucide="x"></i></button>
    <button class="absolute bottom-5 left-[calc(50%-52px)] grid size-11 place-items-center rounded-full bg-white/10 text-white md:left-4 md:top-1/2 md:-translate-y-1/2" type="button" data-modal-prev aria-label="Gambar sebelumnya"><i class="size-5" data-lucide="chevron-left"></i></button>
    <img class="max-h-[78vh] max-w-[94vw] rounded-2xl bg-white object-contain shadow-2xl md:max-h-[86vh] md:rounded-3xl" src="" alt="{{ $project['title'] }}" data-modal-image>
    <button class="absolute bottom-5 right-[calc(50%-52px)] grid size-11 place-items-center rounded-full bg-white/10 text-white md:right-4 md:top-1/2 md:-translate-y-1/2" type="button" data-modal-next aria-label="Gambar berikutnya"><i class="size-5" data-lucide="chevron-right"></i></button>
</div>

<footer class="border-t border-slate-200 py-8 text-sm text-slate-500 dark:border-white/10 dark:text-slate-300">
    <div class="mx-auto flex w-[min(1180px,calc(100%_-_24px))] flex-col items-center justify-between gap-3 text-center md:w-[min(1180px,calc(100%_-_40px))] md:flex-row md:text-left">
        <span>&copy; {{ date('Y') }} Mandiri Dev.</span>
        <span>Website | Web App | Dashboard | AI Integration</span>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        window.lucide && window.lucide.createIcons();

        const gallery = document.querySelector('[data-project-gallery]');
        if (!gallery) return;

        const mainImage = gallery.querySelector('[data-main-image]');
        const thumbs = Array.from(gallery.querySelectorAll('[data-thumb-index]'));
        const prevButton = gallery.querySelector('[data-gallery-prev]');
        const nextButton = gallery.querySelector('[data-gallery-next]');
        const images = @json($projectImageUrls);
        const openButton = gallery.querySelector('[data-gallery-open]');
        const modal = document.querySelector('[data-image-modal]');
        const modalImage = document.querySelector('[data-modal-image]');
        const modalPrev = document.querySelector('[data-modal-prev]');
        const modalNext = document.querySelector('[data-modal-next]');
        const modalClose = document.querySelector('[data-image-close]');

        if (!mainImage || images.length === 0) return;

        let activeIndex = 0;

        function setActiveImage(index) {
            if (index < 0) index = images.length - 1;
            if (index >= images.length) index = 0;

            activeIndex = index;

            const activeThumb = thumbs[activeIndex];
            mainImage.src = activeThumb?.dataset.image || images[activeIndex];

            thumbs.forEach(function (thumb) {
                thumb.classList.remove('active', 'border-blue-600', 'opacity-100', 'shadow-lg', 'shadow-blue-600/20');
                thumb.classList.add('border-transparent', 'opacity-70');
            });

            if (activeThumb) {
                activeThumb.classList.remove('border-transparent', 'opacity-70');
                activeThumb.classList.add('active', 'border-blue-600', 'opacity-100', 'shadow-lg', 'shadow-blue-600/20');
                activeThumb.scrollIntoView({
                    behavior: 'smooth',
                    inline: 'center',
                    block: 'nearest'
                });
            }
        }

        function openImageModal(index = activeIndex) {
            if (!modal || !modalImage || images.length === 0) return;
            if (index < 0) index = images.length - 1;
            if (index >= images.length) index = 0;
            setActiveImage(index);
            modalImage.src = images[activeIndex];
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }

        function closeImageModal() {
            if (!modal) return;
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }

        thumbs.forEach(function (thumb, index) {
            thumb.addEventListener('click', function () {
                setActiveImage(index);
            });
            thumb.addEventListener('dblclick', function () {
                openImageModal(index);
            });
        });

        if (prevButton) {
            prevButton.addEventListener('click', function () {
                setActiveImage(activeIndex - 1);
            });
        }

        if (nextButton) {
            nextButton.addEventListener('click', function () {
                setActiveImage(activeIndex + 1);
            });
        }

        openButton?.addEventListener('click', () => openImageModal(activeIndex));
        modalPrev?.addEventListener('click', () => openImageModal(activeIndex - 1));
        modalNext?.addEventListener('click', () => openImageModal(activeIndex + 1));
        modalClose?.addEventListener('click', closeImageModal);
        modal?.addEventListener('click', (event) => {
            if (event.target === modal) closeImageModal();
        });
        window.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') closeImageModal();
        });
    });
</script>

</body>
</html>
