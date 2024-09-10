<?php

declare(strict_types=1);

namespace Nethercore\CsvExporter\Providers;

use Illuminate\Support\ServiceProvider;
use Nethercore\CsvExporter\Console\Commands\MakeExportCommand;

final class ExportProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands(
                commands: [
                    MakeExportCommand::class,
                ]
            );
        }
    }
}
