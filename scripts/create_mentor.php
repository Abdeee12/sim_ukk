<?php
// Skrip pembuat mentor cepat untuk pengembangan lokal
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Mentor;
use Illuminate\Support\Facades\Hash;

$email = $argv[1] ?? 'mentor2@perusahaan.com';
$name = $argv[2] ?? 'Mentor 2';
$password = $argv[3] ?? 'password123';

echo "Mencari/menambahkan akun mentor: $email\n";

$existing = User::where('email', $email)->first();
if ($existing) {
    echo "User sudah ada dengan id={$existing->id}, role={$existing->role}\n";
    $user = $existing;
    if ($user->role !== 'mentor') {
        $user->role = 'mentor';
        $user->save();
        echo "Role user diubah menjadi 'mentor'.\n";
    }
} else {
    $user = User::create([
        'name' => $name,
        'email' => $email,
        'password' => Hash::make($password),
        'role' => 'mentor',
    ]);
    echo "User baru dibuat id={$user->id}\n";
}

$mentor = Mentor::where('user_id', $user->id)->first();
if ($mentor) {
    echo "Record Mentor sudah ada (mentor.id={$mentor->id}).\n";
} else {
    $mentor = Mentor::create([
        'user_id' => $user->id,
        'nama_perusahaan' => 'Perusahaan Mentor',
        'jabatan' => 'Pembimbing',
        'no_hp' => '081200000000',
    ]);
    echo "Record Mentor dibuat id={$mentor->id}\n";
}

echo "Selesai. Kredensial: email={$user->email} password={$password}\n";

exit(0);
