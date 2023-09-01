<?php

namespace IgnacioDev\SailShortcut;

use Illuminate\Support\ServiceProvider;

class SailShortcutServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if (!$this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            Console\Commands\InstallCommand::class,
            Console\Commands\UninstallCommand::class,
        ]);
    }
}
