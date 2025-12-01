<?php
// Skrip: tetapkan mentor secara acak ke setiap siswa (untuk development)
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Mentor;
use App\Models\Siswa;

$mentors = Mentor::all()->pluck('id')->toArray();
if (empty($mentors)) {
    echo "Tidak ada mentor ditemukan. Buat dulu mentor sebelum menjalankan skrip ini.\n";
    exit(1);
}

echo "Mentor available: " . implode(', ', $mentors) . "\n";

$siswas = Siswa::all();
if ($siswas->isEmpty()) {
    echo "Tidak ada data siswa.\n";
    exit(0);
}

$assigned = 0;
foreach ($siswas as $s) {
    $old = $s->mentor_id;
    $new = $mentors[array_rand($mentors)];
    $s->mentor_id = $new;
    $s->save();
    echo "Siswa id={$s->id} ({$s->user->email}) mentor: {$old} -> {$new}\n";
    $assigned++;
}

echo "Selesai. Mentor ditetapkan ke {$assigned} siswa secara acak.\n";
exit(0);
