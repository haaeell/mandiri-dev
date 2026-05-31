<div class="form-intro"><h2>Hero Utama</h2><p>Bagian pertama yang dilihat pengunjung.</p></div>
<label>Teks kecil di atas judul<input name="content[eyebrow]" value="{{ $content['eyebrow'] }}" required></label>
<label>Judul utama<input name="content[title]" value="{{ $content['title'] }}" required></label>
<label>Teks sorotan<input name="content[highlight]" value="{{ $content['highlight'] }}" required></label>
<label>Deskripsi<textarea name="content[description]" rows="4" required>{{ $content['description'] }}</textarea></label>
<h3 class="group-title">Angka Ringkas</h3>
<div class="mini-grid">
@foreach ($content['stats'] as $index => $stat)
    <div class="sub-card"><b>Statistik {{ $loop->iteration }}</b><label>Nilai<input name="content[stats][{{ $index }}][value]" value="{{ $stat['value'] }}" required></label><label>Label<input name="content[stats][{{ $index }}][label]" value="{{ $stat['label'] }}" required></label></div>
@endforeach
</div>
