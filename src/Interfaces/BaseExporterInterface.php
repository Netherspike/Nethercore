<?php

declare(strict_types=1);

namespace Nethercore\CsvExporter\Interfaces;

use Symfony\Component\HttpFoundation\StreamedResponse;

interface BaseExporterInterface
{
    public function generateExportData(): BaseExporterInterface;
    public function export(): StreamedResponse;
}
