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

Generated files will appear in App/Exports/{name}Export.php

Use double backslashes for nested name or model files.

`php artisan make:export {name} {model}`

e.g `php artisan make:export Wharehouse\\Product Stock\\Item` will create `app/Exports/Wharehouse/ProductExport.php` using `Models/Stock/Item.php` inside the export file.

Example Code:

```
namespace App\Exports;

use App\Models\Product;
use Nethercore\CsvExporter\Interfaces\BaseExporterInterface;
use Nethercore\CsvExporter\Traits\StreamResponseTrait;
use Symfony\Component\HttpFoundation\StreamedResponse;

final class ProductExport implements BaseExporterInterface
{
    use StreamResponseTrait;
    ...
}
```

```
use App\Exports\ProductExport;

class ProductController extends Controller
{
    public function export()
    {
        return (new ProductExport('some product title'))->export());
    }
}
```
