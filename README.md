<div class="filament-hidden">

![Filament Topbar](https://raw.githubusercontent.com/jeffersongoncalves/filament-topbar/1.x/art/jeffersongoncalves-filament-topbar.png)

</div>

# Filament Topbar

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jeffersongoncalves/filament-topbar.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/filament-topbar)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/jeffersongoncalves/filament-topbar/fix-php-code-style-issues.yml?branch=1.x&label=code%20style&style=flat-square)](https://github.com/jeffersongoncalves/filament-topbar/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3A1.x)
[![Total Downloads](https://img.shields.io/packagist/dt/jeffersongoncalves/filament-topbar.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/filament-topbar)
[![License](https://img.shields.io/packagist/l/jeffersongoncalves/filament-topbar.svg?style=flat-square)](LICENSE.md)

## Description

A simple yet effective Filament plugin that automatically adds a customized topbar to your Filament admin panel. This plugin enhances your Filament panel's user experience by replacing the default topbar component with an improved version that displays navigation and user interface elements in strategic locations.

## Preview

![Preview Topbar Navigation](https://raw.githubusercontent.com/jeffersongoncalves/filament-topbar/1.x/art/preview-topbar-navigation.png)

![Preview Topbar Navigation Mobile](https://raw.githubusercontent.com/jeffersongoncalves/filament-topbar/1.x/art/preview-topbar-navigation-mobile.png)

## Features

- 🎨 **Custom Topbar Component**: Replaces the default Filament topbar with an enhanced version
- 🔧 **Easy Integration**: Automatically integrates with your existing Filament panels
- 🚀 **Zero Configuration**: Works out of the box after installation
- 📱 **Responsive Design**: Maintains Filament's responsive design principles
- 🔄 **Backward Compatible**: Preserves the original topbar functionality while adding enhancements

## Requirements

- PHP 8.2 or higher
- Filament 3.x

## Installation

You can install the package via composer:

```bash
composer require jeffersongoncalves/filament-topbar:^1.0
```

The package will automatically register its service provider and replace the default Filament topbar component.

## Usage

Once installed, the package works automatically. No additional configuration is required. The enhanced topbar will be displayed in all your Filament admin panels.

```php
$panel
  ->topNavigation();
```

### How it works

The package:
1. Registers a new custom topbar component that replaces the default one
2. Uses a custom Blade view that enhances the topbar functionality

### Customization

If you need to customize the topbar view, you can publish the views:

```bash
php artisan vendor:publish --tag="filament-topbar-views"
```

This will publish the topbar view to `resources/views/vendor/filament-topbar/components/topbar.blade.php` where you can modify it according to your needs.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Jèfferson Gonçalves](https://github.com/jeffersongoncalves)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
