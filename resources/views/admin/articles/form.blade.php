@extends('admin.layout')
@section('title', $article->exists ? 'Edit Artikel' : 'Tulis Artikel')
@section('heading', $article->exists ? 'Edit Artikel' : 'Tulis Artikel')
@section('subheading', 'Artikel publish akan tampil di halaman artikel dan sitemap.')
@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css">
@endpush
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js" defer></script>
@endpush
@section('content')
    <section class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
        <div class="mb-4 flex items-center justify-between gap-3">
            <a class="inline-flex items-center gap-2 text-[13px] font-black text-blue-600" href="{{ route('admin.articles.index') }}"><i class="size-4" data-lucide="arrow-left"></i>Kembali</a>
            @if ($article->exists)
                <a class="inline-flex items-center gap-2 text-[13px] font-black text-slate-600" href="{{ route('articles.show', $article) }}" target="_blank"><i class="size-4" data-lucide="external-link"></i>Lihat artikel</a>
            @endif
        </div>

        @if (session('status'))
            <div class="mb-4 rounded-xl bg-green-100 p-3 text-xs font-extrabold text-green-800">{{ session('status') }}</div>
        @endif

        <form class="content-form grid gap-3" action="{{ $article->exists ? route('admin.articles.update', $article) : route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($article->exists) @method('PUT') @endif

            <div class="grid gap-3 lg:grid-cols-[1fr_280px]">
                <div class="grid gap-3">
                    <label class="grid gap-1.5 text-xs font-black text-slate-700">Judul Artikel
                        <input class="w-full rounded-xl border border-slate-200 px-3 py-2.5 outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100" name="title" value="{{ old('title', $article->title) }}" required>
                        @error('title')<span class="text-xs text-red-600">{{ $message }}</span>@enderror
                    </label>
                    <label class="grid gap-1.5 text-xs font-black text-slate-700">Ringkasan
                        <textarea class="w-full rounded-xl border border-slate-200 px-3 py-2.5 outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100" name="excerpt" rows="3" required>{{ old('excerpt', $article->excerpt) }}</textarea>
                        @error('excerpt')<span class="text-xs text-red-600">{{ $message }}</span>@enderror
                    </label>
                    <div class="grid gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-3 md:grid-cols-[180px_1fr]">
                        <div class="overflow-hidden rounded-2xl bg-slate-200">
                            @php
                                $articleImage = old('image', $article->image);
                                $articleImageUrl = $articleImage ? (str_starts_with($articleImage, 'http') ? $articleImage : asset('storage/'.$articleImage)) : '';
                            @endphp
                            @if ($articleImageUrl)
                                <img class="h-36 w-full object-cover" src="{{ $articleImageUrl }}" alt="">
                            @else
                                <div class="grid h-36 place-items-center text-xs font-black text-slate-500">Belum ada gambar</div>
                            @endif
                        </div>
                        <div class="grid gap-3">
                            <label class="grid gap-1.5 text-xs font-black text-slate-700">Upload Gambar Artikel
                                <input class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100" type="file" name="image_file" accept="image/*">
                                <small class="text-[11px] font-semibold text-slate-500">Rekomendasi rasio 16:9, maksimal 3 MB.</small>
                            </label>
                            <label class="grid gap-1.5 text-xs font-black text-slate-700">Atau URL Gambar
                                <input class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100" name="image" value="{{ old('image', $article->image) }}" placeholder="https://...">
                            </label>
                        </div>
                    </div>
                    <label class="grid gap-1.5 text-xs font-black text-slate-700">Konten Artikel
                        <textarea class="rich-editor w-full rounded-xl border border-slate-200 px-3 py-2.5 leading-7 outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100" name="content" rows="14" required>{{ old('content', $article->content) }}</textarea>
                        <small class="text-[11px] font-semibold text-slate-500">Boleh pakai tag aman seperti h2, h3, p, ul, ol, li, strong, blockquote, dan link https.</small>
                        @error('content')<span class="text-xs text-red-600">{{ $message }}</span>@enderror
                    </label>
                </div>

                <aside class="grid content-start gap-3 rounded-2xl bg-slate-50 p-3">
                    <label class="grid gap-1.5 text-xs font-black text-slate-700">Kategori
                        <input class="w-full rounded-xl border border-slate-200 px-3 py-2.5 outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100" name="category" value="{{ old('category', $article->category) }}" required>
                    </label>
                    <label class="grid gap-1.5 text-xs font-black text-slate-700">Slug
                        <input class="w-full rounded-xl border border-slate-200 px-3 py-2.5 outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100" name="slug" value="{{ old('slug', $article->slug) }}" placeholder="otomatis dari judul">
                    </label>
                    <label class="grid gap-1.5 text-xs font-black text-slate-700">Meta Title
                        <input class="w-full rounded-xl border border-slate-200 px-3 py-2.5 outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100" name="meta_title" value="{{ old('meta_title', $article->meta_title) }}">
                    </label>
                    <label class="grid gap-1.5 text-xs font-black text-slate-700">Meta Description
                        <textarea class="w-full rounded-xl border border-slate-200 px-3 py-2.5 outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100" name="meta_description" rows="3">{{ old('meta_description', $article->meta_description) }}</textarea>
                    </label>
                    <label class="grid gap-1.5 text-xs font-black text-slate-700">Tanggal Publish
                        <input class="w-full rounded-xl border border-slate-200 px-3 py-2.5 outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100" type="datetime-local" name="published_at" value="{{ old('published_at', optional($article->published_at)->format('Y-m-d\TH:i')) }}">
                    </label>
                    <label class="flex items-center gap-2 text-xs font-black text-slate-700">
                        <input type="checkbox" name="is_published" value="1" class="size-4" @checked(old('is_published', $article->is_published))>
                        Publish artikel
                    </label>
                </aside>
            </div>

            <button class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-3 text-[13px] font-black text-white hover:bg-blue-700" type="submit"><i class="size-4" data-lucide="save"></i>Simpan Artikel</button>
        </form>
    </section>
@endsection
