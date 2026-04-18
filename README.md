# 🚀 EnigmaticAura - Professional Portfolio & Admin Dashboard

## What is EnigmaticAura?

EnigmaticAura adalah website portfolio profesional modern yang dibangun menggunakan framework **CodeIgniter 4**. Platform ini menyediakan:

- **Landing Page** yang menarik dengan animasi smooth dan dark/light mode toggle
- **Admin Dashboard** komprehensif berbasis TailAdmin untuk manajemen konten
- **RESTful API** untuk interaksi dinamis dengan frontend
- **Sistem autentikasi** aman dengan proteksi route
- **Manajemen database** dengan migrations untuk skills dan settings

Informasi lebih lanjut tentang CodeIgniter dapat ditemukan di [situs resmi](https://codeigniter.com).

---

## 📋 Daftar Isi

1. [Prasyarat](#-prasyarat)
2. [Instalasi](#-instalasi)
3. [Konfigurasi](#-konfigurasi)
4. [Menjalankan Aplikasi](#-menjalankan-aplikasi)
5. [Fitur Utama](#-fitur-utama)
6. [Struktur Proyek](#-struktur-proyek)
7. [Testing](#-testing)
8. [Keamanan](#-keamanan)
9. [Troubleshooting](#-troubleshooting)
10. [Deployment](#-deployment)

---

## ✅ Prasyarat

### Perangkat Lunak yang Diperlukan

- **PHP** 8.2 atau lebih tinggi
- **Composer** (dependency manager PHP)
- **Node.js** 18+ dan npm (untuk kompilasi aset)
- **MySQL/MariaDB** (opsional, untuk fitur database)
- **Git** (version control)

### Ekstensi PHP yang Diperlukan

Pastikan ekstensi berikut diaktifkan dalam `php.ini`:

```ini
extension=intl
extension=mbstring
extension=mysqlnd    ; Jika menggunakan MySQL
extension=curl       ; Untuk HTTP requests
extension=json       ; Aktif secara default
extension=fileinfo   ; Untuk file uploads
extension=gd         ; Untuk image processing
```

### Verifikasi Instalasi

```bash
# Cek versi PHP
php -v

# Cek Composer
composer --version

# Cek Node.js
node -v
npm -v
```

> [!WARNING]
> - Tanggal end-of-life PHP 7.4 adalah 28 November 2022
> - Tanggal end-of-life PHP 8.0 adalah 26 November 2023
> - Tanggal end-of-life PHP 8.1 adalah 31 Desember 2025
> - Segera upgrade jika masih menggunakan PHP di bawah 8.2
> - Tanggal end-of-life PHP 8.2 adalah 31 Desember 2026

---

## 📦 Instalasi

### Langkah 1: Clone atau Navigasi ke Project

```bash
git clone https://github.com/enigmaaura404/enigmatic-aura.git && cd enigmatic_aura
```

### Langkah 2: Install Dependensi PHP

```bash
composer install
```

Ini akan menginstall semua package PHP yang diperlukan termasuk framework CodeIgniter 4.

### Langkah 3: Install Dependensi Node.js

```bash
npm install
```

Ini akan menginstall Tailwind CSS dan dependensi frontend lainnya.

### Langkah 4: Konfigurasi Environment

```bash
# Copy file environment example
cp env .env

# Generate encryption key (penting untuk keamanan)
php spark key:generate
```

---

## ⚙️ Konfigurasi

### Konfigurasi File `.env`

Edit file `.env` dengan pengaturan Anda:

```bash
nano .env
```

#### Konfigurasi Esensial

```env
# --------------------------------------------------------------------
# PENGATURAN APLIKASI
# --------------------------------------------------------------------
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost:8080/'

# --------------------------------------------------------------------
# DATABASE (Opsional - untuk fitur production)
# --------------------------------------------------------------------
database.default.hostname = localhost
database.default.database = enigmatic_aura
database.default.username = root
database.default.password = your_password_here
database.default.DBDriver = MySQLi
database.default.DBPrefix = 
database.default.port = 3306

# --------------------------------------------------------------------
# ENCRYPTION KEY (Auto-generated)
# --------------------------------------------------------------------
encryption.key = hex2bin:YOUR_GENERATED_KEY_HERE

# --------------------------------------------------------------------
# SESSION
# --------------------------------------------------------------------
session.driver = CodeIgniter\Session\Handlers\FileHandler
session.cookieName = enigmatic_session
session.expiration = 7200
session.savePath = null
session.matchIP = false
session.timeToUpdate = 300
session.regenerateDestroy = false

# --------------------------------------------------------------------
# EMAIL (Untuk notifikasi password reset)
# --------------------------------------------------------------------
email.from = "noreply@yourdomain.com"
email.fromName = "EnigmaticAura"
email.protocol = smtp
email.SMTPHost = smtp.gmail.com
email.SMTPUser = your_email@gmail.com
email.SMTPPass = your_app_password
email.SMTPPort = 587
email.SMTPCrypto = TLS
email.mailType = html
email.charset = utf-8
email.newline = \r\n
```

### Set Permission Direktori

```bash
# Buat direktori writable dapat diakses
chmod -R 777 writable/
chmod -R 755 public/
```

### Kompilasi Assets (Opsional)

```bash
# Build Tailwind CSS
npm run build

# Atau watch untuk perubahan selama development
npm run dev
```

---

## 🏃 Menjalankan Aplikasi

### Development Server

```bash
# Start CodeIgniter development server
php spark serve
```

Akses aplikasi di:
- **Landing Page**: http://localhost:8080
- **Admin Login**: http://localhost:8080/auth/login
- **API Health Check**: http://localhost:8080/health

### Alternatif: Menggunakan Built-in PHP Server

```bash
# Dari direktori public
cd public
php -S localhost:8080
```

---

## ✨ Fitur Utama

### 🌐 Landing Page Publik

| Fitur | Deskripsi |
|-------|-----------|
| Hero Section | Introduksi animasi dengan CTA |
| About Section | Bio personal/profesional |
| Skills Section | Tampilan tech stack dengan tingkat kemahiran |
| Projects Section | Showcase portfolio |
| Contact Form | Submit AJAX dengan validasi |
| Dark/Light Mode | Toggle tema dengan persistensi |
| Responsive Design | Pendekatan mobile-first |
| Accessibility | Label ARIA, navigasi keyboard |

### 🔐 Admin Dashboard (Arsitektur TailAdmin)

| Modul | Fitur |
|-------|-------|
| **Dashboard** | Analytics, stat cards, aktivitas terbaru |
| **Projects** | CRUD lengkap, publish/unpublish, bulk delete |
| **Skills** | Tambah, edit, hapus skills dengan kategori |
| **Settings** | Manajemen pengaturan aplikasi dengan pagination & search |
| **About** | Editor konten halaman about |
| **Focus** | Manajemen focus areas |
| **Messages** | Inbox pesan dari contact form dengan mark as read |
| **Profile** | Update profil admin, ganti password |
| **Logout** | Terminasi sesi aman |

### 📡 API Endpoints

| Endpoint | Method | Deskripsi |
|----------|--------|-----------|
| `/api/contact/send` | POST | Submit contact form |
| `/api/projects/list` | GET | Retrieve daftar projects |
| `/api/skills/list` | GET | Retrieve daftar skills |
| `/api/theme/preference` | POST | Simpan preferensi tema |
| `/health` | GET | Health check endpoint |

### 💾 Database Features

- **Migrations**: Script migrasi untuk tabel skills dan settings
- **Models**: SkillModel dan SettingModel dengan validasi lengkap
- **Soft Deletes**: Support untuk soft deletes pada model
- **Timestamps**: Auto-managed created_at dan updated_at

---

## 🏗️ Struktur Proyek

```
/workspace
│
├── app/
│   ├── Config/
│   │   ├── Routes.php          # Konfigurasi routing utama
│   │   ├── Filters.php         # Registrasi filter auth
│   │   ├── App.php             # Konfigurasi aplikasi
│   │   └── Database.php        # Konfigurasi database
│   │
│   ├── Controllers/
│   │   ├── Admin/              # Controller admin panel
│   │   │   ├── Dashboard.php
│   │   │   ├── ProjectController.php
│   │   │   ├── SkillController.php
│   │   │   ├── SettingController.php
│   │   │   ├── ContentController.php
│   │   │   ├── AboutController.php
│   │   │   ├── FocusController.php
│   │   │   ├── MessageController.php
│   │   │   └── AuthController.php
│   │   │
│   │   ├── Api/                # API endpoints
│   │   │   ├── ContactController.php
│   │   │   ├── ProjectController.php
│   │   │   ├── SkillController.php
│   │   │   └── ThemeController.php
│   │   │
│   │   ├── Auth/               # Controller autentikasi
│   │   │   ├── LoginController.php
│   │   │   └── ForgotPasswordController.php
│   │   │
│   │   ├── BaseController.php
│   │   ├── Home.php
│   │   └── Landing.php
│   │
│   ├── Filters/
│   │   └── AuthFilter.php      # Filter proteksi route
│   │
│   ├── Models/                 # Model database
│   │   ├── SkillModel.php      # Model untuk skills
│   │   └── SettingModel.php    # Model untuk settings
│   │
│   ├── Views/
│   │   ├── auth/               # View login & auth
│   │   │   └── login.php
│   │   ├── dashboard/          # View admin dashboard
│   │   │   ├── index.php       # Dashboard home
│   │   │   ├── analytics.php   # Analytics page
│   │   │   ├── projects.php    # Project management
│   │   │   ├── skills.php      # Skills management
│   │   │   ├── skills_form.php # Form skills
│   │   │   ├── layout.php      # Dashboard layout
│   │   │   ├── about/          # About management views
│   │   │   ├── focus/          # Focus management views
│   │   │   ├── messages/       # Messages inbox views
│   │   │   └── settings/       # Settings management views
│   │   ├── landing/            # View landing page
│   │   │   └── index.php
│   │   ├── layouts/            # Template layouts
│   │   │   ├── index.php       # Main layout
│   │   │   ├── landing.php     # Landing layout
│   │   │   └── dashboard.php   # Dashboard layout
│   │   └── partials/           # Komponen reusable
│   │       ├── header.php
│   │       ├── navbar.php
│   │       └── footer.php
│   │
│   ├── Database/
│   │   ├── Migrations/         # Migration files
│   │   │   ├── 2024-01-17-000001_CreateSkillsTable.php
│   │   │   └── 2024-01-18-000002_CreateSettingsTable.php
│   │   └── Seeds/              # Seeder files
│   │
│   ├── Helpers/                # Custom helper functions
│   ├── Libraries/              # Custom libraries
│   └── Language/               # Localization files
│
├── public/
│   ├── index.php               # Entry point aplikasi
│   ├── .htaccess               # Apache rewrite rules
│   ├── robots.txt              # SEO robots file
│   ├── favicon.ico             # Site favicon
│   └── assets/
│       ├── css/
│       │   └── style.css       # Compiled Tailwind CSS
│       └── js/
│           └── app.js          # Frontend JavaScript
│
├── resources/
│   ├── css/
│   │   └── input.css           # Tailwind source file
│   └── node_modules/           # Node dependencies
│
├── tests/                      # PHPUnit test files
│   ├── unit/                   # Unit tests
│   ├── session/                # Session tests
│   ├── database/               # Database tests
│   └── _support/               # Test support files
│
├── writable/
│   ├── cache/                  # Cache storage
│   ├── logs/                   # Application logs
│   ├── session/                # Session files
│   └── uploads/                # Uploaded files
│
├── vendor/                     # Composer dependencies
├── node_modules/               # Node.js dependencies
├── .env                        # Environment configuration
├── composer.json               # PHP dependencies
├── package.json                # Node.js dependencies
├── tailwind.config.js          # Tailwind CSS configuration
├── spark                       # CodeIgniter CLI tool
└── LICENSE                     # MIT License
```

---

## 🔑 Kredensial Demo

**Login Admin:**
- Email: `admin@example.com`
- Password: `admin123`

> ⚠️ **Penting**: Ganti kredensial ini sebelum deploy ke production!

---

## 🧪 Testing

### Testing Landing Page

- [ ] Hero section tampil dengan baik di semua device
- [ ] Toggle dark/light mode berfungsi dan persist
- [ ] Smooth scroll navigation ke sections
- [ ] Contact form submit dengan AJAX
- [ ] Toast notifications muncul saat form submit
- [ ] Mobile menu buka/tutup dengan benar
- [ ] Semua link navigasi dengan benar
- [ ] Images load dengan baik
- [ ] Tidak ada console errors di browser

### Testing Admin Panel

- [ ] Login page accessible di `/auth/login`
- [ ] Login dengan demo credentials berhasil
- [ ] Redirect ke dashboard setelah login
- [ ] Stats cards menampilkan data
- [ ] Sidebar navigation berfungsi
- [ ] Protected routes redirect ke login saat tidak authenticated
- [ ] Logout clear session dan redirect
- [ ] Profile update form berfungsi
- [ ] CSRF token validation berjalan

### Testing API

```bash
# Test projects API
curl http://localhost:8080/api/projects/list

# Test skills API
curl http://localhost:8080/api/skills/list

# Test health endpoint
curl http://localhost:8080/health
```

- [ ] `GET /api/projects/list` mengembalikan JSON valid
- [ ] `GET /api/skills/list` mengembalikan JSON valid
- [ ] `POST /api/contact/send` menerima form data
- [ ] `GET /health` mengembalikan status OK

### Testing Database

```bash
# Jalankan migrations
php spark migrate

# Cek status migrations
php spark migrate:status
```

- [ ] Migrations berjalan tanpa error
- [ ] Tabel skills dibuat dengan benar
- [ ] Tabel settings dibuat dengan benar
- [ ] Model validation berfungsi

### Testing Keamanan

- [ ] CSRF protection aktif pada forms
- [ ] XSS prevention berjalan (output escaped)
- [ ] Auth filter melindungi admin routes
- [ ] SQL injection prevention (prepared statements)
- [ ] Auto-routing disabled

---

## 🔒 Fitur Keamanan

1. **CSRF Protection** - Diaktifkan pada route sensitif
2. **XSS Prevention** - Menggunakan `esc()` untuk semua output user
3. **Auth Filter** - Melindungi semua route `/admin`
4. **Input Validation** - Validasi server-side di controllers
5. **Auto-routing Disabled** - Hanya route definitions eksplisit
6. **Secure Headers** - Headers keamanan tambahan
7. **Session Security** - File-based session handler dengan cookie protection

---

## 🔧 Troubleshooting

### Masalah Umum

#### 1. Error "Class not found"

```bash
# Clear autoloader cache
composer dump-autoload

# Clear CodeIgniter cache
php spark cache:clear
```

#### 2. Permission Denied Errors

```bash
# Fix permission direktori writable
chmod -R 777 writable/
chown -R www-data:www-data writable/  # Di Linux dengan Apache/Nginx
```

#### 3. Koneksi Database Gagal

```env
# Verifikasi pengaturan .env
database.default.hostname = localhost
database.default.database = your_database
database.default.username = your_username
database.default.password = your_password
database.default.DBDriver = MySQLi
```

```bash
# Test koneksi database
php spark db:test
```

#### 4. Assets Tidak Load

```bash
# Rebuild assets
npm install
npm run build

# Cek base URL di .env
app.baseURL = 'http://localhost:8080/'
```

#### 5. Masalah Session

```bash
# Pastikan direktori session writable
chmod -R 777 writable/session/

# Clear file session
rm -rf writable/session/*
```

#### 6. Route Not Found

```bash
# Clear route cache
php spark routes:clear

# List semua registered routes
php spark routes
```

#### 7. Migration Issues

```bash
# Rollback migrations
php spark migrate:rollback

# Re-run migrations
php spark migrate

# Fresh migration (drop & recreate all tables)
php spark migrate:fresh
```

### Debug Mode

Aktifkan debug mode di `.env`:

```env
CI_ENVIRONMENT = development
```

Cek logs di:
- `writable/logs/log-YYYY-MM-DD.php`

---

## 🚀 Deployment

### Checklist Production

- [ ] Ubah `CI_ENVIRONMENT` ke `production`
- [ ] Update `app.baseURL` ke domain Anda
- [ ] Ganti demo admin credentials
- [ ] Aktifkan HTTPS
- [ ] Set permission file yang tepat
- [ ] Konfigurasi database untuk production
- [ ] Aktifkan caching
- [ ] Minify CSS/JS assets
- [ ] Setup error logging
- [ ] Konfigurasi email untuk password resets
- [ ] Setup backup strategy

### Pengaturan .env Production

```env
CI_ENVIRONMENT = production
app.baseURL = 'https://yourdomain.com/'

# Enable caching
cache.handler = Redis  # atau File

# Optimize untuk production
logger.threshold = 3  # Hanya log errors dan above
```

### Build Optimized Assets

```bash
# Production build
NODE_ENV=production npm run build
```

### Deploy ke VPS/Server

1. Upload files via FTP/SFTP atau Git
2. Jalankan `composer install --no-dev`
3. Konfigurasi web server (Apache/Nginx)
4. Point document root ke folder `public/`
5. Setup SSL certificate
6. Konfigurasi database
7. Jalankan migrations jika diperlukan

### Konfigurasi Apache

```apache
<VirtualHost *:443>
    ServerName yourdomain.com
    DocumentRoot /var/www/enigmatic/public
    
    <Directory /var/www/enigmatic/public>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    
    SSLEngine on
    SSLCertificateFile /path/to/cert.pem
    SSLCertificateKeyFile /path/to/key.pem
</VirtualHost>
```

### Konfigurasi Nginx

```nginx
server {
    listen 443 ssl;
    server_name yourdomain.com;
    root /var/www/enigmatic/public;
    index index.php;

    ssl_certificate /path/to/cert.pem;
    ssl_certificate_key /path/to/key.pem;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }

    location ~ /\.ht {
        deny all;
    }
}
```

### Running Migrations di Production

```bash
# Jalankan semua migrations
php spark migrate

# Cek status
php spark migrate:status
```

---

## 🎨 Peningkatan Masa Depan

- [ ] Image Upload - Upload thumbnail projects
- [ ] Rich Text Editor - Untuk content management
- [ ] Chart Integration - ApexCharts/Chart.js untuk analytics
- [ ] Real Authentication - Password hashing dengan `password_hash()`
- [ ] Role-based Access - Permission Admin vs Editor
- [ ] API Rate Limiting - Throttle filter untuk API endpoints
- [ ] Advanced Caching - Redis/Memcached untuk performa
- [ ] Multi-language Support - Localization dengan i18n
- [ ] Backup System - Automated database backup
- [ ] Analytics Integration - Google Analytics atau alternatif

---

## 📚 Dokumentasi

- [CodeIgniter 4 User Guide](https://codeigniter.com/user_guide/)
- [TailAdmin Documentation](https://tailadmin.com/docs)
- [Tailwind CSS](https://tailwindcss.com/docs)
- [Composer Documentation](https://getcomposer.org/doc/)
- [PHP Documentation](https://www.php.net/docs.php)
- [MySQL Documentation](https://dev.mysql.com/doc/)

---

## 🆘 Mendapatkan Bantuan

Jika Anda mengalami masalah:

1. Cek bagian [Troubleshooting](#-troubleshooting)
2. Review `writable/logs/` untuk error messages
3. Aktifkan debug mode di `.env`
4. Cek browser console untuk JavaScript errors
5. Verifikasi semua prasyarat terinstall
6. Periksa dokumentasi CodeIgniter 4

---

## 📄 License

Proyek ini open-source dan tersedia di bawah **MIT License**.

---

## ✅ Status Saat Ini: READY FOR PRODUCTION

Sistem EnigmaticAura telah sepenuhnya dikonfigurasi dan siap digunakan:

- ✅ Semua controllers terimplementasi
- ✅ Struktur routing lengkap
- ✅ Sistem autentikasi fungsional
- ✅ API endpoints operasional
- ✅ Database models dengan validasi
- ✅ Migrations untuk database schema
- ✅ Security measures diterapkan
- ✅ Responsive design tested
- ✅ Accessibility improvements applied
- ✅ Admin dashboard dengan CRUD lengkap
- ✅ Settings management dengan pagination
- ✅ Messages inbox system

**Langkah Selanjutnya:**
1. Tambahkan functionality upload gambar untuk projects
2. Implementasi rich text editor untuk content management
3. Tambahkan analytics charts ke dashboard
4. Setup production environment dengan SSL
5. Implementasi backup system otomatis
6. Tambahkan multi-language support

---

*Terakhir Diperbarui: April 2025*  
*Versi: 1.0.0*  
*Framework: CodeIgniter 4.7+*  
*PHP Required: 8.2+*
