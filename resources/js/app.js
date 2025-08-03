document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.getElementById('menuToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    const themeToggle = document.getElementById('themeToggle');
    const html = document.documentElement;
    const storedTheme = localStorage.getItem('theme');
    if (storedTheme === 'dark') {
        html.classList.add('dark');
    }

    if (menuToggle) {
        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }

    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            html.classList.toggle('dark');
            localStorage.setItem('theme', html.classList.contains('dark') ? 'dark' : 'light');
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
