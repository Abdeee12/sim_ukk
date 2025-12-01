Dokumentasi Proyek Primary School
Konsep Dari Web Yang Saya Buat
Primary School adalah website Daftar Ulang Penerimaan Peserta Didik Baru (PPDB) tingkat Sekolah Dasar (SD) yang dirancang untuk memudahkan proses daftar ulang siswa baru secara online. Primary School bertujuan untuk memberikan pengalaman daftar ulang yang lebih cepat, efisien, dan transparan, sehingga seluruh proses penerimaan siswa baru dapat berjalan dengan lancar tanpa harus datang langsung ke sekolah.

Fitur Yang Tersedia
Halaman Awal
Home
About
Frequently Asked Questions
Contact
Authentication
Register
Login
Multi User
Admin
Mengelola Peserta
Melihat semua data
Peserta
Mengakses Halaman Awal tanpa Login
Mengakses Halaman Awal setelah Login
Login sebagai Peserta
Mengisi Formulir Daftar Ulang
Print Formulir Daftar Ulang
Mengisi Formulir Join Ekstrakurikuler
All
Login
Logout
Akun Default
Admin:
Email: admin@example.com
Password: password123
Peserta:
Nama Lengkap: Peserta
Nomor Pendaftaran: 911911
ERD
![erd abde](https://github.com/user-attachments/assets/1d35b791-e6d9-4e53-8d68-0f9ecddbd66c)

ERD

UML
UML

Teknologi yang Digunakan
Laravel 8
Tools yang Digunakan
Laragon
VSCode
Navicat
Persyaratan untuk Instalasi
PHP 7.4.33
Web Server
Database (MySQL)
Web Browser
Cara Instalasi IceSicle
1. Persyaratan
Pastikan terlebih dulu Anda memenuhi persyaratan berikut:

PHP versi 7.4.33
Web Server (Apache)
Database (MySQL)
Web Browser
2. Clone Repository
Pertama, clone repository dari GitHub dengan perintah berikut:

git clone https://github.com/azmiakh/ujikom.git
3. Masuk ke Direktori Proyek
Setelah clone selesai, masuk ke direktori proyek:

cd ujikom
4. Instalasi Dependensi
Instal dependensi menggunakan Composer:

composer install
5. Salin File .env
Salin file '.env.example' menjadi '.env':

cp .env.example .env
6. Atur Kunci Aplikasi
Generate kunci aplikasi menggunakan Artisan:

php artisan key:generate
7. Konfigurasi Database
Edit file '.env' dan atur konfigurasi database:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=username_database
DB_PASSWORD=password_database
8. Jalankan Migrations
Jalankan perintah berikut untuk membuat tabel di database:

php artisan migrate
9. Jalankan Server
Jalankan server lokal dengan perintah berikut:

php artisan serve
