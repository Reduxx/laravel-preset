<?php

namespace Reduxx\LaravelPreset;

use Illuminate\Support\Arr;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Console\Presets\Preset as LaravelPreset;

class Preset extends LaravelPreset
{
    public static function install(Command $command)
    {
        $command->info('Removing default SASS directory');
        self::removeSassDirectory();

        $command->info('Initializing LESS with TailwindCSS default');
        self::createLessDirectory();
        self::createLessFile();

        $command->info('Updating package.json');
        self::updatePackages();

        $command->info('Updating webpack.mix.js file');
        self::updateMix();

        $command->info('Add new boilerplate for VueJS components with TailwindCSS classes');
        self::updateScripts();

        if (!File::exists(base_path('tailwind.js'))) {
            $command->warn('You don\'t have a tailwind.js file. Please run "npm install" and then "./node_modules/.bin/tailwind init"');
        }
    }

    public static function removeSassDirectory()
    {
        File::deleteDirectory(resource_path('assets/sass'));
    }

    public static function createLessDirectory()
    {
        File::deleteDirectory(resource_path('assets/less'));
        File::makeDirectory(resource_path('assets/less'));
    }

    public static function createLessFile()
    {
        copy(__DIR__ . '/stubs/app.less', resource_path('assets/less/app.less'));
    }

    public static function updatePackageArray($packages)
    {
        return [
            'axios' => '^0.18',
            'cross-env' => '^5.1',
            'laravel-mix' => '^2.0',
            'laravel-mix-purgecss' => '^2.1',
            'laravel-mix-tailwind' => '^0.1',
            'tailwindcss' => '^0.5',
            'vue' => '^2.5',
        ];
    }

    public static function updateMix()
    {
        copy(__DIR__ . '/stubs/webpack.mix.js', base_path('webpack.mix.js'));
    }

    public static function updateScripts()
    {
        copy(__DIR__ . '/stubs/bootstrap.js', resource_path('assets/js/bootstrap.js'));
        copy(__DIR__ . '/stubs/app.js', resource_path('assets/js/app.js'));
        File::deleteDirectory(resource_path('assets/js/components'));
        File::makeDirectory(resource_path('assets/js/components'));
        copy(__DIR__ . '/stubs/ExampleComponent.vue', resource_path('assets/js/components/ExampleComponent.vue'));
    }
}
