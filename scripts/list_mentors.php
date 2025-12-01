<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Mentor;

$mentors = Mentor::with('user')->get();
foreach($mentors as $m){
    $email = $m->user ? $m->user->email : '(no user)';
    echo "Mentor id={$m->id} user_id={$m->user_id} email={$email}\n";
}
