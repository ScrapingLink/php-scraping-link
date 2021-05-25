<?php

declare(strict_types=1);

namespace Scrapinglink\PhpScrapingLink\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;
use Scrapinglink\PhpScrapingLink\Client\Exceptions\ScrapingLinkExceptionBuilder;

class ScrapingLinkClient
{
    private Client $guzzle;
    private string $apiToken;

    public function __construct(string $baseUri, int $timeout, string $apiToken)
    {
        $this->guzzle = $this->getGuzzleClient($baseUri, $timeout);
        $this->apiToken = $apiToken;
    }

    protected function getGuzzleClient(string $baseUri, int $timeout): Client
    {
        return new Client([
            'base_uri' => $baseUri,
            'timeout' => $timeout,
            'headers' => ['User-Agent' => 'PhpScrapingLink/1.0'],
        ]);
    }

    public function makeGetRequest(string $url, array $queryParams = []): ResponseInterface
    {
        try {
            return $this->guzzle->get(
                $url,
                [
                    'query' => $this->getRequestQueryParams($queryParams),
                ]
            );
        } catch (ClientException $clientException) {
            throw ScrapingLinkExceptionBuilder::fromClientException($clientException);
        }
    }

    private function getRequestQueryParams(array $queryParams): array
    {
        return array_merge([
            'api_token' => $this->apiToken,
        ], $queryParams);
    }
}
