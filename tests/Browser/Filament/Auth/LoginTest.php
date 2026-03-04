<?php

declare(strict_types=1);

use App\Models\User;

beforeEach(function () {
    auth()->logout();

    $this->user = User::factory()->create([
        'email' => 'demo@pestphp.com',
        'password' => 'password',
    ]);
});

test('an unauthenticated user can login', function () {
    visit('/login')
        ->assertSee('Inloggen op je account')
        ->type('form.email', $this->user->email)
        ->type('form.password', 'password')
        ->click('Inloggen')
        ->assertSee('Dashboard');

    $this->assertAuthenticated();
});
