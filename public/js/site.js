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
        themeButton.innerHTML = `<i data-lucide="${dark ? 'sun' : 'moon'}"></i><span>${dark ? 'Light' : 'Dark'}</span>`;
        window.lucide && window.lucide.createIcons();
    }
    localStorage.setItem('mandiri-theme', dark ? 'dark' : 'light');
};

if (themeButton) {
    setTheme(localStorage.getItem('mandiri-theme') === 'dark');
    themeButton.addEventListener('click', () => setTheme(!root.classList.contains('dark')));
}
if (menuButton && mobileMenu) {
    menuButton.addEventListener('click', () => mobileMenu.classList.toggle('show'));
    mobileMenu.querySelectorAll('a').forEach((link) => link.addEventListener('click', () => mobileMenu.classList.remove('show')));
}

const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => entry.isIntersecting && entry.target.classList.add('show'));
}, { threshold: 0.12 });
document.querySelectorAll('.reveal').forEach((element, index) => {
    element.style.setProperty('--delay', `${Math.min(index % 6, 5) * 70}ms`);
    observer.observe(element);
});

if (topButton) {
    topButton.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
}

const updateScroll = () => {
    const pageHeight = document.documentElement.scrollHeight - window.innerHeight;
    if (scrollProgress) scrollProgress.style.transform = `scaleX(${pageHeight ? window.scrollY / pageHeight : 0})`;
    if (topButton) topButton.classList.toggle('show', window.scrollY > 600);
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

const navLinks = document.querySelectorAll('.desktop-nav a');
const sections = [...navLinks].map((link) => document.querySelector(link.getAttribute('href'))).filter(Boolean);
const navObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        navLinks.forEach((link) => link.classList.toggle('active', link.getAttribute('href') === `#${entry.target.id}`));
    });
}, { rootMargin: '-35% 0px -55%' });
sections.forEach((section) => navObserver.observe(section));

window.addEventListener('DOMContentLoaded', () => window.lucide && window.lucide.createIcons());
