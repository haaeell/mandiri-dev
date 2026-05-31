@extends('admin.layout')
@section('title', 'Artikel SEO')
@section('heading', 'Artikel SEO')
@section('subheading', 'Kelola artikel untuk memperkuat halaman organik dan sitemap.')
@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
@endpush
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" defer></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js" defer></script>
@endpush
@section('content')
    <section class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
        <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="m-0 text-lg font-extrabold">Daftar Artikel</h2>
                <p class="mt-1 text-[13px] text-slate-500">Artikel publish otomatis masuk sitemap.</p>
            </div>
            <a class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-3 text-[13px] font-black text-white hover:bg-blue-700" href="{{ route('admin.articles.create') }}"><i class="size-4" data-lucide="plus"></i>Tulis Artikel</a>
        </div>

        @if (session('status'))
            <div class="mb-4 rounded-xl bg-green-100 p-3 text-xs font-extrabold text-green-800">{{ session('status') }}</div>
        @endif

        <div class="overflow-x-auto">
            <table id="articlesTable" class="display w-full text-sm">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Gambar</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Publish</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                        <tr>
                            <td>
                                <div class="font-extrabold text-slate-900">{{ $article->title }}</div>
                                <div class="mt-1 max-w-xl text-xs text-slate-500">{{ $article->excerpt }}</div>
                            </td>
                            <td>
                                @if ($article->image)
                                    <img class="h-14 w-24 rounded-xl object-cover" src="{{ str_starts_with($article->image, 'http') ? $article->image : asset('storage/'.$article->image) }}" alt="">
                                @else
                                    <span class="text-xs text-slate-400">-</span>
                                @endif
                            </td>
                            <td><span class="rounded-full bg-blue-50 px-2.5 py-1 text-[11px] font-black text-blue-700">{{ $article->category }}</span></td>
                            <td><span class="rounded-full px-2.5 py-1 text-[11px] font-black {{ $article->is_published ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-500' }}">{{ $article->is_published ? 'Publish' : 'Draft' }}</span></td>
                            <td>{{ $article->published_at?->format('d M Y H:i') }}</td>
                            <td>
                                <div class="flex flex-wrap gap-2">
                                    <a class="inline-flex items-center gap-1.5 rounded-xl bg-slate-100 px-3 py-2 text-xs font-black text-slate-700" href="{{ route('articles.show', $article) }}" target="_blank"><i class="size-4" data-lucide="external-link"></i>Lihat</a>
                                    <a class="inline-flex items-center gap-1.5 rounded-xl bg-blue-50 px-3 py-2 text-xs font-black text-blue-700" href="{{ route('admin.articles.edit', $article) }}"><i class="size-4" data-lucide="pen-line"></i>Edit</a>
                                    <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Hapus artikel ini?')">
                                        @csrf @method('DELETE')
                                        <button class="inline-flex items-center gap-1.5 rounded-xl bg-red-50 px-3 py-2 text-xs font-black text-red-600" type="submit"><i class="size-4" data-lucide="trash-2"></i>Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
