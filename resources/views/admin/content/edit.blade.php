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
<div class="workspace">
    <section class="editor-panel">
        <div class="panel-head"><a class="back-link" href="{{ route('admin.content.index') }}"><i data-lucide="arrow-left"></i>Kembali</a><i data-lucide="{{ $sectionMeta[1] }}"></i></div>
        @if (session('status'))<div class="success"><i data-lucide="circle-check"></i>{{ session('status') }}</div>@endif
        <form class="content-form" action="{{ route('admin.content.update', $section) }}" method="POST" enctype="multipart/form-data">@csrf @method('PUT')
            @include('admin.content.forms.'.$section)
            <button class="primary-action sticky-action" type="submit"><i data-lucide="save"></i>Simpan Perubahan</button>
        </form>
    </section>
    @include('admin.content.preview')
</div>
@endsection
