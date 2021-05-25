# Package to use Scraping Link API from PHP

[![Latest Version on Packagist](https://img.shields.io/packagist/v/scrapinglink/php-scraping-link.svg?style=flat-square)](https://packagist.org/packages/scrapinglink/php-scraping-link)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/scrapinglink/php-scraping-link/Tests?label=tests&style=flat-square)](https://github.com/scrapinglink/php-scraping-link/actions?query=workflow%3ATests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/scrapinglink/php-scraping-link/Check%20&%20fix%20styling?label=code%20style&style=flat-square)](https://github.com/scrapinglink/php-scraping-link/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/scrapinglink/php-scraping-link.svg?style=flat-square)](https://packagist.org/packages/scrapinglink/php-scraping-link)

---

![scraping.link web scraping API](https://scraping.link/wp-content/uploads/2021/04/scrapinglink.png)

A PHP Package for Web Scraping with [Scraping.link](https://scraping.link). Scraping Link allows you to scrape any website and solve typical blocking complications.

## Installation

You can install the package via composer:

```bash
composer require scrapinglink/php-scraping-link
```

## Usage

### Initialize using your API token

```php
use Scrapinglink\PhpScrapingLink\ScrapingLink;

$scrapingLink = new ScrapingLink('LZIK69Bfg2km3VDG1oyHnwo1RMIymIYgChuocgypoqyQstGeonVpS6iNBMTz');
```

### Scrape URL and get response

```php
$response = $scrapingLink->scrape('https://google.com');

echo "Status code: " . $response->status();
echo "Body: " . $response->body();
```

### Scrape URL and get response with JS rendering

```php
$response = $scrapingLink->scrape('https://google.com', true);

echo "Status code: " . $response->status();
echo "Body: " . $response->body();
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Scraping Link](https://github.com/ScrapingLink)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
