<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$email = 'admin@sekolah.sch.id';
$password = 'password123';

$u = User::firstOrNew(['email' => $email]);
$u->name = 'Administrator';
$u->role = 'admin';
$u->password = Hash::make($password);
$u->save();

echo "ADMIN_OK: {$u->email}\n";
echo "PASSWORD: {$password}\n";
