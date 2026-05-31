@extends('admin.layout')
@section('title', 'Kelola Konten')
@section('heading', 'Kelola Konten Landing Page')
@section('subheading', 'Pilih bagian dari daftar atau klik tombol edit langsung pada preview.')
@section('content')
<div class="grid h-[calc(100vh-106px)] grid-cols-[minmax(360px,440px)_minmax(0,1fr)] gap-5 max-lg:h-auto max-lg:grid-cols-1">
    <section class="overflow-y-auto rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
        <div class="mb-4 flex items-center justify-between gap-3"><div><h2 class="m-0 text-lg font-extrabold">Bagian Halaman</h2><p class="mt-1 text-[13px] text-slate-500">Pilih konten yang ingin diperbarui.</p></div><i class="size-5 text-blue-600" data-lucide="panel-left"></i></div>
        <div class="grid gap-2">
            @foreach ($sections as $key => [$label, $icon])
                <a class="flex items-center gap-3 rounded-2xl border border-slate-200 p-3 transition hover:translate-x-1 hover:border-blue-200 hover:bg-blue-50" href="{{ route('admin.content.edit', $key) }}"><i class="size-5 text-blue-600" data-lucide="{{ $icon }}"></i><span class="grid flex-1"><b class="text-[13px]">{{ $label }}</b><small class="mt-0.5 text-[11px] text-slate-500">Edit isi bagian landing page</small></span><i class="size-4" data-lucide="chevron-right"></i></a>
            @endforeach
        </div>
    </section>
    @include('admin.content.preview')
</div>
@endsection
