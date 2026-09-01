<?php

namespace Tests\Feature;

use App\Models\SiteContent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_admin_login(): void
    {
        $this->get('/admin/content')->assertRedirect('/admin/login');
    }

    public function test_admin_can_login_and_open_content_manager(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => 'secret-password',
            'is_admin' => true,
        ]);

        $this->post('/admin/login', [
            'email' => $admin->email,
            'password' => 'secret-password',
        ])->assertRedirect(route('admin.content.index'));

        $this->get('/admin/content')
            ->assertOk()
            ->assertSee('Kelola Konten Landing Page')
            ->assertSee('Preview Landing Page');
    }

    public function test_admin_can_update_hero_and_see_edit_badges_in_preview(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $hero = config('site-content.hero');
        $hero['title'] = 'Solusi Digital Terbaru';

        $this->actingAs($admin)
            ->put('/admin/content/hero', ['content' => $hero])
            ->assertRedirect();

        $this->assertSame('Solusi Digital Terbaru', SiteContent::query()->where('section', 'hero')->firstOrFail()->content['title']);

        $this->get('/')->assertOk()->assertSee('Solusi Digital Terbaru');
        $this->get('/?admin_preview=1')->assertOk()->assertSee('Edit bagian ini');
    }

    public function test_every_content_editor_can_be_opened_by_admin(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        foreach (['seo', 'hero', 'services', 'showcases', 'processes', 'faqs', 'cta'] as $section) {
            $this->actingAs($admin)->get("/admin/content/{$section}/edit")->assertOk();
        }
    }

    public function test_regular_user_cannot_open_admin_panel(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->actingAs($user)->get('/admin/content')->assertForbidden();
    }

    public function test_admin_can_upload_showcase_thumbnail_and_open_project_detail(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create(['is_admin' => true]);
        $showcases = config('site-content.showcases');
        $showcases['items'][0]['website_url'] = 'https://example.com/project';
        $showcases['items'][0]['details'] = '<h2>Fitur utama</h2><ul><li>Absensi QR</li></ul>';

        $this->actingAs($admin)
            ->put('/admin/content/showcases', [
                'content' => $showcases,
                'thumbnail_files' => [UploadedFile::fake()->image('school.jpg')],
                'gallery_files' => [[
                    UploadedFile::fake()->image('dashboard.jpg'),
                    UploadedFile::fake()->image('report.jpg'),
                ]],
            ])
            ->assertRedirect();

        $project = SiteContent::query()->where('section', 'showcases')->firstOrFail()->content['items'][0];
        Storage::disk('public')->assertExists($project['thumbnail']);
        Storage::disk('public')->assertExists($project['gallery'][0]);
        Storage::disk('public')->assertExists($project['gallery'][1]);

        $this->get('/')->assertOk()->assertSee('Lihat Detail')->assertSee('Lihat Website');
        $this->get('/project/sistem-sekolah-digital')
            ->assertOk()
            ->assertSee('Sistem Sekolah Digital')
            ->assertSee('Thumbnail utama')
            ->assertSee('Foto pendukung 1')
            ->assertSee('Fitur utama')
            ->assertSee('<h2>Fitur utama</h2>', false)
            ->assertSee('aria-label="Navigasi utama"', false)
            ->assertSee('data-slider-next', false)
            ->assertSee('Lihat Website');
    }

    public function test_showcase_rich_text_is_sanitized_before_rendering(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $showcases = config('site-content.showcases');
        $showcases['items'][0]['details'] = '<script>alert("bad")</script><h2>Bagian aman</h2><a href="javascript:alert(1)" onclick="alert(1)">Link buruk</a>';

        $this->actingAs($admin)
            ->put('/admin/content/showcases', ['content' => $showcases])
            ->assertRedirect();

        $details = SiteContent::query()->where('section', 'showcases')->firstOrFail()->content['items'][0]['details'];
        $this->assertStringNotContainsString('<script', $details);
        $this->assertStringNotContainsString('javascript:', $details);
        $this->assertStringNotContainsString('onclick', $details);

        $this->get('/project/sistem-sekolah-digital')
            ->assertOk()
            ->assertSee('<h2>Bagian aman</h2>', false)
            ->assertDontSee('alert("bad")', false)
            ->assertDontSee('javascript:', false);
    }

    public function test_showcase_website_url_must_use_http_or_https(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $showcases = config('site-content.showcases');
        $showcases['items'][0]['website_url'] = 'javascript:alert(1)';

        $this->actingAs($admin)
            ->put('/admin/content/showcases', ['content' => $showcases])
            ->assertSessionHasErrors('content.items.0.website_url');
    }
}
