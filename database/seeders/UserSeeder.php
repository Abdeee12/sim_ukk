<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus semua user dulu
        DB::table('users')->truncate();

        echo "🔄 Mulai seeding users...\n";

        try {
            // 1. Bikin Akun Admin
            $admin = User::create([
                'name' => 'Administrator',
                'email' => 'admin@sekolah.sch.id',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]);
            echo "✅ Admin created: {$admin->email}\n";

            // 2. Bikin Akun Mentor
            $mentor = User::create([
                'name' => 'Pak Budi Mentor',
                'email' => 'mentor@perusahaan.com',
                'password' => Hash::make('password123'),
                'role' => 'mentor',
            ]);
            echo "✅ Mentor created: {$mentor->email}\n";

            // 3. Bikin Akun Siswa
            $siswa = User::create([
                'name' => 'Andi Siswa',
                'email' => 'andi@siswa.sch.id',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
            ]);
            echo "✅ Siswa created: {$siswa->email}\n";

            echo "\n🎉 Total users: " . User::count() . "\n";

        } catch (\Exception $e) {
            echo "❌ ERROR: " . $e->getMessage() . "\n";
            throw $e;
        }
    }
}