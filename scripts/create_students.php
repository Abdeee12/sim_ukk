<?php
// Skrip membuat 10 akun siswa untuk pengembangan lokal
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;

$names = ['abde','andhika','fadil','adit','rakha','aries','alpan','ridho','goldy','patra'];
$domainSuffix = 'smkn1garut@gmail.com';
$password = 'password123';

echo "Membuat akun siswa...\n";
$i = 1;
foreach ($names as $name) {
    $email = $name . $domainSuffix; // e.g. abdesmkn1garut@gmail.com per permintaan

    $user = User::where('email', $email)->first();
    if (! $user) {
        $user = User::create([
            'name' => ucfirst($name),
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'siswa',
        ]);
        echo "- User dibuat: {$user->id} | {$email}\n";
    } else {
        echo "- User sudah ada: {$user->id} | {$email}\n";
        // ensure role is siswa
        if ($user->role !== 'siswa') { $user->role = 'siswa'; $user->save(); echo "  (role diubah ke 'siswa')\n"; }
    }

    $siswa = Siswa::where('user_id', $user->id)->first();
    if (! $siswa) {
        // Use user id to generate a unique NISN to avoid uniqueness collisions
        $nisn = 'NISN' . str_pad($user->id, 6, '0', STR_PAD_LEFT);
        // ensure uniqueness (very unlikely to collide since based on user id)
        $exists = Siswa::where('nisn', $nisn)->exists();
        if ($exists) {
            // fallback: append random suffix until unique
            do {
                $nisn = 'NISN' . uniqid();
            } while (Siswa::where('nisn', $nisn)->exists());
        }

        $siswa = Siswa::create([
            'user_id' => $user->id,
            'mentor_id' => null,
            'nisn' => $nisn,
            'kelas' => 'XII RPL 1',
            'jurusan' => 'RPL',
            'nomor_hp' => null,
        ]);
        echo "  -> Siswa dibuat id={$siswa->id} nisn={$nisn}\n";
    } else {
        echo "  -> Siswa sudah ada id={$siswa->id} mentor_id={$siswa->mentor_id}\n";
    }

    $i++;
}

echo "Selesai. Semua password default: {$password}\n";

exit(0);
