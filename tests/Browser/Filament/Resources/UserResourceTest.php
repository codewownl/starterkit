<?php

declare(strict_types=1);

use App\Models\User;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertSoftDeleted;

it('can create a new user', function () {
    $user = User::factory()->make();

    visit('/')
        ->click('Gebruikers')
        ->click('Gebruiker aanmaken')
        ->fill('form.first_name', $user->first_name)
        ->fill('form.last_name', $user->last_name)
        ->fill('form.email', $user->email)
        ->fill('form.password', 'password')
        ->press('.fi-ac-btn-action[type=submit]')
        ->assertSee('Aangemaakt');

    assertDatabaseHas('users', [
        'first_name' => $user->first_name,
        'last_name' => $user->last_name,
        'email' => $user->email,
    ]);
});

it('can edit an existing user', function () {
    $newRecord = User::factory()->make();

    visit('/')
        ->click('Gebruikers')
        ->click('Bewerken')
        ->fill('form.first_name', $newRecord->first_name)
        ->fill('form.last_name', $newRecord->last_name)
        ->click('.fi-ac-btn-action[type=submit]')
        ->assertSee('Opgeslagen');

    assertDatabaseHas('users', [
        'first_name' => $newRecord->first_name,
        'last_name' => $newRecord->last_name,
    ]);
});

it('can delete an existing user', function () {
    visit('/')
        ->click('Gebruikers')
        ->click('Bewerken')
        ->click('Verwijderen')
        ->click('.fi-modal-window button[type=submit]')
        ->assertSee('Verwijderd');

    assertSoftDeleted('users', [
        'id' => auth()->user()->id,
    ]);
});
