---
name: filament-topbar-development
description: Build and work with the Filament Topbar plugin, including custom top navigation, Livewire topbar component, and view customization.
---

# Filament Topbar Development

## When to use this skill

Use this skill when:
- Replacing the default Filament topbar with an enhanced top navigation layout
- Customizing the topbar Blade views for branding or layout changes
- Adding dynamic refresh behavior to the topbar component
- Understanding how the Topbar Livewire component integrates with Filament panels
- Troubleshooting topbar rendering or navigation issues

## Architecture

This plugin replaces the default Filament topbar with a custom Livewire component:
- `TopbarPlugin` - Filament plugin that enables top navigation and registers the custom Livewire component
- `TopbarServiceProvider` - Package service provider that registers views
- `Topbar` (Livewire) - Custom Livewire component with tenant and user menu support

### Namespace

```
JeffersonGoncalves\Filament\Topbar
```

### Key Classes

| Class | Path | Purpose |
|-------|------|---------|
| `TopbarPlugin` | `src/TopbarPlugin.php` | Plugin class, configures panel for top navigation |
| `TopbarServiceProvider` | `src/TopbarServiceProvider.php` | Service provider, registers views |
| `Topbar` | `src/Livewire/Topbar.php` | Livewire component for the custom topbar |

## Installation

```bash
composer require jeffersongoncalves/filament-topbar:"^3.0"
```

### Publish Views

```bash
php artisan vendor:publish --tag="filament-topbar-views"
```

Published to: `resources/views/vendor/filament-topbar/components/topbar.blade.php`

## Configuration

### Register the Plugin

```php
use JeffersonGoncalves\Filament\Topbar\TopbarPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            TopbarPlugin::make(),
        ]);
}
```

## How It Works

### Plugin Class

The plugin configures the panel to use top navigation and registers the custom Livewire topbar component:

```php
namespace JeffersonGoncalves\Filament\Topbar;

use Filament\Contracts\Plugin;
use Filament\Panel;
use JeffersonGoncalves\Filament\Topbar\Livewire\Topbar;

class TopbarPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'topbar';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->topbar()
            ->topNavigation()
            ->topbarLivewireComponent(Topbar::class);
    }

    public function boot(Panel $panel): void {}
}
```

Key points:
- `->topbar()` enables the topbar mode on the panel
- `->topNavigation()` switches from sidebar to top navigation layout
- `->topbarLivewireComponent(Topbar::class)` replaces the default topbar with the custom Livewire component

### Livewire Topbar Component

```php
namespace JeffersonGoncalves\Filament\Topbar\Livewire;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Livewire\Concerns\HasTenantMenu;
use Filament\Livewire\Concerns\HasUserMenu;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Topbar extends Component implements HasActions, HasSchemas
{
    use HasTenantMenu;
    use HasUserMenu;
    use InteractsWithActions;
    use InteractsWithSchemas;

    #[On('refresh-topbar')]
    public function refresh(): void {}

    public function render(): View
    {
        return view('filament-topbar::livewire.topbar');
    }
}
```

The component:
- Implements `HasActions` and `HasSchemas` for Filament integration
- Uses `HasTenantMenu` and `HasUserMenu` traits for menu rendering
- Listens for `refresh-topbar` Livewire event to re-render dynamically
- Renders the custom topbar Blade view

### Service Provider

```php
namespace JeffersonGoncalves\Filament\Topbar;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class TopbarServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-topbar')
            ->hasViews();
    }
}
```

## Usage

### Dynamic Topbar Refresh

Dispatch the `refresh-topbar` event from any Livewire component to force the topbar to re-render:

```php
$this->dispatch('refresh-topbar');
```

### Customizing the View

After publishing views, edit `resources/views/vendor/filament-topbar/components/topbar.blade.php` to:
- Add custom branding or logo
- Rearrange navigation elements
- Add custom buttons or links
- Modify the responsive mobile layout

## Version Compatibility

| Package Version | Filament Version |
|----------------|------------------|
| 1.x | 3.x |
| 2.x | 4.x |
| 3.x | 5.x |

## Troubleshooting

### Topbar Not Appearing
**Cause**: Plugin not registered in the PanelProvider.
**Solution**: Ensure `TopbarPlugin::make()` is added to the `->plugins([])` array in your PanelProvider.

### Navigation Still Showing in Sidebar
**Cause**: Another plugin or configuration may be overriding the top navigation setting.
**Solution**: The plugin automatically calls `->topbar()` and `->topNavigation()`. Check that no other configuration is calling `->sidebarCollapsibleOnDesktop()` or similar methods that conflict with top navigation.

### Tenant Menu Not Showing
**Cause**: Multi-tenancy is not configured on the panel.
**Solution**: The `HasTenantMenu` trait only renders when the panel has tenancy configured via `->tenant()`. Ensure your panel has tenancy set up if you expect a tenant switcher.

### Custom View Changes Not Reflecting
**Cause**: Views may be cached.
**Solution**: Clear the view cache with `php artisan view:clear` after modifying published views.
