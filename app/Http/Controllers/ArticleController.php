<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Services\RichTextSanitizer;
use App\Services\SiteContentService;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function __construct(
        private readonly RichTextSanitizer $richText,
        private readonly SiteContentService $contents,
    ) {}

    public function index(): View
    {
        return view('articles.index', [
            'articles' => Article::query()->published()->latest('published_at')->paginate(9),
            'seo' => [
                'title' => 'Artikel Web Development, SEO, dan Sistem Digital - Mandiri Dev',
                'description' => 'Insight Mandiri Dev tentang web development, SEO teknis, sistem sekolah, dashboard bisnis, dan integrasi AI.',
                'canonical' => url('/artikel'),
                'image' => config('seo.pages.home.image'),
            ],
        ]);
    }

    public function show(Article $article): View
    {
        abort_unless($article->is_published && $article->published_at?->lte(now()), 404);
        $seo = $this->contents->section('seo');

        return view('articles.show', [
            'article' => $article,
            'contentHtml' => $this->richText->forDisplay($article->content),
            'whatsappUrl' => 'https://wa.me/'.$seo['whatsapp_number'].'?text='.rawurlencode('Halo Mandiri Dev, saya ingin konsultasi setelah membaca artikel '.$article->title),
            'seo' => [
                'title' => $article->meta_title ?: $article->title,
                'description' => $article->meta_description ?: $article->excerpt,
                'canonical' => route('articles.show', $article),
                'image' => $article->image
                    ? (Str::startsWith($article->image, ['http://', 'https://']) ? $article->image : asset('storage/'.$article->image))
                    : config('seo.pages.home.image'),
            ],
        ]);
    }
}
