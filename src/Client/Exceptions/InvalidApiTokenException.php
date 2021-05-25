<?php

declare(strict_types=1);

namespace Scrapinglink\PhpScrapingLink\Client\Exceptions;

use GuzzleHttp\Exception\ClientException;

class InvalidApiTokenException extends ScrapingLinkException
{
    public static function fromClientException(ClientException $clientException): self
    {
        return new self('Invalid API Token', $clientException->getCode(), $clientException);
    }
}
