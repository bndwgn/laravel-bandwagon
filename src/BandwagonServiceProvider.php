<?php

namespace Bndwgn\Bandwagon;

use Bndwgn\Bandwagon\Commands\BandwagonCleanup;
use Bndwgn\Bandwagon\Providers\EventServiceProvider;
use Bndwgn\Bandwagon\View\Components\Renderer;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

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

            $this->commands([
                BandwagonCleanup::class,
            ]);

            $this->publishes([
                __DIR__.'/../public' => public_path('vendor/bandwagon'),
            ], 'bandwagon-assets');
        }

        $this->registerRoutes();
        $this->registerProviders();
        $this->loadComponents();

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

    protected function loadComponents()
    {
        $this->loadViewComponentsAs('bandwagon', [
            Renderer::class,
        ]);
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
     * Get the Bandwagon route group configuration array.
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
