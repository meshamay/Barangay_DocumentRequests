<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;

$emails = [
    'john@example.com',
    'tempadmin_9923a7@example.com',
];

foreach ($emails as $email) {
    $u = User::where('email', $email)->first();
    if (! $u) {
        echo "User not found: {$email}\n";
        continue;
    }
    $u->email_verified_at = date('Y-m-d H:i:s');
    $u->save();
    echo "Verified: {$email}\n";
}

return 0;
