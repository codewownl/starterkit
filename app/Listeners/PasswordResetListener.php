<?php

declare(strict_types=1);

namespace App\Listeners;

final class PasswordResetListener
{
    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $user = $event->user;
        if (! $user->hasVerifiedEmail()) {
            $user->email_verified_at = now();
            $user->save();
        }
    }
}
