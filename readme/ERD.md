# ERD (Entity-Relationship) — Ringkasan Skema Database

Entitas utama dan relasi:

- `users` (PK: `id`)
  - kolom: `id`, `name`, `email`, `password`, `role`, `email_verified_at`, `remember_token`, timestamps

- `mentors` (PK: `id`)
  - kolom: `id`, `user_id` (FK -> `users.id`), `nama_perusahaan`, `jabatan`, `no_hp`, timestamps
  - relasi: `mentors.user_id` -> `users.id` (one-to-one)

- `siswas` (PK: `id`)
  - kolom: `id`, `user_id` (FK -> `users.id`), `nisn` (unique), `kelas`, `jurusan`, `nomor_hp`, `mentor_id` (FK -> `mentors.id`), timestamps
  - relasi: `siswas.user_id` -> `users.id` (one-to-one)
  - relasi: `siswas.mentor_id` -> `mentors.id` (many-to-one)

- `laporan_harians` (PK: `id`)
  - kolom: `id`, `siswa_id` (FK -> `siswas.id`), `tanggal`, `jam_masuk`, `jam_keluar`, `detail_kegiatan`, `path_bukti`, `mentor_signature`, `status` (pending/approved/rejected), `feedback_mentor`, timestamps
  - relasi: `laporan_harians.siswa_id` -> `siswas.id` (many-to-one)

Contoh aturan FK & tindakan saat delete:
- `users.id` deletion -> cascade ke `siswas`/`mentors` (opsional, tergantung kebijakan)
- `mentors.id` deletion -> `siswas.mentor_id` set NULL (recommended)
- `siswas.id` deletion -> cascade ke `laporan_harians`

Index penting:
- `siswas.mentor_id` (untuk query per-mentor)
- `laporan_harians.siswa_id` dan `laporan_harians.tanggal` (frekuensi query per siswa/ per tanggal)

Migration contoh (Laravel shorthand):

```php
Schema::create('laporan_harians', function (Blueprint $table) {
    $table->id();
    $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
    $table->date('tanggal');
    $table->time('jam_masuk');
    $table->time('jam_keluar')->nullable();
    $table->text('detail_kegiatan');
    $table->string('path_bukti')->nullable();
    $table->string('mentor_signature')->nullable();
    $table->enum('status', ['pending','approved','rejected'])->default('pending');
    $table->text('feedback_mentor')->nullable();
    $table->timestamps();
});
```
