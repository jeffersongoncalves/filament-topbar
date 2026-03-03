## Filament Topbar

A Filament plugin that replaces the default topbar with an enhanced version featuring top navigation and improved layout for navigation and user interface elements.

### Installation

@verbatim
<code-snippet name="Install the plugin" lang="bash">
composer require jeffersongoncalves/filament-topbar:"^3.0"
</code-snippet>
@endverbatim

### Register Plugin

@verbatim
<code-snippet name="Register in PanelProvider" lang="php">
use JeffersonGoncalves\Filament\Topbar\TopbarPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            TopbarPlugin::make(),
        ]);
}
</code-snippet>
@endverbatim

### Publish Views (Optional)

@verbatim
<code-snippet name="Publish views for customization" lang="bash">
php artisan vendor:publish --tag="filament-topbar-views"
</code-snippet>
@endverbatim

### Features
- Replaces default Filament topbar with a custom Livewire component
- Enables top navigation layout automatically via `->topbar()` and `->topNavigation()`
- Custom Livewire `Topbar` component with tenant menu and user menu support
- Supports `refresh-topbar` Livewire event for dynamic updates
- Responsive design for both desktop and mobile
- Zero configuration after plugin registration

### Best Practices
- Register this plugin when you want top navigation instead of the default sidebar layout
- Publish views only if you need to customize the topbar HTML structure
- Use `$this->dispatch('refresh-topbar')` to refresh the topbar dynamically
- The plugin automatically sets `->topbar()` and `->topNavigation()` on the panel
