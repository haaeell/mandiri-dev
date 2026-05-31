@if ($adminPreview)
    <a class="absolute right-5 top-4 z-10 rounded-full bg-slate-950 px-3 py-2 text-xs font-black text-white shadow-xl shadow-slate-900/25 transition hover:-translate-y-0.5 hover:bg-blue-600" href="{{ route('admin.content.edit', $section) }}" target="_parent">Edit bagian ini</a>
@endif
