<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Mentor;
use App\Models\Siswa;

$mentorUser = User::where('role', 'mentor')->first();
if (! $mentorUser) {
    echo "No user with role mentor found.\n";
    exit(1);
}
$mentor = Mentor::firstOrCreate(['user_id' => $mentorUser->id], ['nama_perusahaan' => 'Auto', 'jabatan' => 'Mentor', 'no_hp' => null]);

$oldCount = Siswa::where('mentor_id', '!=', $mentor->id)->count();
Siswa::query()->update(['mentor_id' => $mentor->id]);
$newCount = Siswa::count();

echo "Reassigned all Siswa to mentor_id={$mentor->id}. Total siswa: {$newCount}. Previously different: {$oldCount}.\n";
