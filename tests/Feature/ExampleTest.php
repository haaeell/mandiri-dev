<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_home_page_is_served_by_blade_with_seo_data(): void
    {
        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('<title>Mandiri Dev - Software House &amp; Digital Development</title>', false)
            ->assertSee('<script type="application/ld+json">', false)
            ->assertSee('<link rel="stylesheet" href="/css/site.css">', false)
            ->assertSee('<link rel="stylesheet" href="/css/landing-wow.css">', false)
            ->assertSee('family=Poppins', false)
            ->assertSee('data-lucide="sparkles"', false)
            ->assertSee('Bangun Solusi Digital');
    }

    public function test_sitemap_contains_the_home_page(): void
    {
        $this->get('/sitemap.xml')
            ->assertOk()
            ->assertHeader('Content-Type', 'application/xml')
            ->assertSee('<loc>'.config('seo.site_url').'/</loc>', false)
            ->assertSee('/project/sistem-sekolah-digital', false);
    }

    public function test_robots_points_to_the_sitemap(): void
    {
        $this->get('/robots.txt')
            ->assertOk()
            ->assertHeader('Content-Type', 'text/plain; charset=UTF-8')
            ->assertSee('Sitemap: '.url('/sitemap.xml'));
    }

    public function test_google_site_verification_file_is_public(): void
    {
        $this->assertFileExists(public_path('googlef4e9c131819cad2a.html'));
    }

    public function test_public_site_assets_exist(): void
    {
        $this->assertFileExists(public_path('css/site.css'));
        $this->assertFileExists(public_path('css/landing-wow.css'));
        $this->assertFileExists(public_path('js/site.js'));
    }
}
