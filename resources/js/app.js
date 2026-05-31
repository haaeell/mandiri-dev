import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const addClasses = (selector, classes) => {
        document.querySelectorAll(selector).forEach((element) => element.classList.add(...classes));
    };

    addClasses('.container', ['mx-auto', 'w-[min(960px,calc(100%_-_32px))]']);
    addClasses('.row.justify-content-center', ['flex', 'justify-center']);
    addClasses('.col-md-8', ['w-full', 'max-w-3xl']);
    addClasses('.col-md-6', ['w-full']);
    addClasses('.card', ['overflow-hidden', 'rounded-2xl', 'border', 'border-slate-200', 'bg-white', 'shadow-sm']);
    addClasses('.card-header', ['border-b', 'border-slate-200', 'px-5', 'py-4', 'font-extrabold']);
    addClasses('.card-body', ['p-5']);
    addClasses('.row.mb-3', ['mb-4', 'grid', 'gap-2', 'md:grid-cols-[180px_1fr]', 'md:items-center']);
    addClasses('.row.mb-0', ['mt-5', 'grid', 'gap-2', 'md:grid-cols-[180px_1fr]']);
    addClasses('.col-form-label', ['text-sm', 'font-bold', 'text-slate-700', 'md:text-right']);
    addClasses('.form-control', ['w-full', 'rounded-xl', 'border', 'border-slate-200', 'bg-white', 'px-3', 'py-2.5', 'outline-none', 'focus:border-blue-400', 'focus:ring-4', 'focus:ring-blue-100']);
    addClasses('.form-check', ['flex', 'items-center', 'gap-2']);
    addClasses('.form-check-input', ['size-4']);
    addClasses('.form-check-label', ['text-sm', 'font-bold', 'text-slate-700']);
    addClasses('.invalid-feedback', ['mt-1', 'block', 'text-sm', 'font-bold', 'text-red-600']);
    addClasses('.btn.btn-primary', ['inline-flex', 'items-center', 'justify-center', 'rounded-xl', 'bg-blue-600', 'px-4', 'py-2.5', 'text-sm', 'font-extrabold', 'text-white', 'hover:bg-blue-700']);
    addClasses('.btn.btn-link', ['inline-flex', 'items-center', 'text-sm', 'font-bold', 'text-blue-600', 'hover:text-blue-700']);

    let pendingChatUrl = '';
    const chatLinks = document.querySelectorAll('a[href*="wa.me"], a[href*="api.whatsapp.com"]');
    if (chatLinks.length) {
        const modal = document.createElement('div');
        modal.className = 'fixed inset-x-3 top-20 z-50 hidden sm:inset-x-auto sm:right-5 sm:top-24 sm:w-[420px]';
        modal.innerHTML = `
            <form class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-2xl shadow-slate-950/20 dark:border-white/10 dark:bg-slate-950" data-chat-form>
                <div class="bg-slate-950 p-5 text-white dark:bg-blue-950">
                    <div class="flex items-center gap-3">
                        <div class="grid size-11 place-items-center rounded-2xl bg-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a4 4 0 0 1-4 4H7l-4 4V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"/></svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <b>Mandiri Dev Assistant</b>
                            <p class="m-0 text-xs text-slate-300">Bukan AI otomatis. Pesan akan diteruskan ke WhatsApp admin.</p>
                        </div>
                        <button type="button" class="grid size-9 place-items-center rounded-full bg-white/10 text-white transition hover:bg-white/20" data-chat-close aria-label="Tutup chat">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                        </button>
                    </div>
                </div>
                <div class="grid gap-3 p-5">
                    <div class="max-w-[88%] rounded-2xl rounded-tl-md bg-slate-100 px-4 py-3 text-sm leading-relaxed text-slate-700 dark:bg-white/10 dark:text-slate-100">
                        Halo, boleh ceritakan singkat kebutuhan project-nya? Contoh: website company profile, sistem sekolah, dashboard, atau integrasi AI.
                    </div>
                    <label class="grid gap-2">
                        <span class="text-xs font-black uppercase tracking-[0.2em] text-slate-400">Balasan Anda</span>
                        <textarea class="min-h-28 resize-none rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-400 focus:ring-4 focus:ring-blue-100 dark:border-white/10 dark:bg-slate-900 dark:text-white dark:focus:ring-blue-500/20" data-chat-message placeholder="Saya ingin konsultasi tentang..." required></textarea>
                    </label>
                    <div class="flex flex-col gap-2 sm:flex-row">
                        <button type="button" class="rounded-2xl border border-slate-200 px-4 py-3 text-sm font-black text-slate-600 transition hover:bg-slate-50 dark:border-white/10 dark:text-slate-200 dark:hover:bg-white/10" data-chat-close>Nanti dulu</button>
                        <button type="submit" class="flex-1 rounded-2xl bg-green-500 px-4 py-3 text-sm font-black text-white shadow-lg shadow-green-500/20 transition hover:-translate-y-0.5 hover:bg-green-600">
                            Kirim ke WhatsApp
                        </button>
                    </div>
                </div>
            </form>
        `;
        document.body.appendChild(modal);
        const messageInput = modal.querySelector('[data-chat-message]');

        const closeModal = () => {
            modal.classList.add('hidden');
        };
        const openModal = (url) => {
            pendingChatUrl = url;
            modal.classList.remove('hidden');
            window.setTimeout(() => messageInput && messageInput.focus(), 50);
        };
        const buildChatUrl = () => {
            if (!pendingChatUrl) return '';
            const message = (messageInput && messageInput.value.trim()) || 'Halo Mandiri Dev, saya ingin konsultasi project digital.';
            try {
                const url = new URL(pendingChatUrl);
                url.searchParams.set('text', message);
                return url.toString();
            } catch (error) {
                return pendingChatUrl;
            }
        };

        chatLinks.forEach((link) => {
            link.addEventListener('click', (event) => {
                event.preventDefault();
                openModal(link.href);
            });
        });

        modal.querySelectorAll('[data-chat-close]').forEach((button) => {
            button.addEventListener('click', closeModal);
        });
        modal.querySelector('[data-chat-form]').addEventListener('submit', (event) => {
            event.preventDefault();
            const targetUrl = buildChatUrl();
            if (targetUrl) window.open(targetUrl, '_blank', 'noopener,noreferrer');
            closeModal();
        });
    }
});
