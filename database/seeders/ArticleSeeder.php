<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Cara Memilih Software House untuk Sistem Web Custom',
                'slug' => 'cara-memilih-software-house-sistem-web-custom',
                'category' => 'Web Development',
                'excerpt' => 'Panduan praktis memilih partner development yang paham bisnis, teknis, keamanan, SEO, dan kebutuhan jangka panjang.',
                'image' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1200&q=80',
                'content' => '<h2>Mulai dari masalah bisnis</h2><p>Software house yang baik tidak langsung bicara teknologi. Mereka memahami alur kerja, target pengguna, data penting, dan risiko operasional.</p><h3>Hal yang perlu dicek</h3><ul><li>Portofolio sistem serupa</li><li>Dokumentasi fitur dan scope kerja</li><li>Rencana maintenance setelah rilis</li><li>Struktur SEO dan performa halaman</li></ul>',
                'meta_title' => 'Cara Memilih Software House untuk Sistem Web Custom',
                'meta_description' => 'Panduan memilih software house untuk website, dashboard, sistem sekolah, dan aplikasi web custom yang SEO friendly.',
                'published_at' => now()->subDays(7),
            ],
            [
                'title' => 'Kenapa Website Bisnis Perlu SEO Teknis sejak Awal',
                'slug' => 'kenapa-website-bisnis-perlu-seo-teknis',
                'category' => 'SEO',
                'excerpt' => 'SEO teknis membantu website lebih mudah dibaca mesin pencari, lebih cepat, dan lebih siap dikembangkan menjadi aset akuisisi.',
                'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=1200&q=80',
                'content' => '<h2>SEO bukan hanya artikel</h2><p>Struktur heading, schema markup, sitemap, performa, metadata, internal link, dan mobile UX ikut menentukan kualitas website.</p><blockquote>Website yang rapi sejak awal lebih hemat biaya optimasi di masa depan.</blockquote>',
                'meta_title' => 'Kenapa Website Bisnis Perlu SEO Teknis sejak Awal',
                'meta_description' => 'Alasan website bisnis perlu SEO teknis, sitemap, schema, performa, dan struktur konten sejak fase development.',
                'published_at' => now()->subDays(4),
            ],
            [
                'title' => 'Checklist Sistem Sekolah Digital yang Siap Dipakai Harian',
                'slug' => 'checklist-sistem-sekolah-digital',
                'category' => 'School System',
                'excerpt' => 'Fitur penting untuk sistem sekolah digital: absensi QR, CBT, nilai, pengumuman, laporan, role user, dan keamanan data.',
                'image' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=1200&q=80',
                'content' => '<h2>Fitur inti</h2><p>Sistem sekolah perlu sederhana untuk operator, jelas untuk guru, dan stabil untuk digunakan setiap hari.</p><ul><li>Absensi QR</li><li>CBT online</li><li>Manajemen siswa dan kelas</li><li>Laporan akademik</li><li>Hak akses pengguna</li></ul>',
                'meta_title' => 'Checklist Sistem Sekolah Digital yang Siap Dipakai Harian',
                'meta_description' => 'Checklist fitur sistem sekolah digital untuk absensi QR, CBT online, nilai, laporan, dan manajemen data siswa.',
                'published_at' => now()->subDay(),
            ],
        ];

        foreach ($articles as $article) {
            Article::query()->updateOrCreate(
                ['slug' => $article['slug']],
                ['is_published' => true, ...$article],
            );
        }
    }
}
