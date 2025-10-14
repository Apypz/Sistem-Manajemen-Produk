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
