<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Exception;
use Illuminate\Database\Seeder;

final class UserSeeder extends Seeder
{
    public function run(): void
    {

        if (! config('app.default_user.email')) {
            throw new Exception('No ADMIN_PASSWORD set');
        }

        if (! config('app.default_user.password')) {
            throw new Exception('No ADMIN_EMAIL set');
        }

        $check = User::where('email', config('app.default_user.email'))->first();
        if (! $check) {
            $user = User::create([
                'first_name' => config('app.default_user.first_name'),
                'last_name' => config('app.default_user.last_name'),
                'email_verified_at' => now(),
                'email' => config('app.default_user.email'),
                'password' => bcrypt(config('app.default_user.password')),
            ]);

            $user->assignRole('super_admin');
        }
    }
}
