<?php

declare(strict_types=1);

namespace Scrapinglink\PhpScrapingLink\Client\Exceptions;

use GuzzleHttp\Exception\ClientException;

class ScrapingLinkException extends \Exception
{
    public static function fromClientException(ClientException $clientException): self
    {
        return new self('Scraping Link Exception', $clientException->getCode(), $clientException);
    }
}
