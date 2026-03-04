<?php

declare(strict_types=1);

namespace App\Providers;

use App\Listeners\PasswordResetListener;
use App\Policies\RolePolicy;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Placeholder;
use Filament\Infolists\Components\Entry;
use Filament\Support\Colors\Color;
use Filament\Support\Components\Component;
use Filament\Support\Concerns\Configurable;
use Filament\Support\Facades\FilamentColor;
use Filament\Tables\Columns\Column;
use Filament\Tables\Filters\BaseFilter;
use Filament\Tables\Table;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;

final class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->configureModels();
        $this->configureGate();
        $this->configureColors();
        $this->configureTable();
        $this->configureEvents();
        $this->translatableComponents();

        Carbon::setLocale($this->app->getLocale());
    }

    private function configureColors(): void
    {
        FilamentColor::register(Color::all());
    }

    private function configureModels(): void
    {
        Model::shouldBeStrict();

        Model::unguard();
    }

    private function configureGate(): void
    {
        Gate::policy(Role::class, RolePolicy::class);
    }

    private function configureTable(): void
    {
        Table::configureUsing(function (Table $table): void {
            $table->striped()
                ->deferLoading();
        });
    }

    private function translatableComponents(): void
    {
        foreach ([Field::class, BaseFilter::class, Placeholder::class, Column::class, Entry::class] as $component) {
            /* @var Configurable $component */
            $component::configureUsing(function (Component $translatable): void {
                /** @phpstan-ignore method.notFound */
                $translatable->translateLabel();
            });
        }
    }

    private function configureEvents(): void
    {
        Event::listen(PasswordReset::class, PasswordResetListener::class);
    }
}
