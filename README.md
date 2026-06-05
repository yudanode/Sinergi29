# 🕌 Website Dinamis LDII Sumedang

Website resmi organisasi LDII Sumedang untuk mengelola portofolio, berita, dan event secara dinamis.

---

## 🛠️ Tech Stack

- **Backend:** Laravel 12 + PHP 8.2+
- **Frontend:** Blade + Tailwind CSS
- **Auth:** Laravel Breeze
- **Database:** MySQL
- **Role Management:** Spatie Laravel Permission

---

## ⚙️ Cara Install di Lokal (Laragon)

### 1. Prasyarat
Pastikan sudah terinstall:
- [Laragon](https://laragon.online) (PHP 8.2+, MySQL)
- [Composer](https://getcomposer.org)
- [Node.js v18+](https://nodejs.org)
- [Git](https://git-scm.com)

### 2. Clone Repository
Buka terminal di folder `C:\laragon\www\` lalu jalankan:
```bash
git clone https://github.com/username/ldii-sumedang.git
cd ldii-sumedang
```

### 3. Install Dependencies
```bash
composer install
npm install
```

### 4. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

Lalu buka file `.env` dan sesuaikan:
```env
DB_DATABASE=ldii_sumedang
DB_USERNAME=root
DB_PASSWORD=          # kosongkan jika Laragon default
```

### 5. Buat Database
Buka **phpMyAdmin** di Laragon → buat database baru bernama `ldii_sumedang`

### 6. Migrasi & Seeder
```bash
php artisan migrate
php artisan db:seed
```

### 7. Build Asset & Storage Link
```bash
npm run build
php artisan storage:link
```

### 8. Jalankan Aplikasi
Buka browser → akses `http://ldii-sumedang.test`

---

## 👤 Akun Default (Setelah Seeder)

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@ldiisumedang.or.id | Admin@1234 |

> ⚠️ Segera ganti password setelah login pertama!

---

## 📁 Struktur Role & Akses

| Fitur | Admin | Editor | User |
|-------|-------|--------|------|
| CRUD Berita | ✅ | ✅ | ❌ |
| CRUD Event | ✅ | ✅ | ❌ |
| CRUD Portfolio | ✅ | ✅ | ❌ |
| CRUD Galeri | ✅ | ✅ | ❌ |
| Moderasi Komentar | ✅ | ✅ | ❌ |
| Kelola Feedback | ✅ | ✅ | ❌ |
| Kelola Akun/User | ✅ | ❌ | ❌ |
| Tambah Editor | ✅ | ❌ | ❌ |
| Like & Komentar | ✅ | ✅ | ✅ |

---

## 🌿 Alur Git (Branch Strategy)

```
main          → kode stabil / production
develop       → branch pengembangan utama
feature/xxx   → fitur baru (dari develop)
fix/xxx       → perbaikan bug
```

### Contoh alur kerja:
```bash
# Mulai fitur baru
git checkout develop
git checkout -b feature/crud-berita

# Setelah selesai
git add .
git commit -m "feat: tambah CRUD berita"
git push origin feature/crud-berita

# Buat Pull Request ke develop di GitHub
```

---

## 📝 Konvensi Commit Message

```
feat: tambah fitur baru
fix: perbaiki bug
style: perubahan tampilan/CSS
refactor: refaktor kode
docs: update dokumentasi
chore: update dependency/config
```

---

## 🚀 Deploy ke Shared Hosting

1. Jalankan `npm run build` di lokal
2. Upload semua file **kecuali** `/node_modules` dan `/vendor`
3. Upload `vendor` lewat `composer install --no-dev` di hosting (jika ada terminal)
4. Set document root ke folder `/public`
5. Rename `.env.example` → `.env` dan isi sesuai konfigurasi hosting
6. Jalankan di terminal hosting:
```bash
php artisan migrate --force
php artisan db:seed --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan storage:link
```

---

## 📄 Lisensi

Project ini dikembangkan untuk keperluan internal organisasi **LDII Sumedang**.