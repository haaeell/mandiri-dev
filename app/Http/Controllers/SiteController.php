<?php

namespace App\Http\Controllers;

use App\Services\SiteContentService;
use App\Services\RichTextSanitizer;
use App\Models\Article;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function __construct(
        private readonly SiteContentService $contents,
        private readonly RichTextSanitizer $richText,
    ) {}

    public function home(): View
    {
        $content = $this->contents->all();
        $seo = [
            ...config('seo.pages.home'),
            'title' => $content['seo']['title'],
            'description' => $content['seo']['description'],
        ];
        $whatsappUrl = 'https://wa.me/'.$content['seo']['whatsapp_number'].'?text='.rawurlencode('Halo Mandiri Dev, saya ingin konsultasi project digital');

        return view('home', [
            'content' => $content,
            'articles' => Schema::hasTable('articles')
                ? Article::query()->published()->latest('published_at')->take(3)->get()
                : collect(),
            'seo' => $seo,
            'whatsappUrl' => $whatsappUrl,
            'adminPreview' => request()->boolean('admin_preview') && auth()->user()?->is_admin,
        ]);
    }

    public function sitemap(): Response
    {
        $projects = collect($this->contents->section('showcases')['items'])
            ->map(fn (array $project) => [
                'url' => rtrim(config('seo.site_url'), '/').'/project/'.$project['slug'],
                'changefreq' => 'monthly',
                'priority' => '0.7',
            ]);

        $articles = Schema::hasTable('articles')
            ? Article::query()->published()->latest('published_at')->get()->map(fn (Article $article) => [
                'url' => route('articles.show', $article),
                'changefreq' => 'monthly',
                'priority' => '0.8',
            ])
            : collect();

        return response()
            ->view('seo.sitemap', ['pages' => collect(config('seo.sitemap'))->push([
                'url' => route('projects.index'),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ])->concat($projects)->concat($articles)])
            ->header('Content-Type', 'application/xml');
    }

    public function portfolio(): View
    {
        $content = $this->contents->all();
        $seo = $this->contents->section('seo');

        return view('projects.index', [
            'projects' => $content['showcases']['items'],
            'heading' => $content['showcases']['heading'],
            'whatsappUrl' => 'https://wa.me/'.$seo['whatsapp_number'].'?text='.rawurlencode('Halo Mandiri Dev, saya ingin konsultasi project digital'),
        ]);
    }

    public function project(string $slug): View
    {
        abort_unless($project = $this->contents->showcase($slug), 404);
        $seo = $this->contents->section('seo');

        return view('projects.show', [
            'project' => $project,
            'detailsHtml' => $this->richText->forDisplay($project['details']),
            'whatsappUrl' => 'https://wa.me/'.$seo['whatsapp_number'].'?text='.rawurlencode('Halo Mandiri Dev, saya ingin konsultasi project digital'),
        ]);
    }

    public function robots(): Response
    {
        return response(implode("\n", [
            'User-agent: *',
            'Allow: /',
            '',
            'Sitemap: '.url('/sitemap.xml'),
            '',
        ]), 200)->header('Content-Type', 'text/plain');
    }
}
