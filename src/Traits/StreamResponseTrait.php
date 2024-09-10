<?php

declare(strict_types=1);

namespace Nethercore\CsvExporter\Traits;

use Symfony\Component\HttpFoundation\StreamedResponse;

trait StreamResponseTrait
{
    public function downloadCsv(array $data, string $filename, int $status = 200): StreamedResponse
    {
        return new StreamedResponse(
            callback: function () use ($data) {
                $handle = fopen('php://output', 'w');
                foreach ($data as $row) {
                    fputcsv($handle, $row);
                }
                fclose($handle);
            },
            status: $status,
            headers: [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename=' . $filename,
            ]
        );
    }
}
