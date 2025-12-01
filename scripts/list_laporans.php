<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\LaporanHarian;

$laporans = LaporanHarian::with('siswa.user','siswa.mentor')->get();
foreach($laporans as $l){
    $siswa = $l->siswa;
    $userEmail = $siswa && $siswa->user ? $siswa->user->email : '(no user)';
    $mentorId = $siswa ? $siswa->mentor_id : '(no siswa)';
    $mentorUserId = $siswa && $siswa->mentor ? $siswa->mentor->user_id : '(no mentor model)';
    echo "Laporan {$l->id} | tanggal: {$l->tanggal} | siswa_id: {$l->siswa_id} | siswa email: {$userEmail} | siswa.mentor_id: {$mentorId} | mentor.user_id: {$mentorUserId} | status: {$l->status}\n";
}
