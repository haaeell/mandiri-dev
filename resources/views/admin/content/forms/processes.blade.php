<div class="form-intro"><h2>Proses Kerja</h2><p>Jelaskan tahapan kerja kepada calon klien.</p></div>
<label>Judul bagian<input name="content[heading]" value="{{ $content['heading'] }}" required></label>
<h3 class="group-title">Tahapan</h3>
<div data-repeater><div class="repeater-items" data-repeater-items>
@foreach ($content['items'] as $index => $item)
    <div class="sub-card" data-repeater-item><div class="sub-card-head"><b>Tahap {{ $loop->iteration }}</b><button type="button" data-remove><i data-lucide="trash-2"></i>Hapus</button></div><div class="field-row"><label>Nomor<input name="content[items][{{ $index }}][number]" value="{{ $item['number'] }}" required></label><label>Judul<input name="content[items][{{ $index }}][title]" value="{{ $item['title'] }}" required></label></div><label>Deskripsi<textarea name="content[items][{{ $index }}][description]" rows="3" required>{{ $item['description'] }}</textarea></label></div>
@endforeach
</div><button class="add-item" type="button" data-add><i data-lucide="plus"></i>Tambah Tahap</button></div>
