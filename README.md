# Nethercore
Add to composer.json:

```
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/Netherspike/Nethercore"
    }
]
```


composer require nethercore/csv-exporter

php artisan make:export {name} {model}

Example Usage:

```
<?php

declare(strict_types= 1);

namespace App\Exports;

use App\Models\Product;
use Nethercore\CsvExporter\Interfaces\BaseExporterInterface;
use Nethercore\CsvExporter\Traits\StreamResponseTrait;
use Symfony\Component\HttpFoundation\StreamedResponse;

final class TestExport implements BaseExporterInterface
{
    use StreamResponseTrait;
    ...
}
```