<?php

namespace Walteribeiro\AngularPreset;

use Illuminate\Support\ServiceProvider;
use Laravel\Ui\Presets\Preset;
use Laravel\Ui\UiCommand;

class AngularPresetServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        UiCommand::macro('angular-v9', function (UiCommand $command) {
            AngularPreset::install();

            $command->info('Angular V9 scaffolding installed successfully.');
            $command->comment('Please run "yarn && yarn dev" to compile your fresh scaffolding.');
        });
    }
}
