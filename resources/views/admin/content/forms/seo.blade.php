<div class="form-intro"><h2>SEO & Kontak</h2><p>Atur informasi yang tampil di Google dan nomor WhatsApp tujuan.</p></div>
<label>Judul halaman<input name="content[title]" value="{{ old('content.title', $content['title']) }}" required></label>
<label>Deskripsi SEO<textarea name="content[description]" rows="4" required>{{ old('content.description', $content['description']) }}</textarea></label>
<label>Nomor WhatsApp<small>Gunakan format internasional tanpa simbol, contoh: 6281234567890.</small><input name="content[whatsapp_number]" value="{{ old('content.whatsapp_number', $content['whatsapp_number']) }}" required></label>
