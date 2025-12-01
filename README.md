# SIMM — Sistem Informasi Magang

Deskripsi
---------

SIMM (Sistem Informasi Magang) adalah aplikasi berbasis Laravel untuk mengelola proses magang siswa, mencakup pembuatan dan pengelolaan laporan harian, penugasan mentor, serta monitoring dan administrasi oleh pihak sekolah atau penyelenggara.

Fitur Utama
-----------

Fitur Admin
- Dashboard komprehensif: ringkasan jumlah siswa, mentor, dan status laporan.
- Manajemen Siswa: create/read/update/delete siswa serta penugasan mentor.
- Manajemen Mentor: CRUD data mentor.
- Review Laporan: melihat, mengedit, approve/reject laporan harian siswa.

Fitur Mentor
- Dashboard mentor: melihat daftar laporan yang jadi tanggung jawab.
- Akses baca ke semua laporan (read-only) dan hak edit untuk siswa yang ditugaskan.
- Memberi feedback, approve/reject, dan menandatangani laporan.

Fitur Siswa
- Membuat dan mengedit laporan harian sendiri.
- Mengunggah bukti (foto/file) dan melihat status approval dari mentor.

Alert & Statistik
- Notifikasi laporan pending, ditolak, atau selesai di dashboard.
- Statistik ringkas pada kartu: pending, approved, rejected.

UI/UX
- Tema modern, kompatibel dark theme menggunakan Tailwind CSS.
- Responsif untuk perangkat mobile dan desktop.

Teknologi
---------

- Backend: Laravel (PHP 8.2+)
- Frontend: Blade + Tailwind CSS
- Database: MySQL
- Autentikasi: Laravel Breeze atau scaffold serupa

Persyaratan Sistem

- PHP 8.2+
- MySQL 8+
- Composer
- Node.js & NPM

Instalasi (Singkat)
------------------

1) Clone repository

```powershell
git clone <repository-url>
cd simm_ukk
```

2) Instal dependensi

```powershell
composer install
npm install
npm run build   # atau `npm run dev` untuk mode development
```

3) Konfigurasi environment

```powershell
cp .env.example .env
php artisan key:generate
# edit .env untuk mengatur DB dan pengaturan lain
```

4) Migrasi dan (opsional) seeding

```powershell
php artisan migrate
php artisan db:seed   # jika ada seeder untuk akun contoh
```

5) Buat symlink storage agar file upload bisa diakses

```powershell
php artisan storage:link
```

6) Jalankan server lokal

```powershell
php artisan serve --host=127.0.0.1 --port=8000
# buka http://127.0.0.1:8000
```

Akun Default (contoh)

Jika Anda menggunakan skrip di folder `scripts/`, skrip tersebut dapat membuat akun contoh:

- Admin: `admin@localhost` / `password123`
- Mentor: `mentor1@localhost` / `password123`
- Siswa: `siswa1@localhost` / `password123`

Struktur Folder (Ringkas)

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

Cara Penggunaan (Singkat)
------------------------

Untuk Admin:
1. Login sebagai admin.
2. Kelola data siswa dan mentor.
3. Review laporan harian dan berikan tindakan jika perlu.

Untuk Mentor:
1. Login sebagai mentor.
2. Buka dashboard mentor, tinjau laporan siswa yang ditugaskan.
3. Beri feedback, approve/reject, atau minta perbaikan.

Untuk Siswa:
1. Login sebagai siswa.
2. Buat atau edit laporan harian.
3. Unggah bukti/perkembangan kegiatan.

Alur Kerja
----------

1. Siswa membuat laporan harian.
2. Mentor (primary mentor pada siswa) meninjau laporan.
3. Mentor memberikan keputusan (approve/reject) dan feedback.
4. Admin dapat memantau keseluruhan dan mengintervensi jika diperlukan.

Fitur yang Telah Diimplementasikan
----------------------------------

- Autentikasi role-based (admin/mentor/siswa).
- CRUD untuk siswa dan mentor.
- CRUD dan workflow laporan harian (create/edit/approve/reject).
- Upload file bukti dan penyimpanan pada `storage`.

Database & ERD


Lihat `readme/ERD.md` untuk ringkasan tabel dan relasi utama (users, mentors, siswas, laporan_harians).

Konfigurasi Penting (.env contoh)

```env
APP_NAME=SIMM
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_simm
DB_USERNAME=root
DB_PASSWORD=
```

Troubleshooting Singkat
----------------------

- Error 419 CSRF: pastikan form memiliki `@csrf`.
- Edit/Delete tidak bekerja: pastikan form menyertakan `@method('PATCH')` atau `@method('DELETE')` dan nama route sesuai (`php artisan route:list`).
- Periksa `storage/logs/laravel.log` untuk error runtime.

Catatan Pengembang
------------------

- Ikuti PSR-12 dan praktik terbaik Laravel.
- Periksa setiap view yang mengirim form untuk memastikan `@csrf` dan method spoofing ada.

Kontribusi
----------

1. Fork repository
2. Buat branch fitur: `git checkout -b feature/nama-fitur`
3. Commit perubahan: `git commit -m "Add feature X"`
4. Push dan buat pull request

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
- Statistik tingkat lanjut dan grafik pada dashboard
- API untuk integrasi mobile

Jika Anda ingin saya menambahkan bagian tertentu (contoh: langkah setup database MySQL secara detail, cara menjalankan skrip `scripts/`, atau menambahkan badge CI), beri tahu saya dan saya akan perbarui README ini.
# SIMM — Sistem Informasi Magang

Ini adalah aplikasi Laravel untuk mengelola kegiatan magang: laporan harian siswa, penugasan mentor, dan administrasi peserta.

Dokumentasi ringkas dan panduan ada di folder `readme/`:

- `readme/README.md` — Gambaran singkat proyek
- `readme/QUICKSTART.md` — Cara menjalankan proyek secara lokal
- `readme/ROUTES.md` — Daftar rute penting untuk pengujian
- `readme/ERD.md` — Ringkasan skema database (ERD)

Langkah cepat: jalankan `php artisan serve` lalu buka `http://127.0.0.1:8000`.

