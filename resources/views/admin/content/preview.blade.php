<section class="preview-panel">
    <div class="preview-toolbar"><div><i data-lucide="monitor"></i><span>Preview Landing Page</span></div><a href="{{ route('home') }}" target="_blank"><i data-lucide="external-link"></i>Buka penuh</a></div>
    <iframe src="{{ route('home', ['admin_preview' => 1]) }}" title="Preview landing page"></iframe>
</section>
