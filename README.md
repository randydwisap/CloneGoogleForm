# Form Builder - Klon Google Forms dengan Laravel & Filament

[![Made with Laravel](https://img.shields.io/badge/Made%20with-Laravel-FF2D20.svg?style=for-the-badge&logo=laravel)](https://laravel.com)
[![Powered by Filament](https://img.shields.io/badge/Powered%20by-Filament-F59E0B.svg?style=for-the-badge)](https://filamentphp.com)

Aplikasi web yang memungkinkan pengguna untuk mendaftar, membuat formulir kustom yang fleksibel seperti Google Forms, membagikannya melalui link unik, dan melihat tanggapan yang masuk.


---

## ✨ Fitur Utama

- **Otentikasi Pengguna**: Sistem registrasi dan login yang aman.
- **Multi-User**: Setiap pengguna dapat mengelola formulirnya sendiri secara terpisah.
- **Form Builder Dinamis**: Panel admin yang dibuat dengan Filament untuk membuat dan mengedit formulir dengan mudah.
- **Beragam Tipe Pertanyaan**: Dukungan untuk input teks, textarea, pilihan ganda (select), radio button, dan checkbox.
- **URL Unik**: Setiap formulir memiliki URL publik yang unik (`slug`) untuk dibagikan.
- **Manajemen Tanggapan**: Lihat semua tanggapan yang masuk untuk setiap formulir melalui panel admin.
- **Desain Responsif**: Halaman formulir publik yang dirancang dengan baik dan dapat diakses dari berbagai perangkat.

---

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 11
- **Admin Panel**: Filament 3
- **Frontend**: Blade, Tailwind CSS (via CDN)
- **Database**: MySQL
- **Deployment**: Hostinger (Shared Hosting)

---

## 🚀 Instalasi Lokal

Berikut adalah cara untuk menjalankan proyek ini di lingkungan lokal Anda.

1.  **Clone repository ini:**
    ```bash
    git clone https://github.com/randydwisap/CloneGoogleForm
    cd NAMA_REPO_ANDA
    ```

2.  **Install dependencies Composer:**
    ```bash
    composer install
    ```

3.  **Salin dan konfigurasi file environment:**
    ```bash
    cp .env.example .env
    ```
    Buka file `.env` dan sesuaikan pengaturan database (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

4.  **Generate application key:**
    ```bash
    php artisan key:generate
    ```

5.  **Jalankan migrasi database:**
    Perintah ini akan membuat semua tabel yang diperlukan di database Anda.
    ```bash
    php artisan migrate
    ```

6.  **Buat user pertama Anda:**
    Anda bisa membuat user melalui halaman registrasi (`/admin/register`) atau menggunakan `tinker`:
    ```bash
    php artisan tinker
    ```
    Lalu jalankan di dalam tinker:
    ```php
    \App\Models\User::create([
        'name' => 'Admin',
        'email' => 'admin@example.com',
        'password' => bcrypt('password'),
    ]);
    ```

7.  **(Opsional) Buat symbolic link untuk storage:**
    ```bash
    php artisan storage:link
    ```

8.  **Jalankan server pengembangan:**
    ```bash
    php artisan serve
    ```
    Aplikasi Anda sekarang bisa diakses di `http://127.0.0.1:
