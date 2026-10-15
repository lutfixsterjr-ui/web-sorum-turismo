# TURISMO — Showroom Mobil Premium

Website jual beli mobil dengan tiga kategori: **Sportcar (GT3 RS)**, **SUV (Macan)**, dan **Sedan (Panamera)**.
Dibangun dengan Laravel, Tailwind CSS, Alpine.js, dan Swiper.

## Fitur
- Katalog mobil dengan filter kategori dan pencarian
- Halaman detail mobil beserta spesifikasi
- Keranjang belanja dan checkout (pesanan + struk cetak)
- Register, login, dan profil pengguna
- Admin panel untuk mengelola produk (tambah, ubah, hapus, unggah gambar)

## Cara Menjalankan
```bash
git clone <url-repo-ini>
cd web-sorum-turismo
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
npm run build
php artisan serve
```

Buka `http://127.0.0.1:8000`.

## Akun Admin (dari seeder)
- Email: `admin@turismo.test`
- Password: `password123`

Ganti password ini sebelum dipakai di luar komputer lokal.
