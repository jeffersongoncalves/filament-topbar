<?php

use Illuminate\Support\Facades\Blade;

it('loads every class it ships', function (string $class) {
    expect(class_exists($class) || interface_exists($class) || trait_exists($class))->toBeTrue();
})->with([
    ['JeffersonGoncalves\\Filament\\Topbar\\Components\\Topbar'],
    ['JeffersonGoncalves\\Filament\\Topbar\\TopbarServiceProvider'],
]);

it('compiles every Blade view it ships', function (string $file) {
    expect(Blade::compileString((string) file_get_contents(__DIR__.'/../../'.$file)))->toBeString();
})->with([
    ['resources/views/components/topbar.blade.php'],
]);
