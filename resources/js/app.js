document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.getElementById('menuToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    const themeToggle = document.getElementById('themeToggle');
    const html = document.documentElement;

    if (menuToggle) {
        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }

    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            html.classList.toggle('dark');
        });
    }

    if (window.AOS) {
        AOS.init();
    }

    const testimonies = document.querySelectorAll('#testimonyCarousel .testimony');
    if (testimonies.length) {
        let index = 0;
        setInterval(() => {
            testimonies[index].classList.add('hidden');
            index = (index + 1) % testimonies.length;
            testimonies[index].classList.remove('hidden');
        }, 5000);
    }
});
