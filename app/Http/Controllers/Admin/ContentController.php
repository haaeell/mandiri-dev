<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\RichTextSanitizer;
use App\Services\SiteContentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ContentController extends Controller
{
    private const SECTIONS = [
        'seo' => ['SEO & Kontak', 'search'],
        'hero' => ['Hero Utama', 'sparkles'],
        'services' => ['Layanan', 'layout-grid'],
        'showcases' => ['Showcase', 'panels-top-left'],
        'processes' => ['Proses Kerja', 'list-checks'],
        'faqs' => ['FAQ', 'circle-help'],
        'cta' => ['Ajakan Konsultasi', 'message-circle'],
    ];

    public function __construct(
        private readonly SiteContentService $contents,
        private readonly RichTextSanitizer $richText,
    ) {}

    public function index(): View
    {
        return view('admin.content.index', [
            'sections' => self::SECTIONS,
        ]);
    }

    public function edit(string $section): View
    {
        abort_unless(array_key_exists($section, self::SECTIONS), 404);

        return view('admin.content.edit', [
            'section' => $section,
            'sectionMeta' => self::SECTIONS[$section],
            'sections' => self::SECTIONS,
            'content' => $this->contents->section($section),
        ]);
    }

    public function update(Request $request, string $section): RedirectResponse
    {
        abort_unless(array_key_exists($section, self::SECTIONS), 404);

        $rules = [
            'content' => ['required', 'array'],
            'thumbnail_files.*' => ['nullable', 'image', 'max:3072'],
            'gallery_files.*.*' => ['nullable', 'image', 'max:3072'],
            'remove_gallery.*' => ['nullable', 'array'],
            'remove_gallery.*.*' => ['string'],
        ];

        if ($section === 'showcases') {
            $rules += [
                'content.heading' => ['required', 'string'],
                'content.items' => ['required', 'array', 'min:1'],
                'content.items.*.category' => ['required', 'string'],
                'content.items.*.title' => ['required', 'string'],
                'content.items.*.slug' => ['nullable', 'string', 'distinct', 'regex:/^[a-z0-9-]*$/'],
                'content.items.*.description' => ['required', 'string'],
                'content.items.*.details' => ['required', 'string'],
                'content.items.*.website_url' => ['nullable', 'url:http,https'],
                'content.items.*.tags' => ['required', 'string'],
                'content.items.*.thumbnail' => ['nullable', 'string'],
                'content.items.*.gallery' => ['nullable', 'array'],
                'content.items.*.gallery.*' => ['string'],
            ];
        }

        $validated = $request->validate($rules);

        $content = $this->trimStrings($validated['content']);

        if ($section === 'showcases') {
            foreach ($content['items'] as $index => &$item) {
                $item['slug'] = Str::slug($item['slug'] ?: $item['title']);
                $item['thumbnail'] ??= '';
                $item['gallery'] ??= [];
                $item['website_url'] ??= '';
                $item['details'] = $this->richText->sanitize($item['details'] ?? $item['description']);

                if ($request->hasFile("thumbnail_files.{$index}")) {
                    if ($item['thumbnail'] && ! Str::startsWith($item['thumbnail'], ['http://', 'https://'])) {
                        Storage::disk('public')->delete($item['thumbnail']);
                    }

                    $item['thumbnail'] = $request->file("thumbnail_files.{$index}")
                        ->store('showcase-thumbnails', 'public');
                }

                $removedImages = array_intersect(
                    $item['gallery'],
                    $request->input("remove_gallery.{$index}", []),
                );

                foreach ($removedImages as $removedImage) {
                    if (! Str::startsWith($removedImage, ['http://', 'https://'])) {
                        Storage::disk('public')->delete($removedImage);
                    }
                }

                $item['gallery'] = array_values(array_diff($item['gallery'], $removedImages));

                foreach ($request->file("gallery_files.{$index}", []) as $galleryFile) {
                    $item['gallery'][] = $galleryFile->store('showcase-gallery', 'public');
                }
            }
        }

        $this->contents->update($section, $content);

        return back()->with('status', 'Perubahan berhasil disimpan.');
    }

    private function trimStrings(array $values): array
    {
        return array_map(function ($value) {
            return is_array($value) ? $this->trimStrings($value) : trim((string) $value);
        }, $values);
    }
}
