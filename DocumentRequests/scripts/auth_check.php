<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Auth;
use App\Models\User;

function check($email, $password){
    $credentials = ['email' => $email, 'password' => $password];
    $ok = Auth::attempt($credentials);
    echo "CHECK {$email} -> ".($ok?"AUTHENTICATED":"FAILED")."\n";
    if($ok){
        $u = Auth::user();
        echo " user_id={$u->id} is_admin=".($u->is_admin?1:0)." verified=".($u->email_verified_at?1:0)."\n";
        Auth::logout();
    } else {
        $u = User::where('email',$email)->first();
        if ($u) {
            echo " user exists id={$u->id} hashed_password={$u->password}\n";
        }
    }
}

// Known credentials
check('john@example.com','password123');
check('tempadmin_9923a7@example.com','92763a22');
check('tempuser_418b04@example.com','140022f9');

return 0;
