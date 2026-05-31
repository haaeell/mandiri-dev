<section class="grid grid-rows-[48px_1fr] overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm max-lg:h-[680px] max-sm:h-[560px]">
    <div class="flex items-center justify-between gap-3 border-b border-slate-200 px-4 text-xs font-black text-slate-600"><div class="flex items-center gap-2"><i class="size-4" data-lucide="monitor"></i><span>Preview Landing Page</span></div><a class="flex items-center gap-2 text-blue-600" href="{{ route('home') }}" target="_blank"><i class="size-4" data-lucide="external-link"></i>Buka penuh</a></div>
    <iframe class="h-full w-full border-0" src="{{ route('home', ['admin_preview' => 1]) }}" title="Preview landing page"></iframe>
</section>
