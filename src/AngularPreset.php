<?php


namespace Walteribeiro\AngularPreset;


use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Laravel\Ui\Presets\Preset;

class AngularPreset extends Preset
{
    /**
     * Install the preset.
     *
     * @return void
     */
    public static function install()
    {
        static::updatePackages();
        static::updateWebpackConfiguration();

        tap(new Filesystem, function (Filesystem $filesystem) {
            $filesystem->deleteDirectory(resource_path('js'));
            $filesystem->makeDirectory(resource_path('ts'));
            $filesystem->makeDirectory(resource_path('ts/app'));
            $filesystem->makeDirectory(resource_path('ts/environments'));
        });

        static::removeNodeModules();
        static::updateAngularApp();
    }

    /**
     * Update the Webpack configuration.
     *
     * @return void
     */
    protected static function updateWebpackConfiguration()
    {
        copy(__DIR__ . '/angular-stubs/webpack.mix.js', base_path('webpack.mix.js'));
    }

    /**
     * Update the Angular files.
     *
     * @return void
     */
    protected static function updateAngularApp()
    {
        copy(__DIR__ . '/angular-stubs/main.ts', resource_path('ts/main.ts'));
        copy(__DIR__ . '/angular-stubs/app/app.module.ts', resource_path('ts/app/app.module.ts'));
        copy(__DIR__ . '/angular-stubs/app/app.component.ts', resource_path('ts/app/app.component.ts'));
        copy(__DIR__ . '/angular-stubs/environment.ts', resource_path('ts/environments/environment.ts'));
        copy(__DIR__ . '/angular-stubs/app/tsconfig.json', resource_path('ts/tsconfig.json'));
        copy(__DIR__ . '/angular-stubs/tslint.json', resource_path('ts/tslint.json'));
        copy(__DIR__ . '/angular-stubs/app/welcome.blade.php', resource_path('views/welcome.blade.php'));
        copy(__DIR__ . '/angular-stubs/polyfills.ts', resource_path('ts/polyfills.ts'));
        copy(__DIR__ . '/angular-stubs/vendor.ts', resource_path('ts/vendor.ts'));
        copy(__DIR__ . '/angular-stubs/tsconfig.json', resource_path('tsconfig.json'));
    }

    /**
     * Update the given package array.
     *
     * @param array $packages
     * @return array
     */
    protected static function updatePackageArray(array $packages)
    {
        return [
                "@angular/animations" => "~9.1.0",
                "@angular/common" => "~9.1.0",
                "@angular/compiler" => "~9.1.0",
                "@angular/core" => "~9.1.0",
                "@angular/forms" => "~9.1.0",
                "@angular/platform-browser" => "~9.1.0",
                "@angular/platform-browser-dynamic" => "~9.1.0",
                "@angular/router" => "~9.1.0",
                "@types/node" => "^12.11.1",
                'core-js' => '^2.5.4',
                "rxjs" => "~6.5.4",
                'ts-loader' => '~6.2.2',
                "ts-node" => "~8.3.0",
                "tslib" => "^1.10.0",
                "tslint" => "~6.1.0",
                "typescript" => "~3.8.3",
                "webpack" => "^4.42.1",
                "zone.js" => "~0.10.2",
            ] + Arr::except($packages, ['axios', 'lodash']);
    }
}
