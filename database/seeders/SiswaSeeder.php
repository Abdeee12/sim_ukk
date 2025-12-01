<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = User::where('role', 'siswa')->get();

        foreach ($students as $user) {
            if (!Siswa::where('user_id', $user->id)->exists()) {
                Siswa::create([
                    'user_id' => $user->id,
                    'nisn' => 'NISN' . str_pad($user->id, 6, '0', STR_PAD_LEFT),
                    'kelas' => 'XII RPL 1',
                    'jurusan' => 'RPL',
                    'nomor_hp' => null,
                    'tempat_magang' => null,
                ]);
            }
        }
    }
}
