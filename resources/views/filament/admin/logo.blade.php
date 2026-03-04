<style>
    html.dark .fil-logo-dark {
        display: block;
    }

    html.dark .fil-logo-light {
        display: none;
    }

    html:not(.dark) .fil-logo-dark {
        display: none;
    }

    html:not(.dark) .fil-logo-light {
        display: block;
    }

    .fi-body {
        position: relative;
    }

    html:not(.dark) .fi-body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url('{{ asset("images/logo.svg") }}');
        background-repeat: no-repeat;
        background-position: center 95%;
        background-attachment: fixed;
        background-size: 70px 70px;
        opacity: 0.3;
        z-index: -1;
    }
    /* .fi-page-schedule-accept .fi-sidebar-nav {
    display: none;
    }

    .fi-page-schedule-accept .fi-sidebar-header {
        display: none;
    } */

    html.dark .fi-body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url('{{ asset("images/logo-dark.svg") }}');
        background-repeat: no-repeat;
        background-position: center 95%;
        background-attachment: fixed;
        background-size: 70px 70px;
        opacity: 0.3;
        z-index: -1;
    }
</style>

@guest
    <img src="{{ asset('images/logo.svg') }}" class="fil-logo-light" style="height: 3rem;" alt="Logo" />
    <img src="{{ asset('images/logo-dark.svg') }}" class="fil-logo-dark" style="height: 3rem;" alt="Logo" />
@endguest

@auth
    <img src="{{ asset('images/logo.svg') }}" class="fil-logo-light" style="height: 2.5rem;" alt="Logo" />
    <img src="{{ asset('images/logo-dark.svg') }}" class="fil-logo-dark" style="height: 2.5rem;" alt="Logo" />
@endauth
