<?php

return [
    'seo' => [
        'title' => 'Mandiri Dev - Software House & Digital Development',
        'description' => 'Mandiri Dev adalah software house untuk pembuatan website profesional, aplikasi web custom, sistem sekolah, dashboard bisnis, integrasi AI, dan sistem manajemen digital.',
        'whatsapp_number' => env('SEO_WHATSAPP_NUMBER', '6281234567890'),
    ],
    'hero' => [
        'eyebrow' => 'Software House | Web Development | AI Integration',
        'title' => 'Build sistem digital yang',
        'highlight' => 'rapi, cepat, dan siap scale.',
        'description' => 'Mandiri Dev membantu bisnis, sekolah, dan organisasi membangun website, dashboard, sistem manajemen, dan integrasi AI dari kebutuhan nyata sampai siap online.',
        'stats' => [
            ['value' => '35+', 'label' => 'Project'],
            ['value' => '98%', 'label' => 'Responsive'],
            ['value' => '24/7', 'label' => 'Support'],
            ['value' => '6+', 'label' => 'Layanan'],
        ],
    ],
    'services' => [
        'heading' => 'Solusi digital lengkap untuk bisnis, sekolah, dan organisasi.',
        'description' => 'Dari landing page premium sampai sistem web custom yang bisa digunakan harian.',
        'items' => [
            ['code' => 'WEB', 'title' => 'Website & Landing Page', 'description' => 'Company profile, portfolio, katalog, landing page promosi, dan halaman bisnis dengan tampilan modern.'],
            ['code' => 'APP', 'title' => 'Custom Web App', 'description' => 'Dashboard, manajemen data, role user, laporan, export PDF/Excel, dan sistem operasional sesuai alur kerja.'],
            ['code' => 'EDU', 'title' => 'School System', 'description' => 'Absensi QR, CBT online, data siswa, pembagian kelas, pengumuman, nilai, dan laporan akademik.'],
            ['code' => 'AI', 'title' => 'AI Integration', 'description' => 'Chatbot, asisten virtual, ringkasan otomatis, analisis teks, automasi respon, dan integrasi API AI.'],
            ['code' => 'KPI', 'title' => 'Dashboard Bisnis', 'description' => 'Monitoring KPI, laporan visual, data pelanggan, transaksi, inventaris, administrasi, dan analitik.'],
            ['code' => 'OPS', 'title' => 'Deploy & Maintenance', 'description' => 'Setup hosting, domain, SSL, database, email, bug fixing, backup, optimasi, dan support berkala.'],
        ],
    ],
    'showcases' => [
        'heading' => 'Contoh sistem yang bisa dibuat Mandiri Dev.',
        'items' => [
            ['slug' => 'sistem-sekolah-digital', 'category' => 'Education Platform', 'title' => 'Sistem Sekolah Digital', 'description' => 'Absensi QR, CBT online, pembagian kelas, pengumuman, nilai, dan laporan akademik.', 'details' => 'Platform sekolah digital yang menyatukan pengelolaan data siswa, absensi QR, CBT online, pembagian kelas, pengumuman, nilai, dan laporan akademik dalam satu dashboard.', 'tags' => 'Absensi QR, CBT, Laporan', 'thumbnail' => '', 'gallery' => [], 'website_url' => ''],
            ['slug' => 'dashboard-manajemen', 'category' => 'Business Dashboard', 'title' => 'Dashboard Manajemen', 'description' => 'Monitoring data, KPI, laporan otomatis, grafik, role akses, dan export dokumen.', 'details' => 'Dashboard operasional untuk memantau KPI, menyusun laporan otomatis, menampilkan grafik bisnis, mengatur hak akses tim, dan mengekspor dokumen.', 'tags' => 'Dashboard, KPI, Export', 'thumbnail' => '', 'gallery' => [], 'website_url' => ''],
            ['slug' => 'ai-chat-automation', 'category' => 'AI Product', 'title' => 'AI Chat & Automation', 'description' => 'Chatbot khusus, AI konseling, ringkasan data, automasi respon, dan integrasi API.', 'details' => 'Solusi berbasis AI untuk chatbot khusus, asisten virtual, ringkasan data, automasi respon, dan integrasi API sesuai alur bisnis.', 'tags' => 'Chat AI, Automation, API', 'thumbnail' => '', 'gallery' => [], 'website_url' => ''],
        ],
    ],
    'processes' => [
        'heading' => 'Dari ide sampai sistem siap digunakan.',
        'items' => [
            ['number' => '01', 'title' => 'Diskusi', 'description' => 'Memahami kebutuhan, fitur, target pengguna, dan tujuan project.'],
            ['number' => '02', 'title' => 'Perencanaan', 'description' => 'Menyusun halaman, database, alur fitur, role akses, dan tampilan sistem.'],
            ['number' => '03', 'title' => 'Development', 'description' => 'Membangun sistem responsive, rapi, cepat, dan mudah dikembangkan.'],
            ['number' => '04', 'title' => 'Deploy', 'description' => 'Upload ke hosting, setup domain, SSL, database, testing, dan maintenance.'],
        ],
    ],
    'faqs' => [
        'heading' => 'Pertanyaan yang sering ditanyakan.',
        'items' => [
            ['question' => 'Apa itu Mandiri Dev?', 'answer' => 'Mandiri Dev adalah software house yang membantu membuat website profesional, aplikasi web custom, sistem sekolah, dashboard bisnis, integrasi AI, dan sistem manajemen digital.'],
            ['question' => 'Apakah bisa membuat aplikasi web sesuai kebutuhan?', 'answer' => 'Bisa. Sistem dapat dibuat custom mengikuti alur kerja, role user, fitur laporan, database, notifikasi, API, dan kebutuhan operasional.'],
            ['question' => 'Apakah website SEO friendly?', 'answer' => 'Ya. Struktur halaman dibuat rapi dengan heading jelas, meta description, canonical, OpenGraph, schema markup, gambar teroptimasi, dan performa ringan.'],
            ['question' => 'Apakah bisa membuat sistem sekolah digital?', 'answer' => 'Bisa. Sistem sekolah dapat berisi absensi QR, CBT online, data siswa, pengumuman, pembagian kelas, nilai, dan laporan akademik.'],
            ['question' => 'Apakah bisa integrasi AI?', 'answer' => 'Bisa. Integrasi AI dapat digunakan untuk chatbot, asisten virtual, ringkasan otomatis, analisis teks, automasi respon, dan integrasi API.'],
            ['question' => 'Apakah dibantu upload ke hosting?', 'answer' => 'Ya. Bisa dibantu sampai deployment, setup domain, SSL, database, email, konfigurasi hosting, testing, dan maintenance awal.'],
        ],
    ],
    'cta' => [
        'eyebrow' => 'Punya ide project?',
        'heading' => 'Mari ubah ide menjadi solusi digital yang profesional.',
        'button' => 'Chat WhatsApp',
    ],
];
