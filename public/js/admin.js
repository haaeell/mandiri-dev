document.addEventListener('DOMContentLoaded', () => {
    const refreshIcons = () => window.lucide && window.lucide.createIcons();
    const initializeEditors = (scope = document) => {
        if (!window.jQuery || !window.jQuery.fn.summernote) return;
        window.jQuery(scope).find('.rich-editor').each(function () {
            const editor = window.jQuery(this);
            if (editor.next('.note-editor').length) return;
            editor.summernote({
                height: 250,
                placeholder: 'Jelaskan fitur, manfaat, dan alur project...',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview']],
                ],
            });
        });
    };
    const reindex = (repeater) => repeater.querySelectorAll('[data-repeater-item]').forEach((item, index) => {
        item.querySelectorAll('[name]').forEach((field) => {
            field.name = field.name
                .replace(/\[items]\[\d+]/, `[items][${index}]`)
                .replace(/thumbnail_files\[\d+]/, `thumbnail_files[${index}]`)
                .replace(/gallery_files\[\d+]/, `gallery_files[${index}]`)
                .replace(/remove_gallery\[\d+]/, `remove_gallery[${index}]`);
        });
        const title = item.querySelector('.sub-card-head b');
        if (title) title.textContent = `${title.textContent.replace(/\s+\d+$/, '')} ${index + 1}`;
    });

    document.querySelectorAll('[data-repeater]').forEach((repeater) => {
        const items = repeater.querySelector('[data-repeater-items]');
        repeater.addEventListener('click', (event) => {
            const add = event.target.closest('[data-add]');
            const remove = event.target.closest('[data-remove]');
            if (add) {
                const clone = items.lastElementChild.cloneNode(true);
                clone.querySelectorAll('.note-editor').forEach((editor) => editor.remove());
                clone.querySelectorAll('input, textarea').forEach((field) => field.value = '');
                clone.querySelector('.admin-thumbnail')?.remove();
                clone.querySelector('[data-gallery-admin]')?.remove();
                items.appendChild(clone);
                reindex(repeater);
                initializeEditors(clone);
                refreshIcons();
            }
            if (remove && items.children.length > 1) {
                remove.closest('[data-repeater-item]').remove();
                reindex(repeater);
            }
        });
    });
    initializeEditors();
    refreshIcons();
});
