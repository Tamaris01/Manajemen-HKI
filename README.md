# Aplikasi Laravel 10

## Pengantar
Selamat datang di **Sistem Informasi Manajemen HKI** berbasis web yang dibangun dengan Laravel 10. Aplikasi ini dirancang untuk mengelola dan mengatur informasi Hak Kekayaan Intelektual dengan mudah dan efisien.

## Fitur Utama
- **Manajemen Pengguna:** Tambah, edit, dan hapus pengguna dengan berbagai peran dan hak akses.
- **Manajemen Data HKI:** Kelola data HKI dengan fitur pencarian, pengurutan, dan filter.
- **Laporan dan Statistik:** Lihat laporan dan statistik yang detail tentang HKI yang terdaftar.

## Prasyarat
Sebelum memulai, pastikan Anda telah menginstal perangkat lunak berikut:
- PHP >= 8.1
- Composer
- MySQL atau database lain yang didukung
- Node.js & npm (untuk pengelolaan aset frontend)

## Instalasi
Ikuti langkah-langkah berikut untuk mengatur dan menjalankan aplikasi di lingkungan pengembangan Anda:

1. **Clone Repository**
    ```bash
    git clone https://github.com/username/repo.git
    cd repo
    ```

2. **Instal Dependencies**
    ```bash
    composer install
    npm install
    npm run dev
    ```

3. **Salin File Environment**
    ```bash
    cp .env.example .env
    ```

4. **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

5. **Konfigurasi Variabel Lingkungan**
    Buka file `.env` dan sesuaikan pengaturan database dan variabel lingkungan lainnya sesuai kebutuhan Anda:
    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=SENTRAHKI2
    DB_USERNAME=username
    DB_PASSWORD=password
    ```

6. **Migrasi dan Seed Database**
    Jalankan perintah berikut untuk migrasi dan mengisi database dengan data awal:
    ```bash
    php artisan migrate --seed
    ```

7. **Menjalankan Server Pengembangan**
    Mulai server pengembangan dengan perintah:
    ```bash
    php artisan serve
    ```

    Akses aplikasi di [http://localhost:8000](http://localhost:8000).

## Struktur Direktori
Beberapa direktori penting dalam aplikasi ini:
- `app/`: Berisi file-file inti aplikasi.
- `config/`: Berisi file konfigurasi.
- `database/`: Berisi migrasi dan seeder.
- `public/`: Berisi aset publik seperti gambar, CSS, dan JavaScript.
- `resources/`: Berisi view, file bahasa, dan aset mentah.
- `routes/`: Berisi definisi rute untuk aplikasi.
- `tests/`: Berisi tes unit dan fitur.

## Kontribusi
Jika Anda ingin berkontribusi, silakan fork repository ini dan kirimkan pull request. Kami menyambut semua jenis kontribusi, baik itu perbaikan bug, fitur baru, atau peningkatan dokumentasi.

## Kontak
Jika Anda memiliki pertanyaan atau masalah, jangan ragu untuk menghubungi saya di [tamarissilitonga@gmail.com).

Selamat coding! 🚀
