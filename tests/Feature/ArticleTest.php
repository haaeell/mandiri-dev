<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    public function test_published_article_is_visible_and_in_sitemap(): void
    {
        $article = Article::query()->create([
            'title' => 'SEO Teknis untuk Website Bisnis',
            'slug' => 'seo-teknis-website-bisnis',
            'category' => 'SEO',
            'excerpt' => 'Panduan SEO teknis untuk website bisnis.',
            'content' => '<h2>SEO teknis</h2><p>Struktur website perlu rapi.</p>',
            'is_published' => true,
            'published_at' => now(),
        ]);

        $this->get('/artikel')->assertOk()->assertSee($article->title);
        $this->get('/artikel/'.$article->slug)
            ->assertOk()
            ->assertSee($article->title)
            ->assertSee('<h2>SEO teknis</h2>', false);

        $this->get('/sitemap.xml')
            ->assertOk()
            ->assertSee('/artikel/'.$article->slug, false);
    }

    public function test_admin_can_create_update_and_delete_article(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->actingAs($admin)
            ->post('/admin/articles', [
                'title' => 'Checklist Dashboard Bisnis',
                'slug' => 'checklist-dashboard-bisnis',
                'category' => 'Dashboard',
                'excerpt' => 'Checklist fitur dashboard bisnis.',
                'content' => '<h2>Dashboard</h2><p>Mulai dari KPI utama.</p>',
                'is_published' => '1',
                'published_at' => now()->format('Y-m-d H:i:s'),
            ])
            ->assertRedirect();

        $article = Article::query()->where('slug', 'checklist-dashboard-bisnis')->firstOrFail();

        $this->actingAs($admin)
            ->put('/admin/articles/'.$article->slug, [
                'title' => 'Checklist Dashboard Bisnis Updated',
                'slug' => $article->slug,
                'category' => 'Dashboard',
                'excerpt' => 'Checklist fitur dashboard bisnis updated.',
                'content' => '<script>bad()</script><h2>Aman</h2>',
                'is_published' => '1',
                'published_at' => now()->format('Y-m-d H:i:s'),
            ])
            ->assertRedirect();

        $this->assertSame('Checklist Dashboard Bisnis Updated', $article->refresh()->title);
        $this->assertStringNotContainsString('<script', $article->content);

        $this->actingAs($admin)->delete('/admin/articles/'.$article->slug)->assertRedirect('/admin/articles');
        $this->assertDatabaseMissing('articles', ['id' => $article->id]);
    }
}
