<?php

$siteUrl = rtrim(env('SEO_SITE_URL', 'https://mandiridev.my.id'), '/');
$description = 'Mandiri Dev adalah software house untuk pembuatan website profesional, aplikasi web custom, sistem sekolah, dashboard bisnis, integrasi AI, dan sistem manajemen digital.';

return [
    'site_url' => $siteUrl,
    'whatsapp_url' => 'https://wa.me/'.env('SEO_WHATSAPP_NUMBER', '6281234567890').'?text='.rawurlencode('Halo Mandiri Dev, saya ingin konsultasi project digital'),
    'pages' => [
        'home' => [
            'title' => 'Mandiri Dev - Software House & Digital Development',
            'description' => $description,
            'canonical' => $siteUrl.'/',
            'image' => $siteUrl.'/mandiridevpng.png',
        ],
    ],
    'sitemap' => [
        [
            'url' => $siteUrl.'/',
            'changefreq' => 'weekly',
            'priority' => '1.0',
        ],
    ],
];
