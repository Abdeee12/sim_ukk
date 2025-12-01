<?php
// bootstrap Laravel for standalone script
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Mentor;
use App\Models\User;
use App\Models\Siswa;

$mentor = Mentor::first();
if (! $mentor) {
    $user = User::where('role', 'mentor')->first() ?? User::first();
    if (! $user) {
        echo "No user available to create mentor.\n";
        exit(1);
    }
    $mentor = Mentor::create([
        'user_id' => $user->id,
        'nama_perusahaan' => 'Auto-created',
        'jabatan' => 'Pembimbing',
        'no_hp' => '08123456789',
    ]);
    echo "Created mentor id: {$mentor->id}\n";
}

$count = Siswa::whereNull('mentor_id')->count();
if ($count > 0) {
    Siswa::whereNull('mentor_id')->update(['mentor_id' => $mentor->id]);
    echo "Assigned mentor_id={$mentor->id} to {$count} siswa.\n";
} else {
    echo "No siswa without mentor_id found.\n";
}

echo "Done.\n";
