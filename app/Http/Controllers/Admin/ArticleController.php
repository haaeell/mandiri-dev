<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Services\RichTextSanitizer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function __construct(private readonly RichTextSanitizer $richText) {}

    public function index(): View
    {
        return view('admin.articles.index', [
            'articles' => Article::query()->latest('published_at')->latest()->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.articles.form', [
            'article' => new Article([
                'category' => 'Insight',
                'is_published' => true,
                'published_at' => now(),
            ]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $article = Article::query()->create($this->validated($request));

        return redirect()->route('admin.articles.edit', $article)->with('status', 'Artikel berhasil dibuat.');
    }

    public function edit(Article $article): View
    {
        return view('admin.articles.form', compact('article'));
    }

    public function update(Request $request, Article $article): RedirectResponse
    {
        $article->update($this->validated($request, $article));

        return back()->with('status', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Article $article): RedirectResponse
    {
        if ($article->image && ! Str::startsWith($article->image, ['http://', 'https://'])) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return redirect()->route('admin.articles.index')->with('status', 'Artikel berhasil dihapus.');
    }

    private function validated(Request $request, ?Article $article = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:160'],
            'slug' => ['nullable', 'string', 'max:180', 'regex:/^[a-z0-9-]*$/', 'unique:articles,slug,'.($article?->id ?? 'NULL')],
            'category' => ['required', 'string', 'max:80'],
            'excerpt' => ['required', 'string', 'max:320'],
            'image' => ['nullable', 'string', 'max:500'],
            'image_file' => ['nullable', 'image', 'max:3072'],
            'content' => ['required', 'string'],
            'meta_title' => ['nullable', 'string', 'max:160'],
            'meta_description' => ['nullable', 'string', 'max:320'],
            'published_at' => ['nullable', 'date'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $data['slug'] = Str::slug($data['slug'] ?: $data['title']);
        $data['content'] = $this->richText->sanitize($data['content']);
        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $data['published_at'] ?? now();

        if ($request->hasFile('image_file')) {
            if ($article?->image && ! Str::startsWith($article->image, ['http://', 'https://'])) {
                Storage::disk('public')->delete($article->image);
            }

            $data['image'] = $request->file('image_file')->store('article-images', 'public');
        } else {
            $data['image'] = $data['image'] ?? $article?->image;
        }

        return $data;
    }
}
