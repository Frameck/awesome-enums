<?php

namespace Frameck\AwesomeEnums;

use Frameck\AwesomeEnums\Commands\AwesomeEnumsCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AwesomeEnumsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('awesome-enums')
            ->hasCommand(AwesomeEnumsCommand::class);
    }
}
