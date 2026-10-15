import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

// Hero slider
if (document.querySelector('.hero-swiper')) {
    new Swiper('.hero-swiper', {
        modules: [Navigation, Pagination, Autoplay],
        loop: true,
        autoplay: { delay: 5000, disableOnInteraction: false },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: { el: '.swiper-pagination', clickable: true },
    });
}

// Filter + pencarian
const cards = document.querySelectorAll('.card');
const tabs = document.querySelectorAll('.tab');
const search = document.getElementById('search');
const empty = document.getElementById('empty');

const initial = new URLSearchParams(window.location.search).get('kategori');
let filter = ['suv', 'sportcar', 'sedan'].includes(initial) ? initial : 'all';
let keyword = '';

function apply() {
    let visible = 0;

    cards.forEach((card) => {
        const okSegment = filter === 'all' || card.dataset.segment === filter;
        const okName = card.dataset.name.includes(keyword);
        const show = okSegment && okName;
        card.style.display = show ? '' : 'none';
        if (show) visible++;
    });

    tabs.forEach((t) => {
        const active = t.dataset.filter === filter;
        t.classList.toggle('border-red-600', active);
        t.classList.toggle('text-black', active);
        t.classList.toggle('border-transparent', !active);
        t.classList.toggle('text-neutral-500', !active);
    });

    if (empty) empty.classList.toggle('hidden', visible > 0);
}

tabs.forEach((t) =>
    t.addEventListener('click', () => {
        filter = t.dataset.filter;
        apply();
    })
);

if (search) {
    search.addEventListener('input', (e) => {
        keyword = e.target.value.toLowerCase().trim();
        apply();
    });
}

// Tombol "Explore Collections" langsung memfilter sesuai seri
document.querySelectorAll('[data-explore]').forEach((link) =>
    link.addEventListener('click', () => {
        filter = link.dataset.explore;
        apply();
    })
);

if (tabs.length) apply();

// Animasi muncul saat di-scroll
const revealEls = document.querySelectorAll('.reveal');
if (revealEls.length && 'IntersectionObserver' in window) {
    const io = new IntersectionObserver((entries) => {
        entries.forEach((e) => {
            if (e.isIntersecting) {
                e.target.classList.add('is-visible');
                io.unobserve(e.target);
            }
        });
    }, { threshold: 0.12 });
    revealEls.forEach((el) => io.observe(el));
} else {
    revealEls.forEach((el) => el.classList.add('is-visible'));
}

// Tombol kategori di halaman beranda: pindah tab lalu scroll ke koleksi
document.querySelectorAll('[data-explore]').forEach((link) =>
    link.addEventListener('click', () => {
        const target = document.querySelector('#inventory');
        if (target) target.scrollIntoView({ behavior: 'smooth' });
    })
);
