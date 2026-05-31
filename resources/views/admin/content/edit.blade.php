@extends('admin.layout')
@section('title', 'Edit '.$sectionMeta[0])
@section('heading', 'Edit '.$sectionMeta[0])
@section('subheading', 'Simpan perubahan lalu preview akan diperbarui otomatis.')
@if ($section === 'showcases')
    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css">
    @endpush
    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js" defer></script>
    @endpush
@endif
@section('content')
<div class="grid h-[calc(100vh-106px)] grid-cols-[minmax(360px,440px)_minmax(0,1fr)] gap-5 max-lg:h-auto max-lg:grid-cols-1">
    <section class="overflow-y-auto rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
        <div class="mb-4 flex items-center justify-between gap-3"><a class="inline-flex items-center gap-2 text-[13px] font-black text-blue-600" href="{{ route('admin.content.index') }}"><i class="size-4" data-lucide="arrow-left"></i>Kembali</a><i class="size-5 text-blue-600" data-lucide="{{ $sectionMeta[1] }}"></i></div>
        @if (session('status'))<div class="mb-3 flex items-center gap-2 rounded-xl bg-green-100 p-3 text-xs font-extrabold text-green-800"><i class="size-4" data-lucide="circle-check"></i>{{ session('status') }}</div>@endif
        <form class="content-form grid gap-3" action="{{ route('admin.content.update', $section) }}" method="POST" enctype="multipart/form-data">@csrf @method('PUT')
            @include('admin.content.forms.'.$section)
            <button class="sticky bottom-0 mt-1 inline-flex items-center justify-center gap-2 rounded-xl border-0 bg-blue-600 px-4 py-3 text-[13px] font-black text-white shadow-[0_-8px_16px_rgba(255,255,255,.92)] hover:bg-blue-700" type="submit"><i class="size-4" data-lucide="save"></i>Simpan Perubahan</button>
        </form>
    </section>
    @include('admin.content.preview')
</div>
@endsection
