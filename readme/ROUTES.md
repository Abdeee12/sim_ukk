# ROUTES — Rute Penting untuk Pengujian

Gunakan perintah berikut untuk melihat semua rute yang terdaftar:

```powershell
php artisan route:list
```

Rute penting (nama route) yang sering dipakai di UI:

- Admin:
  - `admin.dashboard` — `GET /admin/dashboard`
  - `admin.siswa.index` — CRUD siswa (resource)
  - `admin.siswa.edit` — `GET /admin/siswa/{siswa}/edit`
  - `admin.siswa.update` — `PATCH /admin/siswa/{siswa}`
  - `admin.siswa.destroy` — `DELETE /admin/siswa/{siswa}`
  - `admin.laporan.index` — `GET /admin/laporan`
  - `admin.laporan.show` — `GET /admin/laporan/{laporan}`
  - `admin.laporan.edit` — `GET /admin/laporan/{laporan}/edit`
  - `admin.laporan.update` — `PATCH /admin/laporan/{laporan}`

- Mentor:
  - `mentor.dashboard` — `GET /mentor/dashboard`
  - `mentor.laporan.pending` — `GET /mentor/laporan/pending`
  - `mentor.laporan.index` (resource) — `GET /mentor/laporan`

- Siswa:
  - `siswa.dashboard` — `GET /siswa/dashboard`
  - `siswa.createLaporan` — `GET /siswa/laporan/create`
  - `siswa.laporan.store` — `POST /siswa/laporan/store`
  - `siswa.laporan.edit` — `GET /siswa/laporan/{laporan}/edit`
  - `siswa.laporan.update` — `PATCH /siswa/laporan/{laporan}`

Jika suatu action di UI tidak bekerja (mis. Edit/Delete), jalankan `php artisan route:list` dan pastikan nama route dan method cocok dengan form `action` dan spoofed method (`@method('PATCH')`, `@method('DELETE')`).
# ROUTES — Rute Penting untuk Pengujian
# ROUTES — Rute Penting untuk Pengujian

Gunakan perintah berikut untuk melihat semua rute yang terdaftar:

```powershell
php artisan route:list
```

Rute penting (nama route) yang sering dipakai di UI:

- Admin:
  - `admin.dashboard` — `GET /admin/dashboard`
  - `admin.siswa.index` — CRUD siswa (resource)
  - `admin.siswa.edit` — `GET /admin/siswa/{siswa}/edit`
  - `admin.siswa.update` — `PATCH /admin/siswa/{siswa}`
  - `admin.siswa.destroy` — `DELETE /admin/siswa/{siswa}`
  - `admin.laporan.index` — `GET /admin/laporan`
  - `admin.laporan.show` — `GET /admin/laporan/{laporan}`
  - `admin.laporan.edit` — `GET /admin/laporan/{laporan}/edit`
  - `admin.laporan.update` — `PATCH /admin/laporan/{laporan}`

- Mentor:
  - `mentor.dashboard` — `GET /mentor/dashboard`
  - `mentor.laporan.pending` — `GET /mentor/laporan/pending`
  - `mentor.laporan.index` (resource) — `GET /mentor/laporan`

- Siswa:
  - `siswa.dashboard` — `GET /siswa/dashboard`
  - `siswa.createLaporan` — `GET /siswa/laporan/create`
  - `siswa.laporan.store` — `POST /siswa/laporan/store`
  - `siswa.laporan.edit` — `GET /siswa/laporan/{laporan}/edit`
  - `siswa.laporan.update` — `PATCH /siswa/laporan/{laporan}`

Jika suatu action di UI tidak bekerja (mis. Edit/Delete), jalankan `php artisan route:list` dan pastikan nama route dan method cocok dengan form `action` dan spoofed method (`@method('PATCH')`, `@method('DELETE')`).
