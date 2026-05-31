document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-project-slider]').forEach((slider) => {
        const slides = [...slider.querySelectorAll('[data-slide]')];
        const dots = [...slider.querySelectorAll('[data-slider-dot]')];
        if (slides.length < 2) return;

        let activeIndex = 0;
        let touchStart = 0;
        const show = (index) => {
            activeIndex = (index + slides.length) % slides.length;
            slides.forEach((slide, slideIndex) => slide.classList.toggle('active', slideIndex === activeIndex));
            dots.forEach((dot, dotIndex) => dot.classList.toggle('active', dotIndex === activeIndex));
        };

        slider.querySelector('[data-slider-prev]')?.addEventListener('click', () => show(activeIndex - 1));
        slider.querySelector('[data-slider-next]')?.addEventListener('click', () => show(activeIndex + 1));
        dots.forEach((dot) => dot.addEventListener('click', () => show(Number(dot.dataset.sliderDot))));
        slider.addEventListener('touchstart', (event) => touchStart = event.changedTouches[0].clientX, {passive: true});
        slider.addEventListener('touchend', (event) => {
            const distance = event.changedTouches[0].clientX - touchStart;
            if (Math.abs(distance) > 45) show(activeIndex + (distance < 0 ? 1 : -1));
        }, {passive: true});
    });
});
