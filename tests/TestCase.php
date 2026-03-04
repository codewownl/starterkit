<?php

namespace Tests;

use App\Models\User;
use Database\Seeders\ShieldSeeder;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Spatie\Permission\Models\Permission;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config()->set('database.default', 'sqlite');
        config()->set('database.connections.sqlite.database', ':memory:');

        // Use local filesystem for tests to avoid Google Cloud issues
        config()->set('filesystems.default', 'local');

        // Override GCS disk to use local for tests
        config()->set('filesystems.disks.gcs', config('filesystems.disks.local'));

        // Seed roles and permissions
        $this->seed(ShieldSeeder::class);

        $user = User::factory()->create([
            'first_name' => config('app.default_user.first_name'),
            'last_name' => config('app.default_user.last_name'),
            'email' => config('app.default_user.email'),
            'password' => config('app.default_user.password'),
            'avatar' => null,
            'email_verified_at' => now(),
            'remember_token' => null,
        ]);

        $user->assignRole('super_admin');

        $user->givePermissionTo(Permission::all());

        $this->actingAs($user);

        $this->withoutVite();
    }
}
