<?php

namespace Bndwgn\Bandwagon;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Bndwgn\Bandwagon\Commands\BandwagonCleanup;
use Bndwgn\Bandwagon\Providers\EventServiceProvider;

class BandwagonServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/bandwagon.php' => config_path('bandwagon.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../resources/views' => base_path('resources/views/vendor/bandwagon'),
            ], 'views');

            $migrationFileName = 'create_bandwagon_events_table.php';
            if (! $this->migrationFileExists($migrationFileName)) {
                $this->publishes([
                    __DIR__ . "/../database/migrations/{$migrationFileName}.stub" => database_path('migrations/' . date('Y_m_d_His', time()) . '_' . $migrationFileName),
                ], 'migrations');
            }

            $this->registerRoutes();
            $this->registerProviders();

            $this->commands([
                BandwagonCleanup::class,
            ]);
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'bandwagon');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/bandwagon.php', 'bandwagon');
    }

    public static function migrationFileExists(string $migrationFileName): bool
    {
        $len = strlen($migrationFileName);
        foreach (glob(database_path("migrations/*.php")) as $filename) {
            if ((substr($filename, -$len) === $migrationFileName)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    private function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/Http/routes.php');
        });
    }

    /**
     * Register the package providers
     *
     * @return void
     */
    protected function registerProviders()
    {
        $this->app->register(EventServiceProvider::class);
    }

    /**
     * Get the Telescope route group configuration array.
     *
     * @return array
     */
    private function routeConfiguration()
    {
        return [
            'domain' => config('bandwagon.domain', null),
            'namespace' => 'Bndwgn\Bandwagon\Http\Controllers',
            'prefix' => config('bandwagon.path'),
        ];
    }
}
