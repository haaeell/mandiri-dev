const root = document.documentElement;
const themeButton = document.getElementById('themeButton');
const menuButton = document.getElementById('menuButton');
const mobileMenu = document.getElementById('mobileMenu');
const topButton = document.getElementById('topButton');
const scrollProgress = document.getElementById('scrollProgress');
const pointerGlow = document.getElementById('pointerGlow');
const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

const setTheme = (dark) => {
    root.classList.toggle('dark', dark);
    if (themeButton) {
        themeButton.innerHTML = `<i class="size-4" data-lucide="${dark ? 'sun' : 'moon'}"></i><span class="hidden sm:inline">${dark ? 'Light' : 'Dark'}</span>`;
        window.lucide && window.lucide.createIcons();
    }
    localStorage.setItem('mandiri-theme', dark ? 'dark' : 'light');
};

if (themeButton) {
    setTheme(localStorage.getItem('mandiri-theme') === 'dark');
    themeButton.addEventListener('click', () => setTheme(!root.classList.contains('dark')));
}
if (menuButton && mobileMenu) {
    const toggleMobileMenu = (open) => {
        mobileMenu.classList.toggle('hidden', !open);
        mobileMenu.classList.toggle('grid', open);
    };
    menuButton.addEventListener('click', () => toggleMobileMenu(mobileMenu.classList.contains('hidden')));
    mobileMenu.querySelectorAll('a').forEach((link) => link.addEventListener('click', () => toggleMobileMenu(false)));
}

const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        entry.target.classList.remove('translate-y-4', 'opacity-0');
        entry.target.classList.add('translate-y-0', 'opacity-100');
    });
}, { threshold: 0.12 });
document.querySelectorAll('.reveal').forEach((element, index) => {
    element.classList.add('translate-y-4', 'opacity-0', 'transition', 'duration-700');
    element.style.transitionDelay = `${Math.min(index % 6, 5) * 70}ms`;
    observer.observe(element);
});

if (topButton) {
    topButton.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
}

const updateScroll = () => {
    const pageHeight = document.documentElement.scrollHeight - window.innerHeight;
    if (scrollProgress) scrollProgress.style.transform = `scaleX(${pageHeight ? window.scrollY / pageHeight : 0})`;
    if (topButton) {
        topButton.classList.toggle('hidden', window.scrollY <= 600);
        topButton.classList.toggle('grid', window.scrollY > 600);
    }
};
window.addEventListener('scroll', updateScroll, { passive: true });
updateScroll();

if (!reduceMotion && pointerGlow) {
    window.addEventListener('pointermove', (event) => {
        pointerGlow.style.transform = `translate3d(${event.clientX - 180}px, ${event.clientY - 180}px, 0)`;
    }, { passive: true });
}

if (!reduceMotion && window.matchMedia('(pointer: fine)').matches) {
    document.querySelectorAll('.tilt-card').forEach((card) => {
        card.addEventListener('pointermove', (event) => {
            const box = card.getBoundingClientRect();
            const rotateX = ((event.clientY - box.top) / box.height - .5) * -6;
            const rotateY = ((event.clientX - box.left) / box.width - .5) * 6;
            card.style.transform = `perspective(900px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-4px)`;
        });
        card.addEventListener('pointerleave', () => card.style.transform = '');
    });

    document.querySelectorAll('.magnetic').forEach((button) => {
        button.addEventListener('pointermove', (event) => {
            const box = button.getBoundingClientRect();
            button.style.transform = `translate(${(event.clientX - box.left - box.width / 2) * .12}px, ${(event.clientY - box.top - box.height / 2) * .16}px)`;
        });
        button.addEventListener('pointerleave', () => button.style.transform = '');
    });
}

const navLinks = document.querySelectorAll('.desktop-nav a, [data-bottom-nav] a[href^="#"]');
const sections = [...navLinks].map((link) => document.querySelector(link.getAttribute('href'))).filter(Boolean);
const setActiveNav = (id) => {
    navLinks.forEach((link) => {
        const isActive = link.getAttribute('href') === `#${id}`;
        const isDesktop = link.closest('.desktop-nav');
        link.classList.toggle('active', isActive);
        if (isDesktop) {
            link.classList.toggle('bg-blue-50', isActive);
            link.classList.toggle('text-blue-600', isActive);
            link.classList.toggle('shadow-sm', isActive);
            link.classList.toggle('shadow-blue-500/10', isActive);
            link.classList.toggle('dark:bg-blue-500/15', isActive);
            link.classList.toggle('dark:text-blue-200', isActive);
        } else {
            link.classList.toggle('text-blue-600', isActive);
            link.classList.toggle('bg-blue-50', isActive);
            link.classList.toggle('dark:bg-blue-600/15', isActive);
        }
    });
};
const navObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        setActiveNav(entry.target.id);
    });
}, { rootMargin: '-35% 0px -55%' });
sections.forEach((section) => navObserver.observe(section));

const updateActiveNav = () => {
    let activeId = 'home';
    sections.forEach((section) => {
        const top = section.getBoundingClientRect().top;
        if (top <= 140) activeId = section.id;
    });
    setActiveNav(activeId);
};
window.addEventListener('scroll', updateActiveNav, { passive: true });
window.addEventListener('DOMContentLoaded', updateActiveNav);

window.addEventListener('DOMContentLoaded', () => window.lucide && window.lucide.createIcons());
