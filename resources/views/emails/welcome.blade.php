<x-mail::message>
# Welkom {{ $first_name }},
Klik hier onder op de knop om je wachtwoord in te stellen.

<x-mail::button :url="$link" color="primary">
Wachtwoord instellen
</x-mail::button>

Met vriendelijke groet,<br>
Team {{ config('app.name') }}
</x-mail::message>
