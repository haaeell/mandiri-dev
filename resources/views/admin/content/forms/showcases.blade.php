<div class="form-intro showcase-intro">
    <div>
        <span class="eyebrow">
            <i class="fa-solid fa-layer-group"></i>
            Showcase Section
        </span>
        <h2>Showcase</h2>
        <p>Tampilkan contoh sistem yang dapat dikerjakan oleh Mandiri Dev.</p>
    </div>
</div>

<label class="modern-field">
    <span>Judul bagian</span>
    <input name="content[heading]" value="{{ $content['heading'] }}" required>
</label>

<div class="section-heading-row">
    <h3 class="group-title">
        <i class="fa-solid fa-briefcase"></i>
        Daftar Showcase
    </h3>
</div>

<div data-repeater>
    <div class="repeater-items showcase-repeater" data-repeater-items>
        @foreach ($content['items'] as $index => $item)
            <div class="sub-card showcase-admin-card" data-repeater-item>
                <div class="sub-card-head showcase-card-head">
                    <div>
                        <span class="card-badge">Project {{ $loop->iteration }}</span>
                        <b>{{ $item['title'] ?: 'Showcase Baru' }}</b>
                    </div>

                    <button class="btn-remove-modern" type="button" data-remove>
                        <i class="fa-solid fa-trash"></i>
                        Hapus
                    </button>
                </div>

                @if ($item['thumbnail'] ?? false)
                    <div class="admin-thumbnail-wrap">
                        <img class="admin-thumbnail"
                            src="{{ str_starts_with($item['thumbnail'], 'http') ? $item['thumbnail'] : asset('storage/' . $item['thumbnail']) }}"
                            alt="">
                    </div>
                @endif

                <div class="form-grid-2">
                    <label class="modern-field file-field">
                        <span>Thumbnail utama</span>
                        <small>Upload gambar utama project maksimal 3 MB.</small>
                        <input type="file" name="thumbnail_files[{{ $index }}]" accept="image/*">
                    </label>

                    <label class="modern-field">
                        <span>Kategori</span>
                        <input name="content[items][{{ $index }}][category]" value="{{ $item['category'] }}" required>
                    </label>

                    <label class="modern-field">
                        <span>Judul</span>
                        <input name="content[items][{{ $index }}][title]" value="{{ $item['title'] }}" required>
                    </label>

                    <label class="modern-field">
                        <span>Slug URL</span>
                        <small>Contoh: sistem-sekolah-digital.</small>
                        <input name="content[items][{{ $index }}][slug]" value="{{ $item['slug'] ?? '' }}">
                    </label>
                </div>

                <label class="modern-field">
                    <span>Deskripsi singkat</span>
                    <textarea name="content[items][{{ $index }}][description]" rows="3"
                        required>{{ $item['description'] }}</textarea>
                </label>

                <label class="modern-field">
                    <span>Penjelasan detail</span>
                    <small>Gunakan heading, daftar, bold, dan link agar halaman detail mudah dibaca.</small>
                    <textarea class="rich-editor" name="content[items][{{ $index }}][details]" rows="8"
                        required>{{ $item['details'] ?? $item['description'] }}</textarea>
                </label>

                <div class="form-grid-2">
                    <label class="modern-field">
                        <span>Link website</span>
                        <small>Opsional. Contoh: https://example.com</small>
                        <input type="url" name="content[items][{{ $index }}][website_url]"
                            value="{{ $item['website_url'] ?? '' }}">
                    </label>

                    <label class="modern-field">
                        <span>Tag</span>
                        <small>Pisahkan setiap tag menggunakan koma.</small>
                        <input name="content[items][{{ $index }}][tags]" value="{{ $item['tags'] }}" required>
                    </label>
                </div>

                <label class="modern-field file-field">
                    <span>Foto pendukung</span>
                    <small>Pilih beberapa gambar sekaligus. Gambar akan tampil sebagai slider setelah thumbnail
                        utama.</small>
                    <input type="file" name="gallery_files[{{ $index }}][]" accept="image/*" multiple>
                </label>

                @if (!empty($item['gallery']))
                    <div class="gallery-admin-grid" data-gallery-admin>
                        @foreach ($item['gallery'] as $image)
                            <label class="gallery-admin-item">
                                <img src="{{ str_starts_with($image, 'http') ? $image : asset('storage/' . $image) }}" alt="">

                                <span>
                                    <input type="checkbox" name="remove_gallery[{{ $index }}][]" value="{{ $image }}">
                                    Hapus foto
                                </span>

                                <input type="hidden" name="content[items][{{ $index }}][gallery][]" value="{{ $image }}">
                            </label>
                        @endforeach
                    </div>
                @endif

                <input type="hidden" name="content[items][{{ $index }}][thumbnail]" value="{{ $item['thumbnail'] ?? '' }}">
            </div>
        @endforeach
    </div>

    <button class="add-item add-showcase-btn" type="button" data-add>
        <i class="fa-solid fa-plus"></i>
        Tambah Showcase
    </button>
</div>