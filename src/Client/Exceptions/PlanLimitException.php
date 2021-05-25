<?php

declare(strict_types=1);

namespace Scrapinglink\PhpScrapingLink\Client\Exceptions;

use GuzzleHttp\Exception\ClientException;

class PlanLimitException extends ScrapingLinkException
{
    public static function fromClientException(ClientException $clientException): self
    {
        return new self('Plan limit reached', $clientException->getCode(), $clientException);
    }
}
