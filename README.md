Dokumentasi SIMM (Sistem imformasi Managemen Magang)
Konsep Dari Web Yang Saya Buat
SIMM adalah untuk mempermudah absen jurnal harian siswa maupun mahasiwa yang magang 
di cyberlabs karena tidak sedikit siswa magang memilih untuk daring 
maka dari itu saya membuat website jurnal harian pkl online


Fitur Yang Tersedia
Halaman Awal
Home
welcome

Authentication
Login

Multi User

Admin

Mengelola siswa
Melihat semua data

Mentor

melihat data laporan siswa
mengakses laporan siswa

Siswa

Mengakses Halaman Awal setelah Login
Login sebagai siswa
Mengisi Formulir jurnal harian

Akun Default
Admin:
Email: admin@sekolah.sch.id
Password: password123

Mentor:
Email:mentor@perusahaan.com
Password:password123

Siswa:
Nama Lengkap: abde
Email: abde@gmail.com
Password: password123
ERD
![erd abde](https://github.com/user-attachments/assets/1d35b791-e6d9-4e53-8d68-0f9ecddbd66c)


Teknologi yang Digunakan
Laravel 11
Tools yang Digunakan
Xampp
VSCode
Navicat
Persyaratan untuk Instalasi
PHP 8.5.0
Web Server
Database (MySQL)
Web Browser
Cara Instalasi IceSicle
1. Persyaratan
Pastikan terlebih dulu Anda memenuhi persyaratan berikut:

PHP versi 8.5.0
Web Server (Apache)
Database (MySQL)
Web Browser
2. Clone Repository
Pertama, clone repository dari GitHub dengan perintah berikut:

git clone https://github.com/abdeee12/sim_ukk
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
