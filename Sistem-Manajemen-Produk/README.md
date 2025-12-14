<<<<<<< HEAD
<h1 align="center">SISTEM MANAJEMEN PRODUK COFFEE SHOP (COFOURIA)</h1>

<p align="center">
  <a href="#"><img src="https://img.shields.io/badge/Status-Development-blue" alt="Development Status"></a>
  <a href="#"><img src="https://img.shields.io/badge/Built%20with-Laravel-red" alt="Framework"></a>
  <a href="#"><img src="https://img.shields.io/badge/Database-MySQL-orange" alt="Database"></a>
  <a href="LICENSE.md"><img src="https://img.shields.io/badge/License-MIT-green" alt="License"></a>
</p>

---

## Tentang Proyek ☕

Sistem Manajemen Produk ini dirancang untuk mempermudah pengelolaan data produk, stok, kategori, dan brand pada sebuah coffee shop.  
Tujuan utama proyek ini adalah menyediakan *platform terpusat* untuk memastikan *konsistensi, akurasi, dan data produk yang up-to-date* serta meningkatkan efisiensi operasional.

Proyek ini dibangun untuk memenuhi kebutuhan bisnis tingkat tinggi, termasuk penyediaan dashboard produk, fungsionalitas CRUD untuk produk, kategori, dan brand, serta kemampuan menampilkan laporan stok dan riwayat pergerakan barang.

---

## Fitur Utama ✨

Berdasarkan Functional Requirements (FR) dan Use Case Diagram, sistem ini memiliki fungsionalitas inti berikut:

| Kebutuhan Fungsional (FR) | Deskripsi Fungsional | Stakeholder Terkait |
| :--- | :--- | :--- |
| *Manajemen Produk (CRUD)* | Memungkinkan *Admin Produk* untuk melakukan operasi Create, Read, Update, Delete (CRUD) pada data produk (nama, harga, deskripsi, gambar, kategori). | Admin Produk |
| *Manajemen Stok* | Mengelola data stok produk, termasuk melihat jumlah stok terkini dan riwayat pergerakan barang (masuk/keluar). | Admin Produk, Manajer |
| *Manajemen Kategori & Brand* | Memungkinkan *Admin Produk* melakukan operasi CRUD terhadap data kategori dan brand produk. | Admin Produk, Manajer |
| *Pelacakan Perubahan Data* | Mencatat dan menyimpan riwayat setiap perubahan data produk, mencakup informasi siapa yang mengubah, apa yang diubah, dan kapan. | Admin Produk, Manajer |
| *Dashboard & Laporan* | Menyediakan dashboard ringkasan data produk dan laporan relevan, seperti laporan stok dan laporan penjualan sesuai periode. | Manajer, Admin Produk |

---

## Komponen Teknis 💻

Proyek ini dikembangkan dengan mempertimbangkan Non Functional Requirements (NFR) dan menggunakan teknologi berikut:

| Kategori NFR | Spesifikasi Teknis |
| :--- | :--- |
| *Lingkungan Operasi* | Dapat berjalan pada web browser modern (Chrome, Firefox, Safari). |
| *Database* | Menggunakan *MySQL* untuk penyimpanan data (User, Produk, Stok, Kategori, Brand, History Log). |
| *Kinerja (Performance)* | Response time maksimal *3 detik* untuk semua operasi. Pembaruan stok atau data produk harus selesai dalam waktu kurang dari *1 detik*. |
| *Keamanan (Security)* | Semua akses harus melalui halaman login yang aman dengan otentikasi username dan password. Hanya pengguna dengan peran *Admin* yang memiliki hak untuk mengubah, menambah, atau menghapus data. |
| *Skalabilitas* | Sistem harus mampu menampung hingga *1.000 data produk* tanpa memengaruhi kinerja. |

---

## Struktur Pengguna (Aktor) 👥

Sistem ini mendukung dua peran utama:

1. **Admin Produk**
   - Memiliki hak akses penuh (full access).
   - Bertanggung jawab untuk input & update data produk.
   - Melakukan operasi CRUD pada produk, stok, kategori, dan brand.

2. **Manajer**
   - Memiliki hak akses terbatas untuk monitoring.
   - Dapat melihat laporan, dashboard, dan riwayat perubahan data.
   - Tidak dapat mengubah, menambah, atau menghapus data.

---

## Instalasi Lokal 🚀

### Persyaratan Sistem

Pastikan Anda telah menginstal:
- PHP (versi yang kompatibel dengan Laravel)
- Composer
- Database Server (MySQL)

### Langkah-langkah

1. **Clone Repositori**
   ```bash
   git clone [URL_REPOSITORI]
   cd [NAMA_FOLDER_PROYEK]
=======
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
>>>>>>> origin/master
