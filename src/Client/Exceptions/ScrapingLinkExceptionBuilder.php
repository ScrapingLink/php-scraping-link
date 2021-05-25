<?php

declare(strict_types=1);

namespace Scrapinglink\PhpScrapingLink\Client\Exceptions;

use GuzzleHttp\Exception\ClientException;

class ScrapingLinkExceptionBuilder
{
    public static function fromClientException(ClientException $clientException): ScrapingLinkException
    {
        switch ($clientException->getResponse()->getStatusCode()) {
            case 401:
                return InvalidApiTokenException::fromClientException($clientException);
            case 402:
                return PlanLimitException::fromClientException($clientException);
            default:
                return ScrapingLinkException::fromClientException($clientException);
        }
    }
}
