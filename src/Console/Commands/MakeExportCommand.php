<?php

declare(strict_types=1);

namespace Nethercore\CsvExporter\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Pluralizer;

class MakeExportCommand extends Command
{
    protected const STUB_PATH = __DIR__ . '../../../Stubs/export.stub';

    protected $signature = 'make:export {name} {model}';
    protected $description = 'Make a new export class';
    protected Filesystem $files;

    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    public function handle(): void
    {
        $path = $this->getSourceFilePath();
        $this->createDirectoryIfNotExists($path);

        $contents = $this->generateStubContents();
        $this->createFile($path, $contents);
    }

    private function getSingularClassName(string $name): string
    {
        return ucwords(Pluralizer::singular($name));
    }

    private function getStubPath(): string
    {
        return self::STUB_PATH;
    }

    private function getStubVariables(): array
    {
        return [
            'NAMESPACE' => 'App\\Exports',
            'CLASS_NAME' => $this->getSingularClassName($this->argument('name')),
            'MODEL' => $this->getSingularClassName($this->argument('model'))
        ];
    }

    private function generateStubContents(): string
    {
        return $this->replacePlaceholders(
            $this->getStubPath(),
            $this->getStubVariables()
        );
    }

    private function replacePlaceholders(string $stubFilePath, array $placeholderValues = []): string
    {
        $contents = file_get_contents($stubFilePath);

        foreach ($placeholderValues as $placeholder => $value) {
            $search = '{{' . $placeholder . '}}';
            $contents = str_replace($search, $value, $contents);
        }

        return $contents;
    }

    private function getSourceFilePath(): string
    {
        return base_path('app/Exports/') . $this->getSingularClassName($this->argument('name')) . 'Export.php';
    }

    private function createDirectoryIfNotExists(string $path): void
    {
        if (!$this->files->isDirectory($path)) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }
    }

    private function createFile(string $path, string $contents): void
    {
        if (!$this->files->exists($path)) {
            $this->files->put($path, $contents);
            $this->info($path . ' successfully created.');
        } else {
            $this->error($path . ' already exists.');
        }
    }
}
