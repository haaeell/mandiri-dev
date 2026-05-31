<div class="form-intro"><h2>Layanan</h2><p>Jelaskan layanan utama yang tersedia.</p></div>
<label>Judul bagian<input name="content[heading]" value="{{ $content['heading'] }}" required></label>
<label>Deskripsi bagian<textarea name="content[description]" rows="3" required>{{ $content['description'] }}</textarea></label>
<h3 class="group-title">Daftar Layanan</h3>
<div data-repeater><div class="repeater-items" data-repeater-items>
@foreach ($content['items'] as $index => $item)
    <div class="sub-card" data-repeater-item><div class="sub-card-head"><b>Layanan {{ $loop->iteration }}</b><button type="button" data-remove><i data-lucide="trash-2"></i>Hapus</button></div><div class="field-row"><label>Kode<input name="content[items][{{ $index }}][code]" value="{{ $item['code'] }}" required></label><label>Nama layanan<input name="content[items][{{ $index }}][title]" value="{{ $item['title'] }}" required></label></div><label>Deskripsi<textarea name="content[items][{{ $index }}][description]" rows="3" required>{{ $item['description'] }}</textarea></label></div>
@endforeach
</div><button class="add-item" type="button" data-add><i data-lucide="plus"></i>Tambah Layanan</button></div>
