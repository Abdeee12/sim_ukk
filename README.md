# SIMM — Sistem Informasi Magang (README gaya CyberTask)

Deskripsi
---------

SIMM adalah aplikasi web berbasis Laravel yang membantu sekolah atau penyelenggara dalam mengelola proses magang siswa: pembuatan laporan harian, penugasan mentor, review dan approval laporan, serta pelaporan statistik.

Fitur Utama
-----------

Fitur Admin
- Dashboard komprehensif: total siswa, mentor, dan status laporan (pending/approved/rejected).
- Manajemen Siswa & Mentor: CRUD dan penugasan mentor.
- Review Laporan: lihat, edit, approve/reject laporan harian.

Fitur Mentor
- Dashboard: melihat daftar laporan yang menjadi tanggung jawab.
- Akses baca ke semua laporan (read-only) dan hak edit/approve untuk siswa yang ditugaskan.
- Memberikan feedback dan tanda tangan mentor.

Fitur Siswa
- Membuat, mengedit, dan mengunggah bukti untuk laporan harian.
- Melihat status approval dari mentor.

Alert System
- Notifikasi laporan overdue dan due soon.
- Pemberitahuan laporan pending untuk mentor terkait.

Dashboard Statistics
- Admin: total siswa, total mentor, total laporan, laporan selesai, pending, overdue.
- Mentor/Karyawan: statistik personal (my reports, completed, overdue).

UI/UX
- Tema modern (dark theme support) menggunakan Tailwind CSS.
- Responsif dan mobile-friendly.

Teknologi
---------

- Backend: Laravel (PHP 8.2+)
- Frontend: Blade + Tailwind CSS
- Database: MySQL
- Autentikasi: Laravel Breeze (atau scaffold serupa)

Persyaratan Sistem

- PHP 8.2+
- MySQL 8+
- Composer
- Node.js & NPM

Instalasi
---------

1) Clone repository

```powershell
git clone <repository-url>
cd simm_ukk
```

2) Install dependencies

```powershell
composer install
npm install
npm run build   # atau `npm run dev` untuk development
```

3) Konfigurasi environment

```powershell
cp .env.example .env
php artisan key:generate
# edit .env untuk konfigurasi database
```

4) Database

```powershell
php artisan migrate
php artisan db:seed   # opsional, jika ada seeder
```

5) Storage

```powershell
php artisan storage:link
```

6) Jalankan server

```powershell
php artisan serve --host=127.0.0.1 --port=8000
# buka http://127.0.0.1:8000
```

Default Akun (contoh)

Gunakan skrip di folder `scripts/` untuk membuat akun contoh, atau buat manual melalui tinker/seed:

- Admin: `admin@localhost` / `password123`
- Mentor: `mentor1@localhost` / `password123`
- Siswa: `siswa1@localhost` / `password123`

Struktur Folder (ringkas)

```
simm_ukk/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Middleware/
│   ├── Models/
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── views/
│   │   ├── admin/
│   │   ├── mentor/
│   │   └── siswa/
├── routes/
├── public/
└── scripts/
```

Cara Penggunaan (singkat)
------------------------

Untuk Admin
1. Login sebagai admin.
2. Kelola data siswa & mentor.
3. Review dan intervensi laporan harian di dashboard.

Untuk Mentor
1. Login sebagai mentor.
2. Tinjau laporan siswa yang ditugaskan.
3. Beri feedback, approve/reject, atau minta revisi.

Untuk Siswa
1. Login sebagai siswa.
2. Buat atau edit laporan harian.
3. Unggah bukti (foto/file) dan cek status approval.

Alur Kerja
----------

1. Siswa membuat laporan harian.
2. Mentor (primary mentor) meninjau laporan.
3. Mentor approve/reject dan memberi feedback.
4. Admin memantau seluruh proses dan melakukan intervensi bila perlu.

Fitur yang Telah Diimplementasikan
----------------------------------

- Autentikasi role-based (admin/mentor/siswa).
- CRUD untuk siswa dan mentor.
- Pembuatan, editing, approve/reject laporan harian.
- Upload file bukti dan penyimpanan pada `storage`.
- Skrip helper di `scripts/` untuk pembuatan akun dan penugasan mentor.

Database & ERD
--------------

Lihat `readme/ERD.md` untuk ringkasan tabel dan relasi utama (users, mentors, siswas, laporan_harians).

Konfigurasi (.env contoh)

```env
APP_NAME=SIMM
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=simm_ukk
DB_USERNAME=root
DB_PASSWORD=
```

Troubleshooting
---------------

1) Error 419 (CSRF): pastikan form memiliki `@csrf`.
2) Edit/Delete tidak bekerja: pastikan ada `@method('PATCH')` atau `@method('DELETE')` di form dan nama route sesuai (`php artisan route:list`).
3) File upload tidak muncul: jalankan `php artisan storage:link` dan periksa permission `storage`.
4) Periksa `storage/logs/laravel.log` untuk detail error runtime.

Catatan Pengembang
------------------

- Ikuti PSR-12 dan praktik terbaik Laravel.
- Periksa setiap view untuk `@csrf` dan method spoofing.
- Tambahkan seeder/migration saat menambah fitur yang memerlukan struktur database baru.

Kontribusi
----------

1. Fork repository
2. Buat branch fitur: `git checkout -b feature/nama-fitur`
3. Commit perubahan: `git commit -m "Add feature X"`
4. Push dan buat Pull Request

Lisensi
-------

Project ini menggunakan lisensi MIT.

Kontak
------

- Developer: (isi nama)
- Email: (isi email)

Roadmap (opsional)
------------------

- Integrasi notifikasi email
- Dashboard analytics dan grafik
- API untuk integrasi mobile

Jika Anda mau, saya bisa menambahkan badge CI, instruksi backup database, atau contoh penggunaan skrip di `scripts/`.
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

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

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
