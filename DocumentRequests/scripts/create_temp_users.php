<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;

try {
    $adminEmail = 'tempadmin_' . substr(bin2hex(random_bytes(3)), 0, 6) . '@example.com';
    $adminPass = substr(bin2hex(random_bytes(4)), 0, 10);
    $admin = User::create([
        'name' => 'Temp Admin',
        'email' => $adminEmail,
        'password' => bcrypt($adminPass),
        'is_admin' => true,
    ]);

    $userEmail = 'tempuser_' . substr(bin2hex(random_bytes(3)), 0, 6) . '@example.com';
    $userPass = substr(bin2hex(random_bytes(4)), 0, 10);
    $user = User::create([
        'name' => 'Temp User',
        'email' => $userEmail,
        'password' => bcrypt($userPass),
        'is_admin' => false,
    ]);

    echo "ADMIN_CREATED|{$adminEmail}|{$adminPass}\n";
    echo "USER_CREATED|{$userEmail}|{$userPass}\n";
} catch (Throwable $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    exit(1);
}

return 0;
