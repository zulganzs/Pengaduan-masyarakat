# Panduan Instalasi Project Pengaduan Masyarakat

Halo! Ini adalah panduan lengkap untuk menjalankan project ini di komputer kamu. Karena kamu baru belajar, ikuti langkah-langkah di bawah ini pelan-pelan ya.

## 1. Persiapan Software (Wajib Install Dulu)

Sebelum mulai, pastikan di komputer kamu sudah terinstall aplikasi-aplikasi ini:

1.  **XAMPP** (untuk Database MySQL): [Download di sini](https://www.apachefriends.org/download.html).
    *   *Setelah install, buka XAMPP Control Panel dan klik "Start" pada bagian **Apache** dan **MySQL**.*
2.  **Composer** (untuk install library PHP): [Download di sini](https://getcomposer.org/download/).
    *   *Install seperti biasa (next-next saja).*
3.  **Node.js** (untuk fitur frontend): [Download di sini](https://nodejs.org/).
    *   *Pilih versi LTS (Recommended).*
4.  **Git** (opsional, tapi bagus punya): [Download di sini](https://git-scm.com/downloads).

---

## 2. Cara Install Project

Buka folder project ini. Lalu klik kanan di area kosong dan pilih **"Open in Terminal"** (atau jika pakai Git Bash, pilih "Git Bash Here"). Kalau tidak ada, buka CommandPrompt (CMD) dan arahkan ke folder ini.

Jalankan perintah-perintah berikut satu per satu di terminal:

### Langkah 1: Install Library PHP
Ketik perintah ini dan tekan Enter. Tunggu sampai selesai (agak lama tergantung internet).
```bash
composer install
```

### Langkah 2: Install Library Frontend
Ketik perintah ini:
```bash
npm install
```

### Langkah 3: Buat File Konfigurasi
Kita perlu membuat file `.env`. Caranya copy dari contoh yang sudah ada:
```bash
cp .env.example .env
```
*(Kalau di Windows CMD biasa perintah `cp` error, bisa copy manual file `.env.example`, lalu paste dan rename file hasil copy-nya menjadi `.env`)*

### Langkah 4: Generate Kunci Aplikasi
Perintah ini wajib dijalankan sekali saja:
```bash
php artisan key:generate
```

### Langkah 5: Setup Database
1.  Buka file `.env` yang baru saja kamu buat (bisa pakai Notepad atau VS Code).
2.  Cari bagian ini:
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=pengaduan_masyarakat
    DB_USERNAME=root
    DB_PASSWORD=
    ```
3.  Pastikan `DB_DATABASE` namanya `pengaduan_masyarakat` (atau nama lain terserah kamu).
4.  Buka browser, ketik `localhost/phpmyadmin`.
5.  Klik **"New"** di menu kiri, lalu buat database baru dengan nama yang sama persis dengan di file `.env` tadi (contoh: `pengaduan_masyarakat`).

### Langkah 6: Isi Database (Migrate & Seeding)
Ketik perintah ini untuk membuat tabel otomatis dan mengisi data user admin:
```bash
php artisan migrate --seed
```
*Jika sukses, akan muncul tulisan "Migration table created successfully" dan "Seeding Database".*

---

## 3. Cara Menjalankan Aplikasi

Sekarang project sudah siap! Untuk menjalankannya, kamu butuh **dua terminal** (buka satu terminal lagi di folder yang sama).

**Terminal 1 (untuk menjalankan server PHP):**
```bash
php artisan serve
```
*Nanti akan muncul alamat web, biasanya: `http://127.0.0.1:8000`*

**Terminal 2 (untuk menjalankan frontend/aset):**
```bash
npm run dev
```

Sekarang buka browser (Chrome/Edge) dan buka alamat: **http://127.0.0.1:8000**

---

## 4. Akun Login (Demo)

Gunakan akun ini untuk mencoba login:

### Login sebagai Admin (Petugas)
*   **Email**: `admin@example.com`
*   **Password**: `password`

### Login sebagai Masyarakat
*   **Email**: `user@example.com`
*   **Password**: `password`

---

## Masalah yang Sering Muncul

*   **Error "Vite manifest not found"**: Jangan lupa jalankan `npm run dev` di terminal terpisah.
*   **Error Database**: Pastikan XAMPP (MySQL) sudah di-Start dan nama database di `.env` sama dengan yang dibuat di phpMyAdmin.
*   **Terminal macet?**: Jangan tutup terminal yang sedang jalan (`php artisan serve` atau `npm run dev`). Kalau mau berhenti, tekan `Ctrl + C`.

Selamat mencoba coding! Semangat! 🚀
