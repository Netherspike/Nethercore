# Nethercore - Laravel CSV Data Export & Creator

Installation:

1. Add to composer.json:

```
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/Netherspike/Nethercore"
    }
]
```

2. install package `composer require nethercore/csv-exporter`
________________________________________________________________________

Usage:

Generated files will appear in App/Exports/{name}Exort.php

`php artisan make:export {name} {model}`

Example Code:

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
