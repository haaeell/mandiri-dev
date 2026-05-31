@extends('admin.layout')
@section('title', 'Kelola Konten')
@section('heading', 'Kelola Konten Landing Page')
@section('subheading', 'Pilih bagian dari daftar atau klik tombol edit langsung pada preview.')
@section('content')
<div class="workspace">
    <section class="editor-panel">
        <div class="panel-head"><div><h2>Bagian Halaman</h2><p>Pilih konten yang ingin diperbarui.</p></div><i data-lucide="panel-left"></i></div>
        <div class="section-list">
            @foreach ($sections as $key => [$label, $icon])
                <a href="{{ route('admin.content.edit', $key) }}"><i data-lucide="{{ $icon }}"></i><span><b>{{ $label }}</b><small>Edit isi bagian landing page</small></span><i data-lucide="chevron-right"></i></a>
            @endforeach
        </div>
    </section>
    @include('admin.content.preview')
</div>
@endsection
