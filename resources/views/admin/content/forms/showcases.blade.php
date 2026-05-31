<div class="form-intro">
    <h2>Showcase</h2>
    <p>Tampilkan contoh sistem yang dapat dikerjakan.</p>
</div>
<label>Judul bagian<input name="content[heading]" value="{{ $content['heading'] }}" required></label>
<h3 class="group-title">Daftar Showcase</h3>
<div data-repeater>
    <div class="repeater-items" data-repeater-items>
        @foreach ($content['items'] as $index => $item)
            <div class="sub-card" data-repeater-item>
                <div class="sub-card-head"><b>Showcase {{ $loop->iteration }}</b><button type="button" data-remove><i
                            data-lucide="trash-2"></i>Hapus</button></div>
                @if ($item['thumbnail'] ?? false)
                    <img class="admin-thumbnail"
                        src="{{ str_starts_with($item['thumbnail'], 'http') ? $item['thumbnail'] : asset('storage/' . $item['thumbnail']) }}"
                        alt="">
                @endif
                <label>Thumbnail utama<small>Upload gambar utama project maksimal 3 MB. Gambar ini selalu tampil paling atas
                        di halaman detail.</small><input type="file" name="thumbnail_files[{{ $index }}]"
                        accept="image/*"></label>
                <label>Kategori<input name="content[items][{{ $index }}][category]" value="{{ $item['category'] }}"
                        required></label>
                <label>Judul<input name="content[items][{{ $index }}][title]" value="{{ $item['title'] }}" required></label>
                <label>Slug URL<small>Contoh: sistem-sekolah-digital. Kosongkan untuk membuat otomatis dari
                        judul.</small><input name="content[items][{{ $index }}][slug]"
                        value="{{ $item['slug'] ?? '' }}"></label>
                <label>Deskripsi singkat<textarea name="content[items][{{ $index }}][description]" rows="3"
                        required>{{ $item['description'] }}</textarea></label>
                <label>Penjelasan detail<small>Gunakan heading, daftar, bold, dan link agar halaman detail mudah
                        dibaca.</small><textarea class="rich-editor" name="content[items][{{ $index }}][details]" rows="8"
                        required>{{ $item['details'] ?? $item['description'] }}</textarea></label>
                <label>Link website<small>Opsional. Masukkan URL lengkap, contoh: https://example.com.</small><input
                        type="url" name="content[items][{{ $index }}][website_url]"
                        value="{{ $item['website_url'] ?? '' }}"></label>
                <label>Tag<small>Pisahkan setiap tag menggunakan koma.</small><input
                        name="content[items][{{ $index }}][tags]" value="{{ $item['tags'] }}" required></label>
                <label>Foto pendukung<small>Boleh upload lebih dari satu gambar sekaligus, jumlahnya bebas sesuai kebutuhan admin. Semua foto akan masuk galeri setelah thumbnail utama.</small><input type="file" name="gallery_files[{{ $index }}][]" accept="image/*"
                        multiple></label>
                @if (!empty($item['gallery']))
                    <div class="gallery-admin-grid" data-gallery-admin>
                        @foreach ($item['gallery'] as $image)
                            <label class="gallery-admin-item">
                                <img src="{{ str_starts_with($image, 'http') ? $image : asset('storage/' . $image) }}" alt="">
                                <span><input type="checkbox" name="remove_gallery[{{ $index }}][]" value="{{ $image }}"> Hapus
                                    foto</span>
                                <input type="hidden" name="content[items][{{ $index }}][gallery][]" value="{{ $image }}">
                            </label>
                        @endforeach
                    </div>
                @endif
                <input type="hidden" name="content[items][{{ $index }}][thumbnail]" value="{{ $item['thumbnail'] ?? '' }}">
            </div>
        @endforeach
    </div><button class="add-item" type="button" data-add><i data-lucide="plus"></i>Tambah Showcase</button>
</div>
