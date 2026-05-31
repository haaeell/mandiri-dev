<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $project['title'] }} - Mandiri Dev</title>
    <meta name="description" content="{{ $project['description'] }}">

    <link rel="icon" href="/logo.png" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/css/site.css">
    <link rel="stylesheet" href="/css/showcase.css">
    <link rel="stylesheet" href="/css/landing-wow.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

        .project-detail-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.05fr) minmax(0, .95fr);
            gap: 34px;
            align-items: start;
        }

        .project-gallery-card,
        .project-content-card {
            background: #fff;
            border: 1px solid rgba(15, 23, 42, .08);
            box-shadow: 0 24px 70px rgba(15, 23, 42, .10);
            border-radius: 30px;
        }

        .project-gallery-card {
            padding: 18px;
            position: sticky;
            top: 96px;
        }

        .main-preview {
            position: relative;
            min-height: 420px;
            border-radius: 24px;
            background: linear-gradient(135deg, #eff6ff, #ffffff);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 1px solid rgba(37, 99, 235, .12);
        }

        .main-preview img {
            display: block;
            width: auto;
            height: auto;
            max-width: 88%;
            max-height: 390px;
            object-fit: contain;
            border-radius: 18px;
            box-shadow: 0 18px 50px rgba(15, 23, 42, .16);
            background: #fff;
        }

        .main-preview-placeholder {
            color: #2563eb;
            font-weight: 800;
            font-size: 20px;
        }

        .gallery-control {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 42px;
            height: 42px;
            border: none;
            border-radius: 999px;
            background: rgba(255,255,255,.94);
            color: #1d4ed8;
            box-shadow: 0 12px 30px rgba(15,23,42,.15);
            cursor: pointer;
            z-index: 5;
        }

        .gallery-prev {
            left: 14px;
        }

        .gallery-next {
            right: 14px;
        }

        .supporting-title {
            margin: 16px 2px 10px;
            font-size: 13px;
            font-weight: 700;
            color: #475569;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .thumb-strip-wrap {
            position: relative;
        }

        .thumb-strip {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            scroll-behavior: smooth;
            padding: 4px 2px 8px;
        }

        .thumb-strip::-webkit-scrollbar {
            height: 6px;
        }

        .thumb-strip::-webkit-scrollbar-thumb {
            background: #bfdbfe;
            border-radius: 999px;
        }

        .thumb-item {
            flex: 0 0 112px;
            height: 78px;
            border: 2px solid transparent;
            border-radius: 16px;
            overflow: hidden;
            padding: 0;
            background: #eff6ff;
            cursor: pointer;
            opacity: .72;
            transition: .2s ease;
        }

        .thumb-item.active {
            opacity: 1;
            border-color: #2563eb;
            box-shadow: 0 10px 24px rgba(37,99,235,.22);
        }

        .thumb-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .project-content-card {
            padding: 34px;
        }

        .project-category {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            border-radius: 999px;
            background: #eff6ff;
            color: #1d4ed8;
            font-size: 13px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .06em;
            margin-bottom: 18px;
        }

        .project-content-card h1 {
            margin: 0 0 16px;
            font-size: clamp(30px, 4vw, 52px);
            line-height: 1.08;
            color: #0f172a;
        }

        .tags {
            display: flex;
            flex-wrap: wrap;
            gap: 9px;
            margin-bottom: 26px;
        }

        .tags span {
            padding: 8px 13px;
            border-radius: 999px;
            background: rgba(37, 99, 235, .08);
            color: #1d4ed8;
            font-size: 12px;
            font-weight: 700;
        }

        .project-content-card h2 {
            margin: 0 0 14px;
            font-size: 24px;
            color: #0f172a;
        }

        .project-description {
            color: #475569;
            line-height: 1.8;
            font-size: 15px;
        }

        .project-description h1,
        .project-description h2,
        .project-description h3,
        .project-description h4 {
            color: #0f172a;
            margin-top: 22px;
        }

        .project-description ul,
        .project-description ol {
            padding-left: 22px;
        }

        .project-description li {
            margin-bottom: 8px;
        }

        .button-row {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 28px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 13px 18px;
            border-radius: 999px;
            background: #2563eb;
            color: #fff;
            font-weight: 800;
            text-decoration: none;
        }

        .button-muted {
            background: #eff6ff;
            color: #1d4ed8;
        }

        @media (max-width: 992px) {
            .project-detail-grid {
                grid-template-columns: 1fr;
            }

            .project-gallery-card {
                position: relative;
                top: auto;
            }
        }

        @media (max-width: 640px) {

            .project-gallery-card,
            .project-content-card {
                border-radius: 22px;
            }

            .project-gallery-card {
                padding: 12px;
            }

            .main-preview {
                min-height: 280px;
                border-radius: 18px;
            }

            .main-preview img {
                max-width: 92%;
                max-height: 260px;
                border-radius: 14px;
            }

            .gallery-control {
                width: 36px;
                height: 36px;
            }

            .thumb-item {
                flex-basis: 92px;
                height: 66px;
                border-radius: 13px;
            }

            .project-content-card {
                padding: 24px;
            }

            .button-row {
                flex-direction: column;
            }

            .button {
                width: 100%;
            }
        }
    </style>
</head>

<body>
@php
    $projectImages = array_values(array_filter(array_merge(
        [$project['thumbnail'] ?? ''],
        $project['gallery'] ?? []
    )));

    $imageUrl = fn(string $image) => str_starts_with($image, 'http')
        ? $image
        : asset('storage/' . $image);
@endphp

<header class="site-header">
    <div class="container nav-wrap">
        <a class="brand" href="{{ route('home') }}">
            <img src="/logo.png" alt="Mandiri Dev" width="48" height="48">
            <span>
                <strong>Mandiri Dev</strong>
                <small>Digital Innovation</small>
            </span>
        </a>

        <a class="detail-back" href="{{ route('home') }}#showcase">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali ke Showcase
        </a>
    </div>
</header>

<main class="project-detail">
    <section class="section">
        <div class="container project-detail-grid">

            <aside class="project-gallery-card" data-project-gallery>
                <div class="main-preview">
                    @if (count($projectImages))
                        <button class="gallery-control gallery-prev" type="button" data-gallery-prev>
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>

                        <img
                            src="{{ $imageUrl($projectImages[0]) }}"
                            alt="{{ $project['title'] }}"
                            data-main-image
                        >

                        <button class="gallery-control gallery-next" type="button" data-gallery-next>
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    @else
                        <div class="main-preview-placeholder">
                            {{ $project['category'] }}
                        </div>
                    @endif
                </div>

                @if (count($projectImages) > 1)
                    <div class="supporting-title">
                        <i class="fa-regular fa-images"></i>
                        Foto Pendukung
                    </div>

                    <div class="thumb-strip-wrap">
                        <div class="thumb-strip" data-thumb-strip>
                            @foreach ($projectImages as $image)
                                <button
                                    class="thumb-item {{ $loop->first ? 'active' : '' }}"
                                    type="button"
                                    data-thumb-index="{{ $loop->index }}"
                                    data-image="{{ $imageUrl($image) }}"
                                    aria-label="Tampilkan foto {{ $loop->iteration }}"
                                >
                                    <img src="{{ $imageUrl($image) }}" alt="{{ $project['title'] }} - thumbnail {{ $loop->iteration }}">
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif
            </aside>

            <article class="project-content-card">
                <div class="project-category">
                    <i class="fa-solid fa-layer-group"></i>
                    {{ $project['category'] }}
                </div>

                <h1>{{ $project['title'] }}</h1>

                <div class="tags">
                    @foreach (array_filter(array_map('trim', explode(',', $project['tags']))) as $tag)
                        <span>{{ $tag }}</span>
                    @endforeach
                </div>

                <h2>Tentang Project</h2>

                <div class="project-description">
                    {!! $detailsHtml !!}
                </div>

                <div class="button-row">
                    @if ($project['website_url'])
                        <a class="button" href="{{ $project['website_url'] }}" target="_blank" rel="noopener noreferrer">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                            Lihat Website
                        </a>
                    @endif

                    <a class="button button-muted" href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer">
                        <i class="fa-brands fa-whatsapp"></i>
                        Konsultasi
                    </a>
                </div>
            </article>

        </div>
    </section>
</main>

<footer>
    <div class="container footer-wrap">
        <span>&copy; {{ date('Y') }} Mandiri Dev.</span>
        <span>Website | Web App | Dashboard | AI Integration</span>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const gallery = document.querySelector('[data-project-gallery]');
        if (!gallery) return;

        const mainImage = gallery.querySelector('[data-main-image]');
        const thumbs = Array.from(gallery.querySelectorAll('[data-thumb-index]'));
        const prevButton = gallery.querySelector('[data-gallery-prev]');
        const nextButton = gallery.querySelector('[data-gallery-next]');

        if (!mainImage || thumbs.length === 0) return;

        let activeIndex = 0;

        function setActiveImage(index) {
            if (index < 0) index = thumbs.length - 1;
            if (index >= thumbs.length) index = 0;

            activeIndex = index;

            const activeThumb = thumbs[activeIndex];
            const imageUrl = activeThumb.dataset.image;

            mainImage.src = imageUrl;

            thumbs.forEach(function (thumb) {
                thumb.classList.remove('active');
            });

            activeThumb.classList.add('active');
            activeThumb.scrollIntoView({
                behavior: 'smooth',
                inline: 'center',
                block: 'nearest'
            });
        }

        thumbs.forEach(function (thumb, index) {
            thumb.addEventListener('click', function () {
                setActiveImage(index);
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
    });
</script>

</body>
</html>