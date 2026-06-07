# 📚 Naratia Backend API

Backend API untuk aplikasi **Naratia**, sebuah platform berbasis mobile yang memungkinkan pengguna untuk membuat, membaca, dan mengelola cerita.

Backend ini dibangun menggunakan **Laravel** dan berfungsi sebagai penyedia data (API) untuk aplikasi frontend (Flutter).

---

## 🚀 Fitur Utama yang Berhasil Dikembangkan

* 🔐 Autentikasi (Register & Login)
* 👤 Manajemen Profil Pengguna
* ✍️ CRUD Cerita (Create, Read, Update, Delete)

---

## 🛠️ Teknologi yang Digunakan

* **Laravel** (PHP Framework)
* **MySQL** (Database)
* **Laravel Sanctum** (Authentication)
* **Postman** (API Testing)

---

## 📂 Struktur Project (Simplified)

```
app
├── Http
│   ├── Controllers
│   │   ├── Api
│   │   │   ├── AuthController.php
│   │   │   └── UserController.php
│   │   ├── BookmarkController.php
│   │   ├── CommentController.php
│   │   ├── ContentController.php
│   │   ├── Controller.php
│   │   ├── FollowController.php
│   │   ├── LikeController.php
│   │   └── StoryController.php
├── Models
│   ├── Bookmark.php
│   ├── Comment.php
│   ├── Content.php
│   ├── Follow.php
│   ├── Like.php
│   ├── Story.php
│   └── User.php


routes
├── api.php
├── channels.php
├── console.php
└── web.php

```

---

# ✅ Alur Lengkap Setup Backend Naratia (via XAMPP)

## 🧩 1. Siapkan XAMPP

* Nyalakan:

  * ✅ Apache
  * ✅ MySQL

* Buka:

  ```
  http://localhost/phpmyadmin
  ```

---

## 🗄️ 2. Buat Database Kosong

Di phpMyAdmin:

* Klik **New**
* Nama database:

  ```
  naratia-backend-app
  ```
* Klik **Create**

❗ Jangan buat tabel manual — Laravel yang akan isi

---

## 📥 3. Clone Repository

```bash
git clone https://github.com/talitha404/naratia-backend-app.git
cd naratia-backend-app
```

---

## 📦 4. Install Dependency

```bash
composer install
```

---

## ⚙️ 5. Setup Environment (INI PENTING ⚠️)

```bash
cp .env.example .env
php artisan key:generate
```

---

## 🛠️ 6. Konfigurasi Database

Buka `.env`, ubah:

```env
DB_DATABASE=naratia-mobile-db
DB_USERNAME=root
DB_PASSWORD=
```

(XAMPP default biasanya kosong passwordnya)

---

## 🧱 7. Migrasi Database

```bash
php artisan migrate
```

Kalau error / mau reset:

```bash
php artisan migrate:fresh
```

✔️ Setelah ini tabel otomatis keisi

---

## 🚀 8. Jalankan Server

```bash
php artisan serve
```

Akan muncul:

```
http://127.0.0.1:8000
```

---

## 📱 9. Integrasi ke Flutter

Di Flutter:

* Base URL:

```
http://10.0.2.2:8000/api
```

(karena emulator Android, sesuaikan dengan emulator yang dimiliki)

---

# 🧠 Ringkasan Versi Cepat

✔️ Versi final (lebih aman):

1. XAMPP ON
2. Buat DB
3. Clone repo
4. Composer install
5. Setup .env + key
6. Config DB
7. Migrate
8. Serve
9. Flutter

## 📌 Catatan Pengembangan

* Backend ini dirancang untuk dihubungkan dengan aplikasi **Flutter**
* Struktur API dibuat sederhana agar mudah dikembangkan
* Pengembangan yang diharapakan terjadi di masa depan:
  - Fitur like dan komentar
  - Fitur bookmark
  - Fitur pengikut
  - Fitur publish cerita 
  - Dan masih banyak lagi