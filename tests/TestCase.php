<?php

namespace JeffersonGoncalves\Filament\Topbar\Tests;

use BladeUI\Heroicons\BladeHeroiconsServiceProvider;
use BladeUI\Icons\BladeIconsServiceProvider;
use Filament\Actions\ActionsServiceProvider;
use Filament\FilamentServiceProvider;
use Filament\Forms\FormsServiceProvider;
use Filament\Infolists\InfolistsServiceProvider;
use Filament\Notifications\NotificationsServiceProvider;
use Filament\PanelProvider;
use Filament\Schemas\SchemasServiceProvider;
use Filament\Support\SupportServiceProvider;
use Filament\Tables\TablesServiceProvider;
use Filament\Widgets\WidgetsServiceProvider;
use JeffersonGoncalves\Filament\Topbar\Tests\Fixtures\TestPanelProvider;
use JeffersonGoncalves\Filament\Topbar\TopbarServiceProvider;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use RyanChandler\BladeCaptureDirective\BladeCaptureDirectiveServiceProvider;

class TestCase extends Orchestra
{
    // Dependencies (e.g. the laravel-* package behind the plugin) register through their own discovery.
    protected $enablesPackageDiscoveries = true;

    protected function getPackageProviders($app): array
    {
        // Only what is installed: Schemas exists on Filament 4+, @capture on 3, and a plugin may depend on
        // filament/actions or filament/forms alone.
        return array_values(array_filter([
            SchemasServiceProvider::class,
            BladeCaptureDirectiveServiceProvider::class,
            ActionsServiceProvider::class,
            BladeHeroiconsServiceProvider::class,
            BladeIconsServiceProvider::class,
            FilamentServiceProvider::class,
            FormsServiceProvider::class,
            InfolistsServiceProvider::class,
            LivewireServiceProvider::class,
            NotificationsServiceProvider::class,
            SupportServiceProvider::class,
            TablesServiceProvider::class,
            WidgetsServiceProvider::class,
            TopbarServiceProvider::class,
            ...(class_exists(PanelProvider::class) ? [TestPanelProvider::class] : []),
        ], 'class_exists'));
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('app.key', 'base64:'.base64_encode(str_repeat('k', 32)));
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }
}
