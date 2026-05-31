<?php

namespace App\Services;

use App\Models\SiteContent;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class SiteContentService
{
    public function all(): array
    {
        $defaults = config('site-content');
        if (! Schema::hasTable('site_contents')) {
            return $defaults;
        }

        $stored = SiteContent::query()->pluck('content', 'section')->all();

        foreach ($stored as $section => $content) {
            if (array_key_exists($section, $defaults)) {
                $content = is_string($content) ? json_decode($content, true) : $content;
                $defaults[$section] = array_replace($defaults[$section], $content);
            }
        }

        $defaults['showcases']['items'] = array_map(fn (array $item) => [
            ...$item,
            'slug' => $item['slug'] ?? Str::slug($item['title']),
            'details' => $item['details'] ?? $item['description'],
            'thumbnail' => $item['thumbnail'] ?? '',
            'gallery' => $item['gallery'] ?? [],
            'website_url' => $item['website_url'] ?? '',
        ], $defaults['showcases']['items']);

        return $defaults;
    }

    public function section(string $section): array
    {
        return $this->all()[$section];
    }

    public function update(string $section, array $content): void
    {
        SiteContent::query()->updateOrCreate(
            ['section' => $section],
            ['content' => $content],
        );
    }

    public function showcase(string $slug): ?array
    {
        return collect($this->section('showcases')['items'])
            ->firstWhere('slug', $slug);
    }
}
