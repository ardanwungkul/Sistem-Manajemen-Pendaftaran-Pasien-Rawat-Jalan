# 🏥 Sistem Manajemen Pendaftaran Pasien Rawat Jalan

Aplikasi **Sistem Manajemen Pendaftaran Pasien Rawat Jalan** adalah aplikasi berbasis website yang dibangun menggunakan **Laravel** untuk membantu pengelolaan data pasien, pendaftaran kunjungan rawat jalan, dan administrasi pelayanan kesehatan secara terstruktur dan efisien.

---

## 📌 Fitur Utama

- Manajemen data pasien
- Pendaftaran pasien rawat jalan
- Manajemen poli dan dokter
- Pencatatan kunjungan pasien
- Autentikasi pengguna

---

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel
- **Frontend**: Blade / Vite
- **Database**: MySQL / PostgreSQL
- **Package Manager**: Composer & NPM

---

## ⚙️ Persyaratan Sistem

Pastikan perangkat Anda telah terinstall:

- PHP >= 8.1
- Composer
- Node.js & NPM
- Database (MySQL / PostgreSQL)
- Git

---

## 🚀 Cara Instalasi & Menjalankan Project

Ikuti langkah-langkah berikut untuk menjalankan project secara lokal:

### 1️⃣ Clone Repository

```bash
git clone https://github.com/ardanwungkul/Sistem-Manajemen-Pendaftaran-Pasien-Rawat-Jalan.git
cd Sistem-Manajemen-Pendaftaran-Pasien-Rawat-Jalan
```

### 2️⃣ Install Dependency Backend

```bash
composer install
```

### 3️⃣ Install Dependency Frontend

```bash
npm install
```

### 4️⃣ Konfigurasi Environment

Salin file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

Kemudian sesuaikan konfigurasi database di file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

### 5️⃣ Generate Application Key

```bash
php artisan key:generate
```

### 6️⃣ Migrasi dan Seeder Database

```bash
php artisan migrate
php artisan db:seed
```

### 7️⃣ Menjalankan Server

Jalankan backend Laravel:

```bash
php artisan serve
```

Jalankan frontend:

```bash
npm run dev
```

Aplikasi dapat diakses melalui:

```
http://127.0.0.1:8000
```

---

## 👤 Akun Default (Seeder)

Jika menggunakan seeder, gunakan akun berikut untuk login:

- **Email**: admin@gmail.com  
- **Password**: 12345678

---
