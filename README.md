# SIMM — Sistem Informasi Magang

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

Tools
---------

- Laravel (PHP 8.2+)
- Blade + Tailwind CSS
- Xampp (MySQL)
- Laravel Breeze 

Persyaratan Sistem

- PHP 8.2+
- MySQL 8+
- Composer
- Node.js & NPM

Instalasi
---------

1) Clone repository

```powershell
git clone (https://github.com/Abdeee12/sim_ukk)
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

Default Akun 

Gunakan skrip di folder `scripts/` untuk membuat akun contoh, atau buat manual melalui tinker/seed:

- Admin: `admin@sekolah.sch.id` / `password123`
- Mentor: `mentor1@perusahaan.com` / `password123`
- Siswa: `abde@gmail.com` / `password123`

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

Database,ERD,UML
<img width="1890" height="946" alt="Cupl![Uploading Gemini_Generated_Image_l9yexwl9yexwl9ye.png…]()
ikan layar 2025-12-01 221605" src="https://github.com/user-attachments/assets/2696d5bf-b395-4a53-a7e7-814634504650" />
<img width="648" height="966" alt="Cuplikan layar 2025-12-01 224527" src="https://github.com/user-attachments/assets/687d7616-9731-486c-ade5-209217dfcf7b" />
<img width="1100" height="684" alt="Cuplikan layar 2025-12-01 232422" src="https://github.com/user-attachments/assets/c3214b11-c11b-4ec1-8d57-bc3a27e9bf8d" />


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


