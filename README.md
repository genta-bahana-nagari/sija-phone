# 📱 SIJA Phone - Laravel Project

Sebuah aplikasi web katalog smartphone berbasis Laravel yang memungkinkan pengguna untuk:

- Menemukan rekomendasi smartphone berdasarkan preferensi.
- Melihat produk berdasarkan merek (brand).
- Mencari dan memfilter smartphone berdasarkan status stok dan brand.
- Menjelajahi produk dengan tampilan modern, responsif, dan ringan.


## 🔧 Fitur Utama

- ✅ **Rekomendasi berdasarkan preferensi pengguna**
- 🔍 **Pencarian dan filter dinamis**
- 🏷️ **Filter berdasarkan brand dan status stok**
- 🔄 **Load more button** untuk melihat lebih banyak produk
- 📸 **Tampilan UI modern dan mobile-friendly**
- 📦 **Status ketersediaan dan jumlah stok**
- 🚀 **Optimisasi performa gambar (lazy loading)**


## Teknologi yang Digunakan
- [Laravel](https://laravel.com/) 12
- [Tailwind via CDN](https://tailwindcss.com/)
- [Filament](https://filamentphp.com/) 3
- [Filament Shield](https://github.com/ryangjchandler/filament-shield)

## Instalasi
1. Clone repositori:

```bash
git clone -b main --single-branch https://github.com/genta-bahana-nagari/phone_store.git
cd phone_store
```
Clone yang branch  main --> sudah teruji.

2. Install dependensi:
```bash
composer install
```

3. Copy file environment dan konfigurasi:
```bash
cp .env.example .env
php artisan key:generate
```

4. Install dan konfigurasi Filament Shield serta user super_admin:
```bash
php artisan make:filament-user
php artisan shield:generate
php artisan shield:super-admin --panel
```

5. Jalankan server lokal:
```bash
php artisan serve
```

## Role dan Hak Akses

Filament Shield digunakan untuk mengelola peran seperti:

- Super Admin: Akses penuh ke seluruh modul sekaligus sebagai penjual
- Customer: Sebagai pembeli, mengakses frontend.

Gunakan perintah berikut untuk mengelola peran dan izin:
```bash
php artisan shield:generate
php artisan shield:super-admin
```

## Contributing
Kontribusi selalu diterima! Boleh fork dan pull request, atau lebih aman git clone dulu, kembangkan di local :).

## 👤 Author
- **Genta Bahana Nagari** – [LinkedIn](https://www.linkedin.com/in/genta-bahana-nagari/) | [GitHub](https://github.com/genta-bahana-nagari)

## 🌟 Show Your Support
Kalo suka kasih ⭐ ya di GitHub!

## 📜 License
Sudah **MIT License** nih.
