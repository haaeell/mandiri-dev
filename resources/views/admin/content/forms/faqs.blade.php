<div class="form-intro"><h2>FAQ</h2><p>Jawab pertanyaan yang sering diajukan pengunjung.</p></div>
<label>Judul bagian<input name="content[heading]" value="{{ $content['heading'] }}" required></label>
<h3 class="group-title">Pertanyaan</h3>
<div data-repeater><div class="repeater-items" data-repeater-items>
@foreach ($content['items'] as $index => $item)
    <div class="sub-card" data-repeater-item><div class="sub-card-head"><b>FAQ {{ $loop->iteration }}</b><button type="button" data-remove><i data-lucide="trash-2"></i>Hapus</button></div><label>Pertanyaan<input name="content[items][{{ $index }}][question]" value="{{ $item['question'] }}" required></label><label>Jawaban<textarea name="content[items][{{ $index }}][answer]" rows="4" required>{{ $item['answer'] }}</textarea></label></div>
@endforeach
</div><button class="add-item" type="button" data-add><i data-lucide="plus"></i>Tambah FAQ</button></div>
