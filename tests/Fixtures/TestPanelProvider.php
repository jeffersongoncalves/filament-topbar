<?php

namespace JeffersonGoncalves\Filament\Topbar\Tests\Fixtures;

use Filament\Panel;
use Filament\PanelProvider;
use JeffersonGoncalves\Filament\Topbar\TopbarPlugin;

class TestPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('test')
            ->path('test')
            ->plugin(TopbarPlugin::make());
    }
}
