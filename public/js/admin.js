document.addEventListener('DOMContentLoaded', () => {
    const refreshIcons = () => window.lucide && window.lucide.createIcons();
    const addClasses = (selector, classes, scope = document) => {
        scope.querySelectorAll(selector).forEach((element) => element.classList.add(...classes));
    };
    const applyTailwindUtilities = (scope = document) => {
        addClasses('.form-intro', ['rounded-2xl', 'bg-blue-50', 'p-3'], scope);
        addClasses('.form-intro h2', ['m-0', 'text-lg', 'font-extrabold'], scope);
        addClasses('.form-intro p', ['mt-1', 'mb-0', 'text-[13px]', 'text-slate-500'], scope);
        addClasses('.content-form label', ['grid', 'gap-1.5', 'text-xs', 'font-black', 'text-slate-700'], scope);
        addClasses('.content-form label small', ['text-[11px]', 'font-semibold', 'text-slate-500'], scope);
        addClasses('.content-form input:not([type="checkbox"]), .content-form textarea', ['w-full', 'rounded-xl', 'border', 'border-slate-200', 'bg-white', 'px-3', 'py-2.5', 'text-slate-900', 'outline-none', 'focus:border-blue-400', 'focus:ring-4', 'focus:ring-blue-100'], scope);
        addClasses('.group-title', ['mb-0', 'mt-2', 'text-sm', 'font-extrabold'], scope);
        addClasses('.mini-grid, .field-row', ['grid', 'gap-2.5', 'sm:grid-cols-2'], scope);
        addClasses('.sub-card', ['grid', 'gap-2.5', 'rounded-2xl', 'border', 'border-slate-200', 'bg-slate-50', 'p-3'], scope);
        addClasses('.sub-card > b', ['text-xs', 'font-extrabold', 'text-blue-700'], scope);
        addClasses('.sub-card-head', ['flex', 'items-center', 'justify-between', 'gap-2'], scope);
        addClasses('.sub-card-head button', ['inline-flex', 'items-center', 'gap-1.5', 'rounded-lg', 'border', 'border-slate-200', 'bg-white', 'px-2.5', 'py-2', 'text-[11px]', 'font-black', 'text-slate-500', 'hover:border-red-200', 'hover:bg-red-50', 'hover:text-red-600'], scope);
        addClasses('.repeater-items', ['grid', 'gap-2.5'], scope);
        addClasses('.add-item', ['mt-2', 'inline-flex', 'w-full', 'items-center', 'justify-center', 'gap-1.5', 'rounded-lg', 'border', 'border-dashed', 'border-blue-300', 'bg-white', 'px-3', 'py-2.5', 'text-[11px]', 'font-black', 'text-blue-600', 'hover:bg-blue-50'], scope);
        addClasses('.admin-thumbnail', ['max-h-[150px]', 'w-full', 'rounded-xl', 'object-cover'], scope);
        addClasses('.gallery-admin-grid', ['my-3', 'grid', 'grid-cols-[repeat(auto-fit,minmax(120px,1fr))]', 'gap-2.5'], scope);
        addClasses('.gallery-admin-item', ['overflow-hidden', 'rounded-2xl', 'border', 'border-slate-200', 'bg-slate-50'], scope);
        addClasses('.gallery-admin-item img', ['block', 'h-[90px]', 'w-full', 'object-cover'], scope);
        addClasses('.gallery-admin-item span', ['flex', 'items-center', 'gap-1.5', 'p-2', 'text-[11px]', 'font-bold', 'text-slate-600'], scope);
        addClasses('.gallery-admin-item input[type="checkbox"]', ['size-4'], scope);
    };
    const initializeEditors = (scope = document) => {
        if (!window.jQuery || !window.jQuery.fn.summernote) return;
        window.jQuery(scope).find('.rich-editor').each(function () {
            const editor = window.jQuery(this);
            if (editor.next('.note-editor').length) return;
            editor.summernote({
                height: 300,
                placeholder: editor.data('placeholder') || 'Tulis konten yang rapi, jelas, dan SEO friendly...',
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
    const initializeDataTables = () => {
        if (!window.jQuery || !window.jQuery.fn.DataTable || !document.getElementById('articlesTable')) return;
        window.jQuery('#articlesTable').DataTable({
            pageLength: 10,
            order: [[4, 'desc']],
            language: {
                search: 'Cari:',
                lengthMenu: 'Tampilkan _MENU_ artikel',
                info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ artikel',
                infoEmpty: 'Belum ada artikel',
                zeroRecords: 'Artikel tidak ditemukan',
                paginate: {
                    first: 'Awal',
                    last: 'Akhir',
                    next: 'Berikutnya',
                    previous: 'Sebelumnya',
                },
            },
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
                applyTailwindUtilities(clone);
                initializeEditors(clone);
                refreshIcons();
            }
            if (remove && items.children.length > 1) {
                remove.closest('[data-repeater-item]').remove();
                reindex(repeater);
            }
        });
    });
    applyTailwindUtilities();
    initializeEditors();
    initializeDataTables();
    refreshIcons();
});
