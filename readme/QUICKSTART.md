# QUICKSTART  Menjalankan proyek secara lokal

Langkah cepat untuk menjalankan dan menguji proyek di mesin development (Windows / PowerShell):

1) Pastikan dependencies terinstal

```powershell
composer install
npm install
npm run build   # atau `npm run dev` untuk mode development
```

2) Buat symlink storage (agar file upload dapat diakses)

```powershell
php artisan storage:link
```

3) Jalankan built-in server Laravel

```powershell
php artisan serve --host=127.0.0.1 --port=8000
# lalu buka http://127.0.0.1:8000
```

4) Data pengujian

- Ada beberapa skrip di folder `scripts/` (contoh: `create_admin.php`, `create_mentor.php`, `create_students.php`, `assign_random_mentors.php`). Jalankan skrip ini lewat PHP CLI untuk menyiapkan akun cepat.

Contoh:

```powershell
php scripts/create_admin.php
php scripts/create_mentor.php
php scripts/create_students.php
php scripts/assign_random_mentors.php
```

5) Debugging singkat

- Periksa log: `storage/logs/laravel.log`
- Daftar rute: `php artisan route:list`
