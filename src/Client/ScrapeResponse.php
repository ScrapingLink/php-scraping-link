<?php

declare(strict_types=1);

namespace Scrapinglink\PhpScrapingLink\Client;

use Psr\Http\Message\ResponseInterface;

class ScrapeResponse
{
    private string $body;
    private int $status;
    private ResponseInterface $originalResponse;

    public function __construct(ResponseInterface $response)
    {
        $this->body = (string)$response->getBody();
        $this->status = $response->getStatusCode();
        $this->originalResponse = $response;
    }

    public function body(): string
    {
        return $this->body;
    }

    public function status(): int
    {
        return $this->status;
    }

    public function originalResponse(): ResponseInterface
    {
        return $this->originalResponse;
    }
}
