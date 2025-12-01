<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Siswa;
use App\Models\User;

$siswas = Siswa::with('user')->get();
foreach ($siswas as $s) {
    $email = $s->user->email ?? 'N/A';
    echo "id={$s->id} | user_id={$s->user_id} | name={$s->user->name} | email={$email} | nisn={$s->nisn} | mentor_id={$s->mentor_id}\n";
}

exit(0);
