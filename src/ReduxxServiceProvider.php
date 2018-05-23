<?php

namespace Reduxx\LaravelPreset;

use Illuminate\Console\Command;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Console\PresetCommand;

class ReduxxServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        PresetCommand::macro('reduxx', function (Command $command) {
            Preset::install($command);
            $command->line('');
            $command->info('All finished!');
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
